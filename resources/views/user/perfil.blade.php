@extends('layouts.app')

@section('content')
<style>
    .perfil-img {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        object-fit: cover;
        margin: 0 auto;
        display: block;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                @if($perfil && $perfil->imagem_perfil)
                <img src="/img/perfil/{{$perfil->imagem_perfil}}" class="card-img-top perfil-img" alt="imagem do perfil">
                @else
                <img src="/img/perfil/perfilnull.png" class="card-img-top perfil-img" alt="imagem do perfil">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $perfil->user->name }}</h5>
                    <p class="card-text">Descrição sobre você.</p>
                    <form action="{{ route('perfil.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="file" class="form-control-file" name="imagem_perfil">
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar Nova Foto</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informações Pessoais</h5>
                    <p class="card-text">Nome: Seu Nome</p>
                    <p class="card-text">Email: seuemail@example.com</p>
                    <p class="card-text">Telefone: (123) 456-7890</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection