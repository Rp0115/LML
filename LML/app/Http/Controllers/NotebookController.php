<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotebookController extends Controller
{
    /**
     * Display the notebook page with all user notes.
     */
    public function index()
    {
        $userId = Auth::id();

        // Fetch all notes for the logged-in user
        $userNotes = DB::table('notes')->where('user_id', $userId)->get();

        // Organize notes into a simple key-value array for the view
        $notes = [
            'linearReg' => $userNotes->firstWhere('id', 'linearReg')?->content,
            'logisticReg' => $userNotes->firstWhere('id', 'logisticReg')?->content,
            'decisionTree' => $userNotes->firstWhere('id', 'decisionTree')?->content,
            'neuralNetwork' => $userNotes->firstWhere('id', 'neuralNetwork')?->content,
        ];

        return view('notebook', ['notes' => $notes]);
    }

    /**
     * Store all notes from the notebook form.
     */
    public function store(Request $request)
    {
        $userId = Auth::id();

        // A map to connect form input names to database IDs
        $noteMapping = [
            'unit1Notes' => 'linearReg',
            'unit2Notes' => 'logisticReg',
            'unit3Notes' => 'decisionTree',
            'unit4Notes' => 'neuralNetwork',
        ];

        // Loop through the submitted notes and save each one
        foreach ($noteMapping as $inputName => $dbId) {
            if ($request->has($inputName)) {
                DB::table('notes')->updateOrInsert(
                    ['user_id' => $userId, 'id' => $dbId],
                    ['content' => $request->input($inputName), 'updated_at' => now()]
                );
            }
        }

        return redirect()->route('notebook.index')->with('status', 'Notes saved successfully!');
    }
}