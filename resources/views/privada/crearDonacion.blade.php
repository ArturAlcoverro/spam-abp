@extends('privada.templates.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
<script src="{{asset('js/eventsCrearDonacio.js')}}"></script>
@endsection

@section('body')
    @if (Session::has('dni'))
        <script>getDonant("{{Session::get('dni')}}", setDonant)</script>
    @endif
    <script>
        var subtipos = {!! json_encode($subtipos->toArray()) !!};
    </script>


<div class="p-5 d-inline-block">
    <h3 id="titleDonant">Selecciona un donant</h3>
    <div class="buttons">
        <button id="btnParticular" class="btn-donant">
            <p>Particular</p>
        </button>
        <button id="btnEmpresa" class="btn-donant">
            <p>Empresa</p>
        </button>
        <button id="btnAnonim" class="btn-donant">
            <p>Anònim</p>
        </button>
        <form action="{{ action('DonanteController@create') }}" method="get">
            <input type="hidden" name="back">
            <button id="btnNou" class="btn-donant">
                <p>Nou</p>
            </button>
        </form>
        <button id="btnParticularDelete" class="btn-donant closeBtn" style="display: none">
            <p>Particular</p>
        </button>
        <button id="btnEmpresaDelete" class="btn-donant closeBtn" style="display: none">
            <p>Empresa</p>
        </button>
        <button id="btnAnonimDelete" class="btn-donant closeBtn" style="display: none">
            <p>Anònim</p>
        </button>
        <div id="infoParticular" style="display: none">
            <p id="nombreParticular">
                <span></span>
            </p>
            <p id="dniParticular">
                <span></span>
            </p>
        </div>

        <div id="infoEmpresa" style="display: none">
            <p id="nombreEmpresa">
                <span></span>
            </p>
            <p id="dniEmpresa">
                <span></span>
            </p>
        </div>
    </div>

    <h3 class="mt-5">Crea una donació</h3>
    <div class="buttons">
        <button id="btnMaterial" class="btn-donatiu">
            <p>Material</p>
        </button>
        <button id="btnDiners" class="btn-donatiu">
            <p>Diners</p>
        </button>
    </div>

</div>

<div class="modal fade" id="modalParticular" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">DNI del particular</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input id="dni" type="text" class="form-control" maxlength="9">
                    <small class="not-found form-text text-danger d-none ml-1">No se ha encontrado ningun particular con este DNI.</small>
                    <small class="empty-error form-text text-muted d-none ml-1">Escribe el DNI del particular</small>
                </div>
                <button id="cargaDni" type="button" class="btn btn-primary float-right">Cargar donante</button>
                <div class="spinner float-right mr-2 d-none"></div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">CIF de la empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" maxlength="9">
                    <small class="not-found form-text text-danger d-none ml-1">No se ha encontrado ninguna empresa con este CIF.</small>
                    <small class="empty-error form-text text-muted d-none ml-1">Escribe el CIF de la empresa</small>
                </div>
                <button type="button" class="btn btn-primary float-right">Cargar donante</button>
                <div class="spinner float-right mr-2 d-none"></div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nova donació</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" id="formMaterial" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="lbltipos_donacion" class=" col-form-label">Tipo de donacion</label>
                            <div class="">
                                <select name="tipos_donacion" id="tipos_donacion" class="form-control">
                                    @foreach ($tipos as $tipo)
                                        @if ($tipo->nombre != "Diners")
                                            @if ($tipo->id == 1)
                                                <option value="{{$tipo->id}}" selected>{{$tipo->nombre}}</option>
                                            @else
                                                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblsubtipos_donacion" class="col-form-label">Subtipo de donacion</label>
                            <div class="">
                                <select name="subtipos_donacion" id="subtipos_donacion" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_receptor" class=" col-form-label">Centro receptor</label>
                            <div class="">
                                <select name="centro_receptor" id="centro_receptor" class="form-control">
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}" selected>{{$centro->nombre}}</option>
                                    @endforeach
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
                            <label for="unidades" class="col-form-label">Unidades</label>
                            <div class="">
                                <input type="number" name="unidades" id="unidades" class="form-control" placeholder="Unidades" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-7 col-md-9 pr-0">
                                <label for="cantidad" class="col-form-label">Cantidad p.u.</label>
                                <div class="">
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad">
                                </div>
                            </div>
                            <div class="form-group col-5 col-md-3">
                                <label for="lblunidades" class="col-form-label">Medida</label>
                                <div class="">
                                    <select name="unidades" id="unidades" class="form-control">
                                        <option value="">kg</option>
                                        <option value="">g</option>
                                        <option value="">l</option>
                                        <option value="">ml</option>
                                        <option value="">cm</option>
                                        <option value="">m</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coste" class="col-form-label">Coste (€)</label>
                            <div class="">
                                <input type="number" step="0.01" name="coste" id="coste" class="form-control" placeholder="Coste">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="animales" class=" col-form-label">Va dirigida a algun animal?</label>
                            <div class="">
                                <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select p-0">
                                   <option value="">Perro</option>
                                   <option value="">Gato</option>
                                   <option value="">Hurón</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="spam" id="spam">
                                <label class="custom-control-label" for="spam">Es coordinada</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="col-form-label d-block">Factura</label>
                             <div class="">
                                <input type="file" class="" name="nombre" id="nombre">
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
