@extends('privada.templates.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
<script src="{{asset('js/eventsCrearDonacio.js')}}"></script>
<script src="{{asset('js/functionsCreateGrafic.js')}}"></script>
<script src="{{asset('js/eventsCreateGrafic.js')}}"></script>
@endsection

@section('body')
@include('partial.errores')
<div class="p-5 d-inline-block">
    <h3 class="">Crea un gràfic</h3>
    <div class="buttons">
        <button id="btnDades" class="btn-donatiu">
            <p>Dades</p>
        </button>
        <button id="btnComp" class="btn-donatiu">
            <p>Comparativa</p>
        </button>
        <button id="btnObj" class="btn-donatiu">
            <p>Objectius</p>
        </button>
    </div>

</div>

<!-- modal dades -->
<div class="modal fade" id="modalGraficDades" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nou gràfic de dades</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" action="{{ action('GraficoController@store') }}" method="POST">
                    @csrf
                    <input type="hidden" name = 'modal' value = 'd' id = 'd'>
                        <div class="form-group">
                            <label for="lblnombre" class=" col-form-label">Nom de la gràfica</label>
                            <div class="">
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nom" required maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lbldesc" class=" col-form-label">Descripció</label>
                            <div class="">
                                <input type="text" name="desc" id="desc" class="form-control" placeholder="Descripció" maxlength="200">
                            </div>
                        </div>

                        <div class="form-group">
                                <label id ="lbldTipoData" for="dTipoData" class="col-form-label">Tipus de data</label>
                                <div class="">
                                    <select name="dTipoData" id="dTipoData" class="form-control dTipoData">
                                        <option value="dinamic" selected>Dinamica</option>
                                        <option value="fixe">Fixe</option>
                                    </select>
                                </div>
                        </div>
                        <div class="row" id = "dInterval">
                            <div class="form-group col-7 col-md-9 pr-0">
                                <label for="cantidad" class="col-form-label">Quantitat</label>
                                <div class="">
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Quantitat" value="30">
                                </div>
                            </div>
                            <div class="form-group col-5 col-md-3">
                                <label for="medida" class="col-form-label">Mesura</label>
                                <div class="">
                                    <select name="medida" id="medida" class="form-control">
                                        <option value="dd">Dies</option>
                                        <option value="mm">Mesos</option>
                                        <option value="aaaa">Anys</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row" id = "dFixe">
                            <div class="form-group col-6">
                                <label for="dataInit" class="col-form-label">Data Inicial</label>
                                <div class="">
                                    <input type="date" name="dataInit" id="dataInit" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="dataFin" class="col-form-label">Data Final</label>
                                <div class="">
                                    <input type="date" name="dataFin" id="dataFin" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lbltipos_donacion" class=" col-form-label">Tipo de donacion</label>
                            <div class="">
                                @foreach ($tipos as $tipo)
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="d{{$tipo->nombre}}" id="d{{$tipo->nombre}}">
                                                <label class="custom-control-label" for="d{{$tipo->nombre}}">{{$tipo->nombre}}</label>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lblcentro" class=" col-form-label">Centro origen</label>
                            <div class="">
                                <select name="origen" id="origen" class="form-control">
                                    <option value= "0" selected>Tots</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}" >{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lblcentro" class=" col-form-label">Centro destino</label>
                            <div class="">
                                <select name="destino" id="destino" class="form-control">
                                    <option value= "0" selected>Tots</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}" >{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label for="lblanimales" class=" col-form-label">Animales</label>
                                <div class="">
                                    <select name="animales" id="animales" class="form-control">
                                        <option value= "0" selected>Tots</option>
                                        @foreach ($animales as $animal)
                                            <option value="{{$animal->id}}">{{$animal->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                            <label id ="lblvalor"for="valor" class="col-form-label">Valor a mostrar</label>
                            <div class="">
                                <select name="valor" id="valor" class="form-control">
                                    <option value="cash">Diners(€)</option>
                                    <option value="uu">Unitats</option>
                                    <option value="donacions">Donacions</option>
                                </select>
                            </div>
                    </div>


                        <div class="form-group">
                            <label for="lbltipus_grafic" class="col-form-label">Tipus gràfic</label>
                            <div class="">
                                <select name="tipus_grafic" id="tipus_grafic" class="form-control">
                                    <option value="bar">Barres</option>
                                    <option value="pie">Pastís</option>
                                    <option value="horizontalBar">Barres Horitzontals</option>
                                    <option value="doughnut">Donut</option>
                                    <option value="line">Linies</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="lblordenar" class="col-form-label">Ordenar per</label>
                                <div class="">
                                    <select name="ordenar" id="ordenar" class="form-control" >
                                        <option value="tipus" selected>Tipus Donació</option>
                                        <option value="animals">Animal</option>
                                        <option value="desti">Centre destí</option>
                                        <option value="origen">Centre recollida</option>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="col-5 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="dPublic" id="dPublic">
                                <label class="custom-control-label" for="dPublic">Fer la estadística pública</label>
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <button type="button" class="btn btn-secondary boton-amplada mr-1" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</div>
<!-- modal comparativa -->
<div class="modal fade" id="modalGraficComparativa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nova comparativa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" action="{{ action('GraficoController@store') }}" method="POST">
                    @csrf
                        <input type="hidden" name = 'modal' value = 'c' id = 'c'>
                        <div class="form-group">
                            <label for="lblnombre" class=" col-form-label">Nom de la gràfica</label>
                            <div class="">
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nom" required maxlength="20">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lbldesc" class=" col-form-label">Descripció</label>
                            <div class="">
                                <input type="text" name="desc" id="desc" class="form-control" placeholder="Descripció" maxlength="200">
                            </div>
                        </div>
                        <div id = "data">
                            <div class="row" id = "data1">
                                <div class="form-group col-6">
                                    <label for="dataInit" class="col-form-label">Data Inicial</label>
                                    <div class="">
                                        <input type="date" name="dataInit0" id="dataInit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="dataFin" class="col-form-label">Data Final</label>
                                    <div class="">
                                        <input type="date" name="dataFin0" id="dataFin" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id = "data2">
                                <div class="form-group col-6">
                                    <label for="dataInit" class="col-form-label">Data Inicial</label>
                                    <div class="">
                                        <input type="date" name="dataInit1" id="dataInit1" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="dataFin" class="col-form-label">Data Final</label>
                                    <div class="">
                                        <input type="date" name="dataFin1" id="dataFin1" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id = "data3">
                                <div class="form-group col-6">
                                    <label for="dataInit" class="col-form-label">Data Inicial</label>
                                    <div class="">
                                        <input type="date" name="dataInit2" id="dataInit2" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="dataFin" class="col-form-label">Data Final</label>
                                    <div class="">
                                        <input type="date" name="dataFin2" id="dataFin2" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id = "data4">
                                <div class="form-group col-6">
                                    <label for="dataInit" class="col-form-label">Data Inicial</label>
                                    <div class="">
                                        <input type="date" name="dataInit3" id="dataInit3" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="dataFin" class="col-form-label">Data Final</label>
                                    <div class="">
                                        <input type="date" name="dataFin3" id="dataFin3" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id = "data5">
                                <div class="form-group col-6">
                                    <label for="dataInit" class="col-form-label">Data Inicial</label>
                                    <div class="">
                                        <input type="date" name="dataInit4" id="dataInit4" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-6">
                                    <label for="dataFin" class="col-form-label">Data Final</label>
                                    <div class="">
                                        <input type="date" name="dataFin4" id="dataFin4" class="form-control">
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-group float-left">
                                <button type="button" id = btnAfegir class="btn btn-secondary boton-amplada">Afegir interval</button>
                                <button type="button" name="btnEliminar" value = "2" class="btn btn-secondary boton-amplada">Eliminar interval</button>
                        </div>

                        <div class="form-group">
                            <label for="lbltipos_donacion" class=" col-form-label">Tipo de donacion</label>
                            <div class="">
                                @foreach ($tipos as $tipo)
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="c{{$tipo->nombre}}" id="c{{$tipo->nombre}}">
                                                <label class="custom-control-label" for="c{{$tipo->nombre}}">{{$tipo->nombre}}</label>
                                            </div>
                                        </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro" class=" col-form-label">Centro origen</label>
                            <div class="">
                                <select name="origen" id="origen" class="form-control">
                                    <option value= "0" selected>Tots</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}" >{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lblcentro" class=" col-form-label">Centro destino</label>
                            <div class="">
                                <select name="destino" id="destino" class="form-control">
                                    <option value= "0" selected>Tots</option>
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}" >{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lblanimales" class=" col-form-label">Animales</label>
                            <div class="">
                                <select name="animales" id="animales" class="form-control">
                                    <option value= "0" selected>Tots</option>
                                    @foreach ($animales as $animal)
                                        <option value="{{$animal->id}}">{{$animal->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id ="lblvalor"for="valor" class="col-form-label">Valor a mostrar</label>
                            <div class="">
                                <select name="valor" id="valor" class="form-control">
                                    <option value="cash">Diners(€)</option>
                                    <option value="uu">Unitats</option>
                                    <option value="donacions">Donacions</option>
                                </select>
                            </div>
                    </div>


                        <div class="form-group">
                            <label for="lbltipus_grafic" class="col-form-label">Tipus gràfic</label>
                            <div class="">
                                <select name="tipus_grafic" id="tipus_grafic" class="form-control">
                                    <option value="bar">Barres</option>
                                    <option value="pie">Pastís</option>
                                    <option value="horizontalBar">Barres Horitzontals</option>
                                    <option value="doughnut">Donut</option>
                                    <option value="line">Linies</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblordenar" class="col-form-label">Ordenar per</label>
                            <div class="">
                                <select name="ordenar" id="ordenar" class="form-control" >
                                    <option value="tipus" selected>Tipus Donació</option>
                                    {{-- <option value="subtipus" selected>Subtipus Donació</option> --}}
                                    <option value="animals">Animal</option>
                                    <option value="desti">Centre destí</option>
                                    <option value="origen">Centre recollida</option>
                                </select>
                            </div>
                    </div>

                        <div class="form-group">
                            <div class="col-5 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="cPublic" id="cPublic">
                                <label class="custom-control-label" for="cPublic">Fer la estadística pública</label>
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <button type="button" class="btn btn-secondary boton-amplada mr-1" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</div>
<!-- modal objectius -->
<div class="modal fade" id="modalGraficObjectius" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nou gràfic de objectius</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" action="{{ action('GraficoController@store') }}" method="POST">
                    @csrf
                    <input type="hidden" name = 'modal' value = 'o' id = 'o'>
                    <div class="form-group">
                        <label for="lblnombre" class=" col-form-label">Nom de la gràfica</label>
                        <div class="">
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nom" required maxlength="20">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lbldesc" class=" col-form-label">Descripció</label>
                        <div class="">
                            <input type="text" name="desc" id="desc" class="form-control" placeholder="Descripció" maxlength="200">
                        </div>
                    </div>
                    <div class="form-group">
                            <label id ="lbloTipoData" for="oTipoData" class="col-form-label">Tipus de data</label>
                            <div class="">
                                <select name="oTipoData" id="oTipoData" class="form-control oTipoData">
                                    <option value="dinamic" selected>Dinamica</option>
                                    <option value="fixe">Fixe</option>
                                </select>
                            </div>
                    </div>
                    <div class="row interval" id = "oInterval">
                        <div class="form-group col-7 col-md-9 pr-0">
                            <label for="cantidad" class="col-form-label">Quantitat</label>
                            <div class="">
                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Quantitat" value="30">
                            </div>
                        </div>
                        <div class="form-group col-5 col-md-3">
                            <label for="medida" class="col-form-label">Mesura</label>
                            <div class="">
                                <select name="medida" id="medida" class="form-control">
                                    <option value="dd">Dies</option>
                                    <option value="mm">Mesos</option>
                                    <option value="aaaa">Anys</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row fixe" id = "oFixe">
                        <div class="form-group col-6">
                            <label for="dataInit" class="col-form-label">Data Inicial</label>
                            <div class="">
                                <input type="date" name="dataInit" id="dataInit" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="dataFin" class="col-form-label">Data Final</label>
                            <div class="">
                                <input type="date" name="dataFin" id="dataFin" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lbltipos_donacion" class=" col-form-label">Tipo de donacion</label>

                        <div class = "row">
                            <div class="col-7 col-md-9 pr-0">
                                @foreach ($tipos as $tipo)
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">

                                            <input type="checkbox" class="custom-control-input tipo_donacion" data-tipo="{{$tipo->nombre}}" name="o{{$tipo->nombre}}" id="o{{$tipo->nombre}}">
                                            <label class="custom-control-label" for="o{{$tipo->nombre}}">{{$tipo->nombre}}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-5 col-md-3">
                                @foreach ($tipos as $tipo)
                                    <input type="number" id = "objectiu{{$tipo->nombre}}" step="0.01" name="objectiu{{$tipo->nombre}}" class="form-control">
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                            <label id ="lblvalor"for="valor" class="col-form-label">Valor a mostrar</label>
                            <div class="">
                                <select name="valor" id="valor" class="form-control">
                                    <option value="cash">Diners(€)</option>
                                    <option value="uu">Unitats</option>
                                    <option value="donacions">Donacions</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group">
                        <label for="lblcentro" class=" col-form-label">Centro origen</label>
                        <div class="">
                            <select name="origen" id="origen" class="form-control">
                                <option value= "0" selected>Tots</option>
                                @foreach ($centros as $centro)
                                    <option value="{{$centro->id}}" >{{$centro->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lblcentro" class=" col-form-label">Centro destino</label>
                        <div class="">
                            <select name="destino" id="destino" class="form-control">
                                <option value= "0" selected>Tots</option>
                                @foreach ($centros as $centro)
                                    <option value="{{$centro->id}}" >{{$centro->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="lblanimales" class=" col-form-label">Animales</label>
                            <div class="">
                                <select name="animales" id="animales" class="form-control">
                                    <option value= "0" selected>Tots</option>
                                    @foreach ($animales as $animal)
                                        <option value="{{$animal->id}}">{{$animal->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="lbltipus_grafic" class="col-form-label">Tipus gràfic</label>
                        <div class="">
                            <select name="tipus_grafic" id="tipus_grafic" class="form-control">
                                <option value="bar">Barres</option>
                                <option value="pie">Pastís</option>
                                <option value="horizontalBar">Barres Horitzontals</option>
                                <option value="doughnut">Donut</option>
                                <option value="line">Linies</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lblordenar" class="col-form-label">Ordenar per</label>
                        <div class="">
                            <select name="ordenar" id="ordenar" class="form-control" >
                                <option value="tipus" selected>Tipus Donació</option>
                                {{-- <option value="subtipus" selected>Subtipus Donació</option> --}}
                                <option value="animals">Animal</option>
                                <option value="desti">Centre destí</option>
                                <option value="origen">Centre recollida</option>
                            </select>
                        </div>
                </div>


                    <div class="form-group">
                        <div class="col-5 custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="oPublic" id="oPublic">
                            <label class="custom-control-label" for="oPublic">Fer la estadística pública</label>
                        </div>
                    </div>

                    <div class="form-group float-right">
                        <button type="button" class="btn btn-secondary boton-amplada mr-1" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection
