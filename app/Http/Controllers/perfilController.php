<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;

class perfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perfil = Perfil::first(); // Ou use algum outro método para selecionar um perfil específico
         return view('user.perfil',  ['perfil' => $perfil]);
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
        $perfil = new Perfil($request->all());
        $perfil->user_id = auth()->user()->id;
    
        if ($request->hasFile('imagem_perfil') && $request->file('imagem_perfil')->isValid()) {
            $requestImage = $request->file('imagem_perfil');
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/perfil'), $imageName);
            $perfil->imagem_perfil = $imageName;
            // Save the updated perfil after adding the image
        }

        $perfil->save();
        return view('user.perfil', ['perfil' => $perfil]);
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
