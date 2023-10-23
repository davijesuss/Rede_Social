<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friendships;

class FriendshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $targetUserId = $request->input('user_id');

        // Verifique se já existe uma amizade entre os usuários
        $existingFriendship = Friendships::where(function($query) use ($targetUserId) {
            $query->where('user1_id', auth()->user()->id)
                  ->where('user2_id', $targetUserId);
        })->orWhere(function($query) use ($targetUserId) {
            $query->where('user1_id', $targetUserId)
                  ->where('user2_id', auth()->user()->id);
        })->first();
    
        if ($existingFriendship) {
            return redirect()->back()->with('error', 'Você já é amigo desse usuário.');
        }
    
        try {
            $friendship = new Friendships();
            $friendship->user1_id = auth()->user()->id;
            $friendship->user2_id = $targetUserId;
            $friendship->save();
    
            return redirect()->back()->with('success', 'Amizade adicionada com sucesso!');
        } catch (\Exception $e) {
            // Trate qualquer exceção que possa ocorrer durante o processo de salvamento
            return redirect()->back()->with('error', 'Erro ao adicionar amizade. Por favor, tente novamente.');
        }
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
