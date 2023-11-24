@extends('layouts.app')

@section('content')
<main class="main">
    <!-- Formulário de postagem -->
    <div class="newPost">
        <div class="infoUser">
            <div class="imgUse"></div>
            <strong>{{ $user->name }}</strong>
        </div>
        <form class="formPost" name="formPost" action="{{ route('postagens.store') }}" method="post">
            @csrf
            <textarea id="conteudo_post" name="conteudo_post" placeholder="fala estudante"></textarea>

            <div class="iconsAndButton">
                <div class="icons">
                    <button class="btnFileForm"><img src="{{ asset('img/img.svg') }}" alt="Adicionar uma imagem"></button>
                    <button class="btnFileForm"><img src="{{ asset('img/gif.svg') }}" alt="Adicionar um gif"></button>
                    <button class="btnFileForm"><img src="{{ asset('img/video.svg') }}" alt="Adicionar um vídeo"></button>
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
                    <div class="nameAndHour">
                        <strong>{{ $post->user ? $post->user->name : 'Usuario não encontrado' }}</strong>
                        <p>21h</p>
                    </div>
                </div>
                <p>{{ $post->conteudo_post }}</p>
                <div class="actionBtnPost">
                    <form action="{{ route('post.like', ['post' => $post->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="filePost like">
                            <img src="{{ asset('img/heart.svg') }}" alt="Curtir">
                            Curtir ({{ $post->likes()->count() }})
                        </button>
                    </form>
                    <button type="button" class="filePost comment" onclick="mostrar_modal({{$post->id}})">
                        <img src="{{ asset('img/heart.svg') }}" alt="Curtir"> Comentar
                    </button>
                    <form action="{{ route('postagem.edit', ['id' => $post->id]) }}" action="">
                        <button type="submit" class="filePost navbar-brand" style="background-color: #00ff7f; color: white;">
                            <i>Editar</i>
                        </button>
                    </form>
                    <form action="{{ route('postagem.destroy', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="filePost navbar-brand" style="background-color: #4CAF50; color: white;">
                            <i> Excluir</i>
                        </button>
                    </form>
                </div>

                <!-- Modal de Comentários -->
                <div class="modal" tabindex="-1" id="meuModal-{{$post->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Comentários</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="newPost">
                                    <div class="infoUser">
                                        <div class="imgUse"></div>
                                        <strong>{{ $user->name }}</strong>
                                    </div>
                                    <form class="formPost" action="{{ route('comentario.store', $post->id) }}" method="post">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <textarea id="comentario" name="comentario" placeholder="Seu comentário aqui ..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                            </form>

                            @foreach($post->comments as $comment)
                            <ul class="posts" id="idUlPost">
                                <li class="post">
                                    <div class="infoUserPost">
                                        <div class="imgUserpost"></div>
                                        <div class="nameAndHour">
                                            <strong>{{ $comment->user ? $comment->user->name : 'Usuário não encontrado' }}</strong>
                                            <p>21h</p>
                                        </div>
                                    </div>
                                    <p>{{ $comment->comentario }}</p>
                                </li>
                            </ul>
                            @endforeach

                        </div>
                    </div>
                </div>
            </li>
        </ul>
    @endforeach
</main>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

<script>
    function mostrar_modal(id) {
        let el = document.getElementById(`meuModal-${id}`);
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
