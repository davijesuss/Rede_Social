@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('filtrar_usuarios') }}" method="get">
        <input type="text" id="search" name="search" class="form-control" placeholder="procurar...">
        <button type="submit">Buscar</button>
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
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i></a>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
        @else
        <p>Nenhum usuário encontrado para a busca '{{ $search }}'.</p>
        @endif
    </table>
</div>
@endsection
