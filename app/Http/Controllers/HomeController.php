<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Friendships;
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
        // Obtém os IDs dos amigos
        $friendIds = Friendships::where('user1_id', auth()->user()->id)
            ->orWhere('user2_id', auth()->user()->id)
            ->pluck('user1_id', 'user2_id')
            ->toArray();
    
        // Adiciona o próprio ID do usuário à lista de IDs dos amigos
        $friendIds[] = auth()->user()->id;
    
        dd($friendIds);
        // Obtém as postagens dos amigos
        $posts = Post::with('user')
            ->whereIn('users_id', $friendIds)
            ->orderBy('created_at', 'desc')
            ->get();

            dd($posts);
        return view('postagens.postagens', ['posts' => $posts, 'user' => auth()->user()]);
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
