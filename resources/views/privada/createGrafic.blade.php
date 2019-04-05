@extends('privada.templates.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
<script src="{{asset('js/eventsCrearDonacio.js')}}"></script>
<script src="{{asset('js/eventsCreateGrafic.js')}}"></script>
@endsection

@section('body')
    <script>
        var subtipos = {!! json_encode($subtipos->toArray()) !!};
    </script>


<div class="p-5 d-inline-block">
    <h3 class="mt-5">Crea un gràfic</h3>
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


<div class="modal fade" id="modalGrafic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nou gràfic</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" id="formMaterial" method="POST">
                    @csrf

                        <div class="form-group">
                            <label for="lblnombre" class=" col-form-label">Nom de la gràfica</label>
                            <div class="">
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nom" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lbltipos_donacion" class=" col-form-label">Tipo de donacion</label>
                            <div class="">
                                <select name="tipos_donacion" id="tipos_donacion" class="form-control">
                                    <option value= "-1" selected>Tots</option>
                                    @foreach ($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>                                
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblsubtipos_donacion" class="col-form-label">Subtipo de donacion</label>
                            <div class="">
                                <select name="subtipos_donacion" id="subtipos_donacion" class="form-control">
                                    <option value= "-1" selected>Tots</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lblcentro_destino" class=" col-form-label">Centro destino</label>
                            <div class="">
                                <select name="centro_destino" id="centro_destino" class="form-control">
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}" selected>{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label id ="lblvalor"for="lblvalor" class="col-form-label">Valor a mostrar</label>
                            <div class="row">              
                                <div class="col-7 col-md-9 pr-0">
                                    <input type="number" id = "objectiu" step="0.01" name="objectiu" class="form-control"  required>
                                </div>
                                <div class="col-5 col-md-3">
                                    <select name="valor" id="valor" class="form-control">
                                        <option value="cash">Diners(€)</option>
                                        <option value="pes">Pes(Kg)</option>
                                    </select>
                                </div>
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
                            <div class="col-3 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="public" id="public">
                                <label class="custom-control-label" for="public">Fer la estadística pública</label>
                            </div>
                        </div>

                        <div class="form-group float-right">
                            <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">Aceptar</button>
                        </div>
                    </form>

            </div>

        </div>
    </div>
</div>
@endsection
