@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Criação de post -->
    <!--<div class="container">
        <h2>Criar Nova Postagem</h2>

        <form action="{{ route('postagens.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Texto:</label>
                <textarea class="form-control" id="conteudo_post" name="conteudo_post" rows="2">{{ old('conteudo_post', $post->conteudo_post) }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input type="file" class="form-control-file" id="imagem_post"  name="imagem_post">
            </div>
            <button type="submit" class="btn btn-primary">Salvar alteração</button>
        </form>
    </div>
      -->
    <div class="newPost">
        <form class="formPost" action="{{ route('postagens.update', $post->id) }}" method="post" enctype="multipart/form-data">
             @csrf
            @method('PUT')
            <textarea id="conteudo_post" name="conteudo_post" placeholder="fala estudante">{{ old('conteudo_post', $post->conteudo_post) }}</textarea>


            <div class="iconsAndButton">
                <div class="icons">
                    <button class="btnFileForm"><img src="{{ asset('img/img.svg')}}" alt="Adicionar uma imagem"></button>
                    <button class="btnFileForm"><img src="{{ asset('img/gif.svg')}}" alt="Adicionar um gif"></button>
                    <button class="btnFileForm"><img src="{{ asset('img/video.svg')}}" alt="Adicionar um video"></button>
                </div>
                <button type="submit" class="btnSubmitForm">Salvar alteração</button>
            </div>
        </form>
    </div>
</div>
@endsection