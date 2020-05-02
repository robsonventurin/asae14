@extends('template')

@section('title', 'Resultado')
            
@section('content')
    <h1>Olá {{ Auth::user()->name }}, tudo bem?</h1>
    <h2>Seja bem vindo ao sistema de gerenciamento de vendas!</h2>
@endsection