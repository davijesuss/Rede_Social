<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;

class perfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perfil = Auth::user()->perfil;
        return view('user.perfil', ['perfil' => $perfil]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perfil = Auth::user()->perfil;

        // Se o usuário já tiver um perfil, redirecione para a edição em vez de criar um novo
        if ($perfil) {
            return redirect()->route('perfil.edit', ['id' => $perfil->id]);
        }

        return view('user.perfil');
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
        $perfil = Perfil::find($id); // Supondo que seu modelo seja chamado Perfil
        return view('perfil.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $perfil = Perfil::find($id);

        // Atualize os campos do perfil com os dados do formulário
        $perfil->biografia = $request->input('biografia');
        $perfil->email = $request->input('email');
        // ... Repita para os outros campos

        // Salve as alterações
        $perfil->save();

        // Redirecione para a página de exibição do perfil ou qualquer outra página desejada
        return redirect()->route('perfil_usuarios', ['id' => $perfil->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function perfilInfo()
    {
        return view('user.perfilInfo');
    }
}
