@extends('privada.templates.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
<script src="{{asset('js/eventsCrearDonacio.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
@endsection

@section('body')
    @if (Session::has('dni'))
        <script>

        getDonant("{{Session::get('dni')}}",
        function (data) {
                if (data.length != 0) {
                    $('.not-found').addClass('d-none');
                    $('.empty-error').addClass('d-none');
                    $('#modalEmpresa').modal('hide');
                    isDonante = true;
                    setDonant(data);
                    console.log(data);
                }
                else {
                    $('.not-found').removeClass('d-none');
                    $('.empty-error').addClass('d-none');
                }
                $('.spinner').addClass('d-none');
                $this.show();
            });

        </script>
    @endif
    <script>
        var idUsuario = {{Auth::user()->id}}
        var subtipos = {!! json_encode($subtipos->toArray()) !!};
        var centros = {!! json_encode($centros->toArray()) !!};
        var particulares = {!! json_encode($particulares->toArray()) !!};
        var empresas = {!! json_encode($empresas->toArray()) !!};

        var tipoDiners;
        subtipos.forEach(element => {
            if(element.nombre.toLowerCase() == 'diners'){
                tipoDiners = element.id;
            }
        });
    </script>

<div class="p-5 d-block all">

    <div class="d-flex">
        <h3 id="titleDonant" class="d-inline-block">Selecciona un donant</h3>
        <button class="showHide" style="display: none">
            <img src="{{ asset('media/img/up.png') }}" alt="">
        </button>
    </div>
    <div class="buttons" id="donante">
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

    <button onclick="pdf()">Descargar certificado</button>

    <h3 class="mt-4">Crea una donació</h3>
    <div class="buttons">
        <button id="btnMaterial" class="btn-donatiu">
            <p>Material</p>
        </button>
        <button id="btnDiners" class="btn-donatiu">
            <p>Diners</p>
        </button>
    </div>

    <div id="donacions" class="mb-5" style="display: none">
        <h3 class="mt-4 mb-3">Donacions</h3>

        <table id="tablaDonacions" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Valor</th>
                    <th>Subtipo</th>
                    <th>Centro Origen</th>
                    <th>Centro Destino</th>
                    <th>Id</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <button type="button" id="btnSubmit" class="float-right btn btn-primary boton-amplada mt-3">Aceptar</button>
        <button type="button" class="float-right btn btn-secondary boton-amplada mr-2 mt-3">Cancelar</button>
    </div>

</div>

{{-- Modal insertar DNI --}}
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

{{-- Modal insertar CIF --}}
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

{{-- Modal agregar donació material --}}
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
                <form class="container" id="formMaterial" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="lbltipo_donacion" class=" col-form-label">Tipo de donacion</label>
                            <div class="">
                                <select name="tipo_donacion" id="tipo_donacion" class="form-control">
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
                            <label for="lblsubtipo_donacion" class="col-form-label">Subtipo de donacion</label>
                            <div class="">
                                <select required name="subtipo_donacion" id="subtipo_donacion" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_receptor" class=" col-form-label">Centro receptor</label>
                            <div class="">
                                <select name="centro_receptor" id="centro_receptor" class="form-control">
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_destino" class=" col-form-label">Centro destino</label>
                            <div class="">
                                <select name="centro_destino" id="centro_destino" class="form-control">
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidades" class="col-form-label">Unidades</label>
                            <div class="">
                                <input type="number" name="unidades" id="unidades" class="form-control" placeholder="Unidades">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cantidad" class="col-form-label">Cantidad p.u. <span id="unidadMedida"></span></label>
                            <div class="">
                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coste" class="col-form-label">Valor estimado (€)</label>
                            <div class="">
                                <input type="number" step="0.01" name="coste" id="coste" class="form-control" placeholder="Coste">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coste" class="col-form-label">Gama</label>
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input checked data-value='Baja' value="Baja" type="radio" id="radioBaja" name="radioGama" class="custom-control-input">
                                    <label class="custom-control-label" for="radioBaja">Baja</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input data-value='Media' value="Media" type="radio" id="radioMedia" name="radioGama" class="custom-control-input">
                                    <label class="custom-control-label" for="radioMedia">Media</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input data-value='Alta' type="radio" id="radioAlta" name="radioGama" class="custom-control-input">
                                    <label class="custom-control-label" for="radioAlta">Alta</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="animales" class=" col-form-label">Va dirigida a algun animal?</label>
                            <div class="">
                                <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select p-0">
                                    @foreach ($animales as $animal)
                                        <option value="{{$animal->id}}">{{$animal->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="overflow: hidden">
                            <label for="factura" class="col-form-label d-block">Factura</label>
                            <input type="file" name="factura" id="factura">
                        </div>
                        <div class="form-group">
                            <div class="col-3 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="coordinada" id="coordinada">
                                <label class="custom-control-label" for="coordinada">Es coordinada</label>
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

{{-- Modal agregar donació diners --}}
<div class="modal fade" id="modalDiners" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Nova donació</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" id="formDiners" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="costeDiners" class="col-form-label">Importe (€)</label>
                        <div class="">
                            <input type="number" required min="1" step="0.01" name="costeDiners" id="costeDiners" class="form-control" placeholder="Importe">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="centro_receptor_diners" class=" col-form-label">Centro receptor</label>
                        <select name="centro_receptor_diners" id="centro_receptor_diners" class="form-control">
                            @foreach ($centros as $centro)
                                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="centro_destino_diners" class="col-form-label">Centro destino</label>
                        <select name="centro_destino_diners" id="centro_destino_diners" class="form-control">
                            @foreach ($centros as $centro)
                                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="overflow: hidden">
                        <label for="FacturaDiners" class="col-form-label d-block">Factura</label>
                         <div class="">
                            <input type="file" class="" name="FacturaDiners" id="FacturaDiners">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-3 custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="spamDiners" id="spamDiners">
                            <label class="custom-control-label" for="spamDiners">Es coordinada</label>
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

{{-- Modal detall donació --}}
<div class="modal fade" id="modalDetall" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">Informació donació</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detall">
                <p>Valor: <span class="valor"></span></p>
                <p>Subtipo: <span class="subtipus"></span></p>
                <p>Centro origen: <span class="origen"></span></p>
                <p>Centro destino: <span class="desti"></span></p>
                <p>Unidades: <span class="unitats"></span></p>
                <p>Cantidad p.u: <span class="cantitat"></span></p>
                <p>Para animal: <span class="animals"></span></p>
                <p>Es coordinada: <span class="coordinada"></span></p>
            </div>

        </div>
    </div>
</div>



@endsection
