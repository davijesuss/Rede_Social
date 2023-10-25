@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('filtrar_usuarios') }}" method="get" class="d-flex">
        <input type="text" id="search" name="search" class="form-control" placeholder="procurar...">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <table class="table">
        @if(count($usuarios) > 0)
        <thead>
            <tr>
                <th scope="col">Usuarios</th>
                <th>Adicionar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td class="d-flex">
                    <form action="{{ route('friendships.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $usuario->id }}">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-trash">Adicionar</i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <p>Nenhum usuário encontrado para a busca '{{ $search }}'.</p>
        @endif
    </table>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

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
    <!-- Criação de post -->

    <!-- Carregamento dos posts -->
    <div class="container">
        <h2>Timeline do Usuário</h2>
        @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post->user->name }}</h5>
                <p class="card-text">{{ $post->conteudo_post }}</p>
                @if($post->imagem_post)
                <img src="{{ asset('storage/' . $post->imagem_post) }}" class="img-fluid" alt="Imagem da Postagem">
                @endif
            </div>
        </div>
        @endforeach
    </div>
    <!-- Carregamento dos posts -->
</div>
@endsection