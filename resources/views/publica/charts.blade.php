@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div class="container">
    <canvas id="myChart"></canvas>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
<script src="{{ asset('js/functionsCharts.js') }}"></script>
<script src="{{ asset('js/eventsCharts.js') }}"></script>
@endsection