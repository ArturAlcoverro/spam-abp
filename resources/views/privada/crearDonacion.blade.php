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
                <p id="nombreParticular"><span></span></p>
                <p id="dniParticular"><span></span></p>
            </div>

            <div id="infoEmpresa" style="display: none">
                <p id="nombreEmpresa"><span></span></p>
                <p id="dniEmpresa"><span></span></p>
            </div>
        </div>

        <h3 class="mt-5">Crea una donació</h3>
        <div class="buttons">
            <button id="btnMaterials" class="btn-donatiu">
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
@endsection

