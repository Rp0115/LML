<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display the specified note FOR THE CURRENT USER.
     */
    public function show(string $id)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // ✅ Add a 'where' clause for user_id
        $note = DB::table('notes')
            ->where('id', $id)
            ->where('user_id', $userId) // Ensures user can only get their own note
            ->first();

        return response()->json([
            'content' => $note ? $note->content : ''
        ]);
    }

    /**
     * Store a note FOR THE CURRENT USER.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Add user_id to the query
        DB::table('notes')->updateOrInsert(
            [
                'id' => $validated['id'],
                'user_id' => $userId // The note must match the user
            ],
            [
                'content' => $validated['content'] // Data to insert or update
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Note saved successfully.'
        ]);
    }
}