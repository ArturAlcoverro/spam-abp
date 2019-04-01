@extends('privada.templates.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/donantes.css') }}">
@endsection

@section('body')

    @include('partial.errores')

    <div class="p-4">
        <form class="container pt-2" method="POST">
        @csrf
            <h3>Nueva donacion</h3>
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

@endsection

@section('js')

    <script src="{{ asset('js/eventsDonants.js') }}"></script>

@endsection
