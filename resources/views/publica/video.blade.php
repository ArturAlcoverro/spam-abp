@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div id="vcontainer" class="container" style="height: 95vh">
    <video width="720" height="480" controls class="mx-auto" style="width: 100%;">
        <source src="{{ asset('media/publica/SPAM_DEFDEF.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <h3 class="hidden-video text-center font-weight-light mt-5 delighted-text">Pregunta</h3>
    <h4 class="hidden-video text-center font-weight-light mt-5 delighted-text">¿Cuál de los siguientes no es necesario para obtener una licencia de razas potencialmente peligrosas?</h4>
    <div class="row mt-5">

    </div>
    <h2 class='text-center font-weight-light mt-5 delighted-text text-white' style='display: none'>¡Gracias por ver el video!</h2>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/video.js') }}"></script>
@endsection
