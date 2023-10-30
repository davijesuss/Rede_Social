<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get(); // Carrega os usuários associados aos posts
        return view('postagens.postagens', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'conteudo_post' => 'required|string|max:255',
            'imagem_post' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post;
        $post->users_id = auth()->user()->id;
        $post->conteudo_post = $request->input('conteudo_post');

        if ($request->hasFile('imagem_post') && $request->file('imagem_post')->isValid()) {

            $requestImage = $request->file('imagem_post'); // Corrigido aqui

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension; // Corrigido aqui

            $requestImage->move(public_path('img/postagem'), $imageName); // Adicionado ponto e vírgula

            $post->imagem_post = $imageName;
        }

        $post->save();

        return redirect()->route('home')->with('success', 'Postagem criada com sucesso!');
    }
}
