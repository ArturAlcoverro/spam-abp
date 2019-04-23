@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div class="container" style="height: 95vh">
    <video width="720" height="480" controls class="mx-auto" style="width: 100%">
        <source src="{{ asset('media/publica/SPAM_DEFDEF.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
@endsection
