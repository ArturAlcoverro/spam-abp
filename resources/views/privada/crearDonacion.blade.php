@extends('privada.templates.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/crearDonacio.css') }}">
    <script src="{{asset('js/eventsCrearDonacio.js')}}"></script>
@endsection
@section('body')
@if (Session::has('dni'))
    <script>getDonant("{{Session::get('dni')}}")</script>
@endif
    <div class="p-5">
        <h3>Selecciona un tipus de donant</h3>
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
                </div>
                <button id="cargaDni" type="button" class="btn btn-primary float-right">Cargar donante</button>
                <div class="spinner-border float-right d-none mr-2" role="status">
                        <span class="sr-only">Loading...</span>
                </div>
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
                        <small class="form-text text-muted"></small>
                    </div>
                    <button type="button" class="btn btn-primary float-right">Cargar donante</button>
                    <div class="spinner-border float-right d-none mr-2" role="status">
                            <span class="sr-only">Loading...</span>
                    </div>
                </div>

              </div>
            </div>
          </div>
@endsection

