@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Criação de post -->
    <div class="container">
        <h2>Criar Nova Postagem</h2>

        <form  method="post" enctype="multipart/form-data">
            @csrf
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
    <!--  -->
</div>
@endsection