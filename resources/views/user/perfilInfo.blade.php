@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('perfil.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="text">Biografia:</label>
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
            <label for="text">Instagram:</label>
            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="instagram">
        </div>
        <div class="form-group">
            <label for="text">Curso:</label>
            <input type="text" class="form-control" id="curso" name="curso" placeholder="curso">
        </div>
        <div class="m-2">
            <button type="submit" class="btn btn-primary">Enviar</button>
        </div>
    </form>
</div>
@endsection