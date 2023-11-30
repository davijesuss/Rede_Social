<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'conteudo_post' => 'required|string|max:255',
            'imagem_post' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post;
        $post->users_id = auth()->user()->id;
        $post->conteudo_post = $request->input('conteudo_post');

        if ($request->hasFile('imagem_post')) {
            $imagePath = $request->file('imagem_post')->store('uploads', 'public');
            $post->imagem_post = $imagePath;
        }

        $post->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        //dd($id);
        $post = Post::where('id', $id)->first();
        if (!empty($post)) {
            return view('postagens.edit', ['post' => $post]);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar os dados recebidos do formulário
        $request->validate([
            'conteudo_post' => 'required',
            'imagem_post' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Recuperar a postagem que você deseja atualizar
        $post = Post::findOrFail($id);

        // Aplicar as alterações nos campos
        $post->conteudo_post = $request->input('conteudo_post');

        // Verificar se uma nova imagem foi enviada
        if ($request->hasFile('imagem_post') && $request->file('imagem_post')->isValid()) {
            $requestImage = $request->file('imagem_post');
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/postagem'), $imageName);
            $post->imagem_post = $imageName;
        }

        // Salvar a postagem atualizada
        $post->save();

        // Redirecionar para a página de detalhes da postagem, por exemplo
        return redirect()->route('home', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recuperar a postagem que você deseja excluir
        $post = Post::findOrFail($id);

        // Verificar se o usuário autenticado é o dono da postagem
        if (auth()->user()->id !== $post->users_id) {
            return redirect()->route('home')->with('error', 'Você não tem permissão para excluir esta postagem.');
        }

        // Deletar a postagem
        $post->delete();

        return redirect()->route('home')->with('success', 'Postagem deletada com sucesso.');
    }
}
