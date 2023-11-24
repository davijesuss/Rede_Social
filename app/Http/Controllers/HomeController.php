<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Models\Friendships;
use App\Models\Perfil;
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
            ->pluck('user1_id', 'user2_id')
            ->toArray();
       
        $friendIds[] = auth()->user()->id;
        $allFriendIds = array_keys($friendIds);
        
        $posts = Post::with('user')
            ->whereIn('users_id', $allFriendIds)
            ->orWhere('users_id', auth()->user()->id) // Inclua as próprias postagens do usuário logado
            ->orderBy('created_at', 'desc')
            ->get();
        $perfil = Perfil::where('user_id', auth()->user()->id)->first();

        return view('postagens.postagens', ['posts' => $posts, 'user' => auth()->user(), 'perfil' => $perfil]);
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

            $requestImage = $request->file('imagem_post');
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/postagem'), $imageName);
            $post->imagem_post = $imageName;
        }

        $post->save();

        // Retornar uma resposta JSON
        return response()->json(['success' => true, 'message' => 'Postagem criada com sucesso!']);
    }

    public function likePost(Post $post)
    {
        auth()->user()->likes()->toggle($post);

        return redirect()->back()->with('success', 'Ação de curtir realizada com sucesso!');
    }
    public function showLikes()
    {
        $user = auth()->user();
        $likes = $user->likes;

        return view('likes.index', compact('likes'));
    }
}
