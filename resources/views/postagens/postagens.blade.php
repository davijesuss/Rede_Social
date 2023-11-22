@extends('layouts.app')

@section('content')
<main class="main">
    <!--formulario de postagem-->
    <div class="newPost">
        <div class="infoUser">
            <div class="imgUse"></div>
            <strong>{{ $user->name }}</strong>
        </div>
        <form class="formPost" name="formPost">
            @csrf
            <textarea id="conteudo_post" name="conteudo_post" placeholder="fala estudante"></textarea>


            <div class="iconsAndButton">
                <div class="icons">
                    <button class="btnFileForm"><img src="{{ asset('img/img.svg')}}" alt="Adicionar uma imagem"></button>
                    <button class="btnFileForm"><img src="{{ asset('img/gif.svg')}}" alt="Adicionar um gif"></button>
                    <button class="btnFileForm"><img src="{{ asset('img/video.svg')}}" alt="Adicionar um video"></button>
                </div>
                <button type="submit" class="btnSubmitForm">Publicar</button>
            </div>
        </form>
    </div>
    @foreach($posts as $post)
    <ul class="posts" id="idUlPost">
        <li class="post">
            <div class="infoUserPost">
                <div class="imgUserpost"></div>
                @if($post->user)
                <div class="nameAndHour">
                    <strong>{{ $post->user->name }}</strong>
                    <p>21h</p>
                </div>
                @else
                <div class="nameAndHour">
                    <strong>Usuario não encontrado</strong>
                    <p>21h</p>
                </div>
                @endif
            </div>
            <p>
                {{ $post->conteudo_post }}
            </p>
            <div class="actionBtnPost">
                <form action="{{ route('post.like', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="filePost like">
                        <img src="{{ asset('img/heart.svg')}}" alt="Curtir">
                        Curtir ({{ $post->likes()->count() }})
                    </button>
                </form>
                <button type="button" class="filePost comment"><img src="{{ asset('img/heart.svg')}}" alt="Curtir">Comentar</button>
              <form action="{{ route('postagem.edit',  ['id' => $post->id])}}" action="">
                    <button type="submit" class="filePost navbar-brand" style="background-color: #00ff7f; color: white;"><i>Editar</i></button>
                </form>
                <form action="{{ route('postagem.destroy',  ['id' => $post->id])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="filePost navbar-brand" style="background-color: #4CAF50; color: white;"><i> Excluir</i></button>
                </form>

            </div>
        </li>
    </ul>
    <!--modal-->
    <div class="modal" tabindex="-1" id="meuModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informações Pessoais</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
        <!--modal-->
        @endforeach

</main>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>


<script>

     function mostrar_modal() {
        let el = document.getElementById('meuModal');
        let meuModal = new bootstrap.Modal(el);
        meuModal.show();
    }

    $(function() {
        $('form[name="formPost"]').submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: "{{ route('postagens.store') }}",
                type: "post",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    window.location.href = "{{ route('home')}}"
                    console.log(response);
                }
            });
        });
    });
</script>