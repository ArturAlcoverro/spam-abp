@extends('publica.templates.main')

@section('name')
ARTIO
@endsection

@section('body')
<link rel="stylesheet" href="{{ asset('css/public-navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/charts.css') }}">

<div class="container-fluid">
    <h1 class="mt-4">@lang('home.graphics')</h1>
    <div class="p-2">
        <div class="row grafics-card" style="height: calc(100vh - 92px);">

            <div class="col-2 py-2 pl-2 pr-0 tabs">
                <div class="nav flex-column nav-pills mt-2" id="llistaOpcions" role="tablist" aria-orientation="vertical"></div>

            </div>

            <div class="col-10 p-2 grafics">

                {{--
                <form action="" class="mt-2" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="dataInit" class="col-2 col-form-label">Data inicial</label>
                        <div class="col-4">
                            <input type="date" name="dataInit" id="dataInit" class="form-control">
                        </div>

                        <label for="dataFin" class="col-2 col-form-label">Data final</label>
                        <div class="col-4">
                            <input type="date" name="dataFin" id="dataFin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <button type="submit" name="actualizar" class="btn btn-primary boton-amplada">Actualitzar gràfic</button>
                    </div>
                </form> --}}


                <div class="tab-content" id="tabsGrafiques"></div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="{{ asset('js/functionsCharts.js') }}"></script>
<script src="{{ asset('js/eventsCharts.js') }}"></script>
@endsection
