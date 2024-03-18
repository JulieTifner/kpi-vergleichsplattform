<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionnaires = Questionnaire::where('user_id', Auth::id())->get();

        return view('user.questionnaire_overview', [
            'questionnaires' => $questionnaires,
        ]);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'year' => [
                'required',
                'integer',
                'regex:/^(19|20)\d{2}$/', //erlaubt die Jahrhunderte 1900 und 2000 und verlangt 4 Ziffern

            ],
        ];

        $validator = Validator::make($inputs, $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Questionnaire::create([
            'name' => $request->input('name'),
            'year' => $request->input('year'),
            'timespan' => $request->input('timespan'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()->with('success', 'Questionnaire added successfully');
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
        $questionnaire = Questionnaire::find($id);

        if($questionnaire){
            $questionnaire->delete();
            return redirect()->back()->with('success', 'Questionnaire successfully deleted.');
        }
    }
}
