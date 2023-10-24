@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('filtrar_usuarios') }}" method="get" class="d-flex" >
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
</div>
@endsection