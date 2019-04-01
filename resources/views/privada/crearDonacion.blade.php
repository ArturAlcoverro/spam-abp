@extends('privada.templates.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
<script src="{{asset('js/eventsCrearDonacio.js')}}"></script>
@endsection

@section('body')
    @if (Session::has('dni'))
        <script>getDonant("{{Session::get('dni')}}", setDonant)</script>
    @endif
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nova donació</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container " method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="lbltipos_donacion" class=" col-form-label">Tipo de donacion</label>
                            <div class="">
                                <select name="tipos_donacion" id="tipos_donacion" class="form-control">
                                    <option value="comida">Comida</option>
                                    <option value="">Veterinaria</option>
                                    <option value="">Oficinas</option>
                                    <option value="">Complementos</option>
                                    <option value="">Encants</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblsubtipos_donacion" class=" col-form-label">Subtipo de donacion</label>
                            <div class="">
                                <select name="subtipos_donacion" id="subtipos_donacion" class="form-control">
                                    <option value="comida">Comida</option>
                                    <option value="">Veterinaria</option>
                                    <option value="">Oficinas</option>
                                    <option value="">Complementos</option>
                                    <option value="">Encants</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_receptor" class=" col-form-label">Centro receptor</label>
                            <div class="">
                                <select name="centro_receptor" id="centro_receptor" class="form-control">
                                    <option value="comida">Servicios centrales</option>
                                    <option value="">Espacio veterinario</option>
                                    <option value="">Refugio Cal Pilè</option>
                                    <option value="">CCACC</option>
                                    <option value="">Refugio Can Moret</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_destino" class=" col-form-label">Centro destino</label>
                            <div class="">
                                <select name="centro_destino" id="centro_destino" class="form-control">
                                    <option value="comida">Servicios centrales</option>
                                    <option value="">Espacio veterinario</option>
                                    <option value="">Refugio Cal Pilè</option>
                                    <option value="">CCACC</option>
                                    <option value="">Refugio Can Moret</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label for="unidades" class="col-form-label">Unidades</label>
                            <div class="">
                                <input type="text" name="unidades" id="unidades" class="form-control" placeholder="Unidades">
                            </div>
                        </div> --}}
                        <div class="form-group">
                            <label for="cantidad" class="col-form-label">Cantidad</label>
                            <div class="">
                                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblunidades" class="col-form-label">Unidades</label>
                            <div class="">
                                <select name="unidades" id="unidades" class="form-control">
                                    <option value="">-</option>
                                    <option value="comida">Kg</option>
                                    <option value="">g</option>
                                    <option value="">L</option>
                                    <option value="">multiple</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coste" class="col-form-label">Coste</label>
                            <div class="">
                                <input type="text" name="coste" id="coste" class="form-control" placeholder="Coste">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="animales" class=" col-form-label">Va dirigida a algun animal?</label>
                            <div class="">
                                <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select">
                                   <option value="">Perro</option>
                                   <option value="">Gato</option>
                                   <option value="">Hurón</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-3"></div>
                            <div class="col-3">
                                <input type="checkbox" name="spam" id="spam" class="form-check-input">Es coordinada</input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre" class="col-form-label">Factura</label>
                            <div class="">
                                <input type="file" name="nombre" id="nombre">
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
