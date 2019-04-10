@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div class="container" style="height: 95vh">
    <div class="images"></div>
    <div role="main" class="introduction">
        <div class="col">
            <h1 class="hidden text-center text-uppercase font-weight-bold delighted-text">¿Puede un animal sin hogar disfrutar tanto como tu mascota?</h1>
            <h2 class="hidden text-center font-weight-normal mt-5 delighted-text">¡Nosotros así lo creemos!</h2>
            <h4 class="hidden text-center font-weight-light mt-5 delighted-text">
                Cada dia en los centros de acogida se cuidan innumerables animales y se gasta una gran cantidad de recursos
            </h4>
            <h4 class="hidden text-center font-weight-light mt-5 delighted-text">
                Recursos como:
            </h4>
            <div class="row mt-5">
                <div class="col hidden">
                    <div class="badge badge-danger mx-auto delighted-text">Comida</div>
                </div>
                <div class="col hidden">
                    <div class="badge badge-success mx-auto delighted-text">Medicina</div>
                </div>
                <div class="col hidden">
                    <div class="badge badge-primary mx-auto delighted-text">Higiene</div>
                </div>
            </div>
            <h3 class="hidden text-center font-weight-light mt-5 delighted-text" >
                ¡Contamos con tu ayuda!
            </h3>
        </div>
    </div>
</div>
@endsection
