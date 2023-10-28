@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Criação de post -->
    <div class="container">
        <h2>Criar Nova Postagem</h2>

        <form action="{{ route('postagens.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="content">Texto:</label>
                <textarea class="form-control" id="conteudo_post" name="conteudo_post" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control-file" id="imagem_post" name="imagem_post">
            </div>
            <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
    </div>
    <!--  -->

    <!-- Carregamento dos posts -->
    <div class="container">
        <h2>Timeline do Usuário</h2>
        @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                @if($post->user)
                <h5 class="card-title">{{ $post->user->name }}</h5>
                @else
                <h5 class="card-title">Usuário não encontrado</h5>
                @endif
                <p class="card-text">{{ $post->conteudo_post }}</p>
                @if($post->imagem_post)
                <img src="/img/postagem/{{$post->imagem_post}}" class="img-fluid" alt="Imagem da Postagem">
                @endif
                <div class="d-flex">
                <form action="{{ route('postagem.destroy',  ['id' => $post->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger me-2">excluir</button>
                    </form>
                    <form action="{{ route('postagem.edit', ['id' => $post->id])}}" method="get">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Carregamento dos posts -->
</div>
@endsection