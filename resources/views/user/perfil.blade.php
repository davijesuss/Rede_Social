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
                    @if($perfil)
                    <h5 class="card-title">{{ $perfil->user->name }}</h5>
                    <p class="card-text">{{ $perfil->biografia }}</p>
                    @else
                    <h5 class="card-title">Nome Indisponível</h5>
                    <p class="card-text">Biografia Indisponível</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informações Pessoais</h5>
                    @if($perfil)
                    <p class="card-text">Nome: {{ $perfil->user->name }}</p>
                    <p class="card-text">Email: {{ $perfil->user->email }} </p>
                    <p class="card-text">Telefone: {{ $perfil->telefone }}</p>
                    @else
                    <p class="card-text">Nome: Indisponível</p>
                    <p class="card-text">Email: Indisponível</p>
                    <p class="card-text">Telefone: Indisponível</p>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="mostrar_modal()">
                        Adicionar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--modal-->
    <div class="modal" tabindex="-1" id="meuModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informações Pessoais</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addLinha" method="post" enctype="multipart/form-data">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--modal-->
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function mostrar_modal() {
        let el = document.getElementById('meuModal');
        let meuModal = new bootstrap.Modal(el);
        meuModal.show();
    }

    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#addLinha').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this); // Use FormData para incluir os dados do arquivo
            $.ajax({
                url: "{{ route('perfil.store') }}",
                type: "post",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('#meuModal').modal('hide');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>