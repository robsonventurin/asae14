@extends('template')

@section('title', 'Cadastrar Item')
            
@section('subtitle')
   Cadastrando item de venda da venda #{{ $venda->id }} para {{ $venda->cliente->nome }}
@endsection
                        
@section('content')
    <h3>Produtos Adicionados Até O Momento</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço Unitário</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Adicionado Em</th>
            <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        
            @foreach ($venda->produtos as $p) 
                <tr>
                    <th scope="row">{{ $p->id }}</th>
                    <td>{{ $p->nome }}</td>
                    <td>{{ $p->pivot->quantidade }}</td>
                    <td>@money($p->valor_unitario)</td>
                    <td>@money($p->pivot->subtotal)</td>
                    <td>{{ $p->pivot->created_at }}</td>
                    <td>
                        <a href="#" data-toggle="modal" data-target="#modalExcluir"
                            data-href="{{ route('excluir_vendas_item', [ 'id' => $venda->id, 'id_produto' => $p->id ]) }}"
                            data-nome="{{ $p->nome }}" data-id="{{ $p->pivot->id }} "
                        >Excluir</a>
                    </td>
                </tr>
            @endforeach
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td><b>Total:</b></td>
                    <td><b>@money($venda->valor_total)</b></td>
                    <td></td>
                    <td></td>
                </tr>
        </tbody>
    </table>

    <h3 style="margin-top:50px;">Adicionar Mais Produto</h3>
    <form method="POST" action="{{ route('cadastrar_venda_item_efetua', ['id' => $venda->id]) }}">
        @csrf
        <div class="form-group row">
            <label for="id_produto" class="col-sm-2 col-form-label">Produto:</label>
            <div class="col-sm-10">
                <select name="id_produto" class="form-control">
                    @foreach ($produtos as $key => $value) 
                        <option value="{{ $value->id }}">#{{ $value->id }} - {{ $value->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="quantidade" class="col-sm-2 col-form-label">Quantidade:</label>
            <div class="col-sm-10">
                <input class="form-control" name="quantidade" type="number" min="0" step="0.01" max="99" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
            </div>
            <div class="col-sm-10 offset-sm-2" style="margin-top:5px;">
                <a class="btn btn-primary btn-block" href="{{ route('listar_vendas') }}">Concluir Venda</a>
            </div>
        </div>
    </form>

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
                    <p>Deseja mesmo excluir o item <span class="nome"></span> de id #<span class="id"></span>?</p>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
            $("#valor_total").maskMoney({
                prefix:'R$ ',
                suffix:"",
                formatOnBlur:false,
                allowZero:true,
                allowNegative:false,
                allowEmpty:true,
                doubleClickSelection:true,
                selectAllOnFocus:false,
                thousands: '.',
                decimal: ',' ,
                precision: 2,
                affixesStay :true,
                bringCaretAtEndOnFocus:true
            });

            $('#modalExcluir').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).attr('data-href'));
                $(this).find('span.id').html($(e.relatedTarget).attr('data-id'));
                $(this).find('span.nome').html($(e.relatedTarget).attr('data-nome'));
            });
    </script>
@endsection