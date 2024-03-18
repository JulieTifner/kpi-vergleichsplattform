<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionnaireController extends Controller
{
    /**
     * Retrieves all questionnaires associated with the currently authenticated user from the database.
     *
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        $questionnaires = Questionnaire::where('user_id', Auth::id())->get();

        return view('user.questionnaire_overview', [
            'questionnaires' => $questionnaires,
        ]);    
    }

    /**
    * Handles the creation of a new questionnaire based on user input.
    *
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'year' => [
                'required',
                'integer',
                'regex:/^(19|20)\d{2}$/', // Allows for years in the 20th and 21st centuries, requiring 4 digits.

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

    public function show(string $id){

        $questionnaire = Questionnaire::find($id);
        $questions = Question::where('is_active', true)->get();

        return view('user.questionnaire', [
            'questions'     => $questions,
            'questionnaire' => $questionnaire
        ]);
    }

  /**
   * Deletes a specific questionnaire identified by its ID.
   * 
   * @param string $id
   * @return \Illuminate\Http\RedirectResponse
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
