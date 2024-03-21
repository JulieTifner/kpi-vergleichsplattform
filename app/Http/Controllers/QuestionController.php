<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Retreive all Questions from database and display them on the questions view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $questions = Question::all();
        return view('moderator.questions', [
            'questions' => $questions,
        ]);
    }

   /**
    * handles submission of form, validates input and stores the question to database
    *
    * @param  \Illuminate\Http\Request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(Request $request)
    {
        $inputs = $request->all();

        $messages = [
            'name' => 'Title must not have more than 255 characters',
        ];
        $rules = [
            'name' => 'required|string|max:255',
        ];

        $validator = Validator::make($inputs, $rules, $messages);
        
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Question::create([
            'name'      => $request->input('name'),
            'type'      => $request->input('type'),
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->back()->with('success', 'Question added successfully');
    }


    /**
    * Get a specific question from the database based on its ID and displays the edit form.
    *
    * @param  string $id
    * @return \Illuminate\View\View
    */
    public function edit(string $id)
    {
        $question = Question::find($id);

        return view('moderator.edit', [
            'question' => $question,
        ]);
    }

    /**
     * Updates existing question in the database based on the submitted form data.
     *
     * @param  \Illuminate\Http\Request
     * @param  string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|integer',
        ]);

        $isActive = $request->input('is_active') == 'on';
        $question = Question::findOrFail($id);

        $question->update([
            'name'      => $validatedData['name'],
            'type'      => $validatedData['type'],
            'is_active' => $isActive,
        ]);

        return redirect()->route('question')->with('success', 'Question updated successfully');

    }

    /**
     *  Deletes a specific question identified by its ID from the database.
     *
     * @param  string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $question = Question::find($id);

        if ($question) {
            $question->delete();
            return redirect()->back()->with('success', 'Question successfully deleted.');
        }
    }
}
