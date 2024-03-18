<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inviteToken = Session::get('inviteToken', null);

        return view('moderator.invitations', [
            'inviteToken' => $inviteToken,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inviteToken = $this->randHash(20);
        
        Session::put('inviteToken', $inviteToken);

        Invitation::create([
            'token'           => $inviteToken,
            'expiration_date' => Carbon::now()->addDays(7)
        ]);

        return redirect()->back();
    }

    function randHash($len = 32)
    {
        return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
