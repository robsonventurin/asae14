@extends('template')

@section('title', 'Cadastrar Tipo De Produtos')
            
@section('subtitle')
    Página de cadastro de tipo de produto. Por favor, preencha os campos conforme orientações individuais.<br>
@endsection
                        
@section('content')
    <form method="POST" action="{{ route('alterar_produtos_efetua', ['id' => $p->id]) }}">
    @csrf
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label">Nome:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" maxlength="100" name="nome" placeholder="Nome" value="{{ $p->nome }}" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="id_tipo_produtos" class="col-sm-2 col-form-label">Tipo de Produto:</label>
            <div class="col-sm-10">
                <select name="id_tipo_produtos" class="form-control">
                    @foreach ($t as $key => $value) 
                        <option value="{{ $value->id }}" @if ($value->id == $p->id_tipo_produtos) selected @endif>#{{ $value->id }} - {{ $value->nome }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="valor_unitario" class="col-sm-2 col-form-label">Valor Unitário:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" maxlength="255" name="valor_unitario" id="valor_unitario"  value="@money($p->valor_unitario)" placeholder="R$ 0,00" required>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary btn-block">Alterar</button>
            </div>
            
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
            $("#valor_unitario").maskMoney({
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
    </script>
@endsection