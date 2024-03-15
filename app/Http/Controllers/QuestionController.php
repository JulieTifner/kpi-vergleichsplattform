<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::all();
        return view('moderator.questions', [
            'questions' => $questions,
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
        ];

        $validator = Validator::make($inputs, $rules);
        
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
        $question = Question::find($id);

        return view('moderator.edit', [
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
