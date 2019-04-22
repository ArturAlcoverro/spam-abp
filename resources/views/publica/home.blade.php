@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div class="container" style="height: 95vh">
    <div class="images"></div>
    <div role="main" class="introduction">
        <div class="col">
            <h1 class="hidden text-center text-uppercase font-weight-bold delighted-text">@lang('home.text1')</h1>
            <h2 class="hidden text-center font-weight-normal mt-5 delighted-text">@lang('home.text2')</h2>
            <h4 class="hidden text-center font-weight-light mt-5 delighted-text">
                @lang('home.text3')
            </h4>
            <h4 class="hidden text-center font-weight-light mt-5 delighted-text">
                @lang('home.text4')
            </h4>
            <div class="row mt-5">
                <div class="col hidden">
                    <div class="badge badge-danger mx-auto delighted-text">@lang('home.food')</div>
                </div>
                <div class="col hidden">
                    <div class="badge badge-success mx-auto delighted-text">@lang('home.medicines')</div>
                </div>
                <div class="col hidden">
                    <div class="badge badge-primary mx-auto delighted-text">@lang('home.higiene')</div>
                </div>
            </div>
            <h3 class="hidden text-center font-weight-light mt-5 delighted-text" >
                @lang('home.text5')
            </h3>
        </div>
    </div>
</div>
@endsection
