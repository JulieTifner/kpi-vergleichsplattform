<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users,username',
                'regex:/^[^@]*$/'
            ],
            'password' => [
                'required',
                'string',
                'min:13',
                'required', 'string', 'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
                'confirmed'
            ]

        ], [
            'password.regex' => 'Password must contain at least 1x Uppercase, 1x Lowercase, a number and a special character!',
            'username.unique' => 'Username already exists.',
            'username.regex' => 'Username must not contain @.'
        ]);
    }

    public function register(Request $request)
    {
        //Validate data
        $this->validator($request->all())->validate();
        
        $hash = $request->token;
   
        if (!$hash) {
            return redirect()->back()->with('error', 'Invalid or expired invitation token');
        }
        //Create User
        event(new Registered($user = $this->create($request->all())));

        //Delete hash
        $invitation = Invitation::where('token', $hash)->first();
        $id = $invitation->id;
        $i = Invitation::find($id);
        $i->delete();

        //Copied from RegistersUsers trait
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    public function showRegistration($token = null)
    {
        $invitation = Invitation::where('token', $token)
            ->where('expiration_date', '>', Carbon::now())
            ->first();

        return view('auth.register', compact('token'));
    }

    public function registerModerator(Request $request)
    {

        $this->validator($request->all())->validate();
        event(new Registered($this->createModerator($request->all())));
        
        return redirect()->back()->with('success', 'Moderator created successfully');
    }


    public function createModerator(array $data)
    {

        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role_id' => 1
        ]);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
