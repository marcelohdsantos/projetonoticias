<x-master titulo="Criar Noticias">
    <div class="container pt-5">

        @if(session()->has('mensagem'))
        <div class="alert alert-success">
            {{ session()->get('mensagem') }}
        </div>
        @endif

        <a href="/noticias/create" class="btn btn-primary mb-5">Nova Notícia</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Ações</th>
                    <th>Título</th>
                    <th>Status</th>
                    <th>Data Publicação</th>
                    <th>Imagem</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($noticias as $noticia)
                <tr>
                    <td>
                        <a href="/noticias/edit/{{ $noticia->id }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="/noticias/{{ $noticia->id }}" class="d-inline-block" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                    <td>{{ $noticia->titulo }}</td>
                    <td>{{ $noticia->status_formatado }}</td>
                    <td>{{ optional($noticia->data_publicacao)->format("d/m/Y") }}</td>
                    <td><img src="{{ $noticia->imagem}}" height="40px"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $noticias->links() }}
    </div>

</x-master>