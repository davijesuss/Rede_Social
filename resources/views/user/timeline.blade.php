@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('filtro_usuarios') }}" method="get">
        <label  for="filtro">Filtrar por:</label>
        <select name="filtro" id="filtro">
        <option selected>Buscar Amigos</option>
        @foreach ($usuarios as $usuario)
            <option value="{{$usuario->id}}">{{$usuario->name}}</option>
            @endforeach
        </select>
        <button type="submit">Filtrar</button>
    </form>
</div>
@endsection