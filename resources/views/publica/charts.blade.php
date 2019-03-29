@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="llistaOpcions" role="tablist" aria-orientation="vertical"></div>

            <div class="tab-content" id="tabsGrafiques"></div>

        </div>

    <div class="col-9">
        <form action="" class = "mt-2" method="POST">
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
    </form>




    <canvas id="myChart"></canvas>
    </div>


    </div>





</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="{{ asset('js/functionsCharts.js') }}"></script>
<script src="{{ asset('js/eventsCharts.js') }}"></script>
@endsection
