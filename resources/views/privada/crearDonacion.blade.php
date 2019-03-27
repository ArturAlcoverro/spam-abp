@extends('privada.templates.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
@endsection
@section('body')
    <div class="p-5">
        <h3>Selecciona un donant</h3>
        <div class="buttons">
            <button id="btnParticular" class="btn-donant">
                <img src="{{ asset('media/img/user.png') }}" alt="">
                <p>Particular</p>
            </button>
            <button id="btnEmpresa" class="btn-donant">
                <img src="{{ asset('media/img/empresa.png') }}" alt="">
                <p>Empresa</p>
            </button>
            <button id="btnAnonim" class="btn-donant">
                <img src="{{ asset('media/img/anonim.png') }}" alt="">
                <p>Anònim</p>
            </button>
            <button id="btnNou" class="btn-donant">
                <img src="{{ asset('media/img/plus.png') }}" alt="">
                <p>Nou</p>
            </button>
        </div>
    </div>
@endsection

