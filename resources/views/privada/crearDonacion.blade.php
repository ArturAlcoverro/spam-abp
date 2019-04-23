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
    <p id="user" hidden>{{ Auth::user()->nombre }}</p>
    <div class="d-flex">
        <h3 id="titleDonant" class="d-inline-block">@lang('createDonacio.titleDonant')</h3>
        <button class="showHide" style="display: none">
            <img src="{{ asset('media/img/up.png') }}" alt="">
        </button>
    </div>
    <div class="buttons" id="donante">
        <button id="btnParticular" class="btn-donant">
            <p>@lang('createDonacio.particular')</p>
        </button>
        <button id="btnEmpresa" class="btn-donant">
            <p>@lang('createDonacio.empresa')</p>
        </button>
        <button id="btnAnonim" class="btn-donant">
            <p>@lang('createDonacio.anonim')</p>
        </button>
        <form action="{{ action('DonanteController@create') }}" method="get">
            <input type="hidden" name="back">
            <button id="btnNou" class="btn-donant">
                <p>@lang('createDonacio.nou')</p>
            </button>
        </form>
        <button id="btnParticularDelete" class="btn-donant closeBtn" style="display: none">
            <p>@lang('createDonacio.particular')</p>
        </button>
        <button id="btnEmpresaDelete" class="btn-donant closeBtn" style="display: none">
            <p>@lang('createDonacio.empresa')</p>
        </button>
        <button id="btnAnonimDelete" class="btn-donant closeBtn" style="display: none">
            <p>@lang('createDonacio.anonim')</p>
        </button>
        <div id="infoParticular" style="display: none">
            <p id="nombreParticular">
                <span></span>
            </p>
            <p id="dniParticular">
                <span></span>
            </p>
            <p id="correuParticular">
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
            <p id="correuEmpresa">
                <span></span>
            </p>
        </div>
    </div>

    <h3 class="mt-4">@lang('createDonacio.creaDonacio')</h3>
    <div class="buttons">
        <button id="btnMaterial" class="btn-donatiu">
            <p>@lang('createDonacio.material')</p>
        </button>
        <button id="btnDiners" class="btn-donatiu">
            <p>@lang('createDonacio.diners')</p>
        </button>
    </div>

    <div id="donacions" class="mb-5" style="display: none">
        <h3 class="mt-4 mb-3">@lang('createDonacio.donacions')</h3>

        <table id="tablaDonacions" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>@lang('createDonacio.tableValor')</th>
                    <th>@lang('createDonacio.tableSubtipo')</th>
                    <th>@lang('createDonacio.tableOrigen')</th>
                    <th>@lang('createDonacio.tableDestino')</th>
                    <th>@lang('createDonacio.tableId')</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <button class="btn mt-3 bg-blue" onclick="validarCertificado()">@lang('createDonacio.btnCertificat')</button>
        <button type="button" id="btnSubmit" class="float-right btn btn-primary boton-amplada mt-3">@lang('createDonacio.btnAceptar')</button>
        <a href="{{ action('DonativoController@index') }}" class="float-right btn btn-secondary boton-amplada mr-2 mt-3">@lang('createDonacio.btnCancelar')</a>
    </div>

</div>

{{-- Modal insertar DNI --}}
<div class="modal fade" id="modalParticular" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">@lang('createDonacio.seleccionarParticular')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <table id="table-particulars" class="table table-hover table-striped display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>@lang('createDonacio.tableNom')</th>
                                <th>@lang('createDonacio.tableDni')</th>
                                <th>@lang('createDonacio.tableCorreu')</th>
                                <th>@lang('createDonacio.tableId')</th>
                                <th>@lang('createDonacio.tableTipo')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($particulares as $particular)
                            <tr>
                                <td>{{$particular->nombre}}</td>
                                <td>{{$particular->cif}}</td>
                                <td>{{$particular->correo}}</td>
                                <td>{{$particular->id}}</td>
                                <td>{{$particular->tipos_donantes_id}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                <button id="seleccionarParticular" type="button" class="btn btn-primary float-right mt-3">@lang('createDonacio.btnSelect')</button>
                <div class="spinner float-right mr-2 d-none"></div>
            </div>

        </div>
    </div>
</div>

{{-- Modal insertar CIF --}}
<div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle">@lang('createDonacio.seleccionarEmpresa')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <table id="table-empresas" class="table table-hover table-striped display responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>@lang('createDonacio.tableNom')</th>
                                <th>@lang('createDonacio.tableDni')</th>
                                <th>@lang('createDonacio.tableCorreu')</th>
                                <th>@lang('createDonacio.tableId')</th>
                                <th>@lang('createDonacio.tableTipo')</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($empresas as $empresa)
                            <tr>
                                <td>{{$empresa->nombre}}</td>
                                <td>{{$empresa->cif}}</td>
                                <td>{{$empresa->correo}}</td>
                                <td>{{$empresa->id}}</td>
                                <td>{{$empresa->tipos_donantes_id}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                <button id="seleccionarEmpresa" type="button" class="btn btn-primary float-right mt-3">@lang('createDonacio.btnSelect')</button>
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
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('createDonacio.novaDonacio')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" id="formMaterial" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="lbltipo_donacion" class=" col-form-label">@lang('createDonacio.lblTipus')</label>
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
                            <label for="lblsubtipo_donacion" class="col-form-label">@lang('createDonacio.lblSubtipus')</label>
                            <div class="">
                                <select required name="subtipo_donacion" id="subtipo_donacion" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_receptor" class=" col-form-label">@lang('createDonacio.lblReceptor')</label>
                            <div class="">
                                <select name="centro_receptor" id="centro_receptor" class="form-control">
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lblcentro_destino" class=" col-form-label">@lang('createDonacio.lblOrigen')</label>
                            <div class="">
                                <select name="centro_destino" id="centro_destino" class="form-control">
                                    @foreach ($centros as $centro)
                                        <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unidades" class="col-form-label">@lang('createDonacio.lblUnidades')</label>
                            <div class="">
                                <input type="number" name="unidades" id="unidades" class="form-control" placeholder="@lang('createDonacio.phUnidades')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cantidad" class="col-form-label">@lang('createDonacio.lblCantidad')<span id="unidadMedida"></span></label>
                            <div class="">
                                <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="@lang('createDonacio.phCantidad')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coste" class="col-form-label">@lang('createDonacio.lblValor')</label>
                            <div class="">
                                <input type="number" step="0.01" name="coste" id="coste" class="form-control" placeholder="@lang('createDonacio.phCost')">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="radioGama" class="col-form-label">@lang('createDonacio.lblGama')</label>
                            <div class="btn bg-blue gamaHelp">?
                                <p class="gamaHelpText">@lang('createDonacio.gamaHelp')</p>
                            </div>
                            <div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input checked data-value='Baja' value="Baja" type="radio" id="radioBaja" name="radioGama" class="custom-control-input">
                                    <label class="custom-control-label" for="radioBaja">@lang('createDonacio.lblBaja')<span id="valorGamaBaja"></span></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input data-value='Media' value="Media" type="radio" id="radioMedia" name="radioGama" class="custom-control-input">
                                    <label class="custom-control-label" for="radioMedia">@lang('createDonacio.lblMedia')<span id="valorGamaMedia"></span></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input data-value='Alta' type="radio" id="radioAlta" name="radioGama" class="custom-control-input">
                                    <label class="custom-control-label" for="radioAlta">@lang('createDonacio.lblAlta')<span id="valorGamaAlta"></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="animales" class=" col-form-label">@lang('createDonacio.lblAnimal')</label>
                            <div class="">
                                <select name="animales[]" id="animales" size="5" multiple="multiple" class="custom-select p-0">
                                    @foreach ($animales as $animal)
                                        <option value="{{$animal->id}}">{{$animal->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" style="overflow: hidden">
                            <label for="factura" class="col-form-label d-block">@lang('createDonacio.lblFactura')</label>
                            <input type="file" name="factura" id="factura">
                        </div>
                        <div class="form-group">
                            <div class="col-3 custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="coordinada" id="coordinada">
                                <label class="custom-control-label" for="coordinada">@lang('createDonacio.lblCoordinada')</label>
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-secondary boton-amplada mr-1" data-dismiss="modal">@lang('createDonacio.btnCancelar')</button>
                            <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">@lang('createDonacio.btnAceptar')</button>
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
                <h5 class="modal-title" id="exampleModalLongTitle">@lang('createDonacio.novaDonacio')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="container" id="formDiners" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="costeDiners" class="col-form-label">@lang('createDonacio.lblImporte')</label>
                        <div class="">
                            <input type="number" required min="1" step="0.01" name="costeDiners" id="costeDiners" class="form-control" placeholder="@lang('createDonacio.phImporte')">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="centro_receptor_diners" class=" col-form-label">@lang('createDonacio.lblReceptor')</label>
                        <select name="centro_receptor_diners" id="centro_receptor_diners" class="form-control">
                            @foreach ($centros as $centro)
                                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="centro_destino_diners" class="col-form-label">@lang('createDonacio.lblOrigen')</label>
                        <select name="centro_destino_diners" id="centro_destino_diners" class="form-control">
                            @foreach ($centros as $centro)
                                <option value="{{$centro->id}}">{{$centro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="overflow: hidden">
                        <label for="FacturaDiners" class="col-form-label d-block">@lang('createDonacio.lblFactura')</label>
                         <div class="">
                            <input type="file" class="" name="FacturaDiners" id="FacturaDiners">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-3 custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="spamDiners" id="spamDiners">
                            <label class="custom-control-label" for="spamDiners">@lang('createDonacio.lblCoordinada')</label>
                        </div>
                    </div>
                    <div class="form-group float-right">
                        <button type="button" class="btn btn-secondary boton-amplada mr-1" data-dismiss="modal">@lang('createDonacio.btnCancelar')</button>
                        <button type="submit" name="altaAceptar" class="btn btn-primary boton-amplada">@lang('createDonacio.btnAceptar')</button>
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
                <h4 class="modal-title" id="exampleModalLongTitle">@lang('createDonacio.infoDonacio')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detall">
                <p>@lang('createDonacio.viewValor')<span class="valor"></span></p>
                <p>@lang('createDonacio.viewSubtipo')<span class="subtipus"></span></p>
                <p>@lang('createDonacio.viewOrigen')<span class="origen"></span></p>
                <p>@lang('createDonacio.viewDestino')<span class="desti"></span></p>
                <p>@lang('createDonacio.viewUnidades')<span class="unitats"></span></p>
                <p>@lang('createDonacio.viewCantidad')<span class="cantitat"></span></p>
                <p>@lang('createDonacio.viewAnimal')<span class="animals"></span></p>
                <p>@lang('createDonacio.viewCoordinada')<span class="coordinada"></span></p>
            </div>

        </div>
    </div>
</div>



@endsection
