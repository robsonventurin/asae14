@extends('template')

@section('title', 'Listar Produtos')
            
@section('subtitle')
    Página de listagem de produtos. Para cadastrar um novo, clique <a href="{{ route('cadastrar_produtos') }}">aqui</a>.<br>
@endsection

@section('content')
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Tipo De Produto</th>
            <th scope="col">Valor Unitário</th>
            <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach ($lista as $c) 
                <tr>
                    <th scope="row">{{ $c->id }}</th>
                    <td>{{ $c->nome }}</td>
                    <td>#{{ $c->tipo->id  }} - {{ $c->tipo->nome }}</td>
                    <td>@money($c->valor_unitario)</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modalExcluir"
                            data-href="{{ route('excluir_produtos', [ 'id' => $c->id ]) }}"
                            data-nome="{{ $c->nome }}" data-id="{{ $c->id }} "
                        >Excluir</a> -   
                        <a href="{{ route('alterar_produtos', [ 'id' => $c->id ]) }}">Alterar</a>
                    </td>
                </tr>
            @endforeach
             
        </tbody>
    </table>

     <!-- Modal -->
    <div class="modal fade" id="modalExcluir" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tem certeza?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja mesmo excluir o produto <span class="nome"></span> de id #<span class="id"></span>? Lembrando que todas as vendas vinculadas também serão excluídos!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <a class="btn btn-danger btn-ok">Deletar</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#modalExcluir').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).attr('data-href'));
        $(this).find('span.id').html($(e.relatedTarget).attr('data-id'));
        $(this).find('span.nome').html($(e.relatedTarget).attr('data-nome'));
    });
</script>
@endsection
