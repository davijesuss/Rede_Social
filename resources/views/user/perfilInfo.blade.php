@extends('layouts.app')

@section('content')
@if(Auth::user()->perfil)
    {{-- Se o usuário já tiver um perfil, redirecione para a edição --}}
    <script>window.location = "{{ route('perfil.edit', ['id' => Auth::user()->perfil->id]) }}";</script>
@else
    {{-- Se o usuário não tiver um perfil, exiba o formulário de adição --}}
    <div class="container mt-5">
        <form action="{{ route('perfil.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="biografia">Biografia:</label>
                <input type="text" class="form-control" id="biografia" name="biografia" placeholder="Conte sobre você...">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@example.com">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(123) 456-7890">
            </div>
            <div class="form-group">
                <label for="instagram">Instagram:</label>
                <input type="text" class="form-control" id="instagram" name="instagram" placeholder="instagram">
            </div>
            <div class="form-group">
                <label for="curso">Curso:</label>
                <input type="text" class="form-control" id="curso" name="curso" placeholder="curso">
            </div>
            <div class="form-group">
                <label for="imagem_perfil">Imagem do Perfil:</label>
                <input type="file" class="form-control-file" name="imagem_perfil">
            </div>
            <div class="m-2">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
@endif
@endsection
