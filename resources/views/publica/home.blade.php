@extends('publica.templates.main')

@section('name')
    ARTIO
@endsection

@section('body')
<div class="container" style="height: 90vh">
    <div class="images"></div>
    <div role="main" class="introduction mt-5">
        <div class="col">
            <h1 class="hidden text-center text-uppercase font-weight-bold">¿Puede un perro o un gato disfrutar tanto como tu mascota?</h1>
            <h2 class="hidden text-center font-weight-normal mt-5">¡Nosotros así lo creemos!</h2>
            <h4 class="hidden text-center font-weight-light mt-5">
                Cada dia en los centros de acogida se cuidan innumerables animales y se gasta una gran cantidad de recursos diarios
            </h4>
            <h4 class="hidden text-center font-weight-light mt-5">
                Recursos como:
            </h4>
            <div class="row mt-5">
                <div class="col hidden">
                    <div class="badge badge-danger mx-auto">Comida</div>
                </div>
                <div class="col hidden">
                    <div class="badge badge-success mx-auto">Medicina</div>
                </div>
                <div class="col hidden">
                    <div class="badge badge-primary mx-auto">Higiene</div>
                </div>
            </div>
            <h3 class="hidden text-center font-weight-light mt-5" >
                ¡Contamos con tu ayuda!
            </h3>
        </div>
    </div>
</div>
@endsection
