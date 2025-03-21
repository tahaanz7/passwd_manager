<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $passwords = Auth::user()->passwords;
        return response()->json($passwords);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'login' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $password = Auth::user()->passwords()->create($validated);
        
        return response()->json($password, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Password $password)
    {
        // Check if the password belongs to the authenticated user
        if ($password->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        return response()->json($password);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Password $password)
    {
        // Check if the password belongs to the authenticated user
        if ($password->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'login' => 'sometimes|string|max:255',
            'password' => 'sometimes|string',
        ]);
        
        $password->update($validated);
        
        return response()->json($password);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Password $password)
    {
        // Check if the password belongs to the authenticated user
        if ($password->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        
        $password->delete();
        
        return response()->json(null, 204);
    }
}
