@extends('privada.templates.master')

@section('name')
    Donantes
@endsection

@section('css')
    <script src="{{ asset('js/toast.js') }}"></script>
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
    <script src="{{ asset('js/eventsDonants.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('js/libraries/jspdf/zlib.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/libraries/jspdf/png.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/jspdf/addimage.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/jspdf/png_support.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/libraries/jspdf/jspdf.js') }}"></script> --}}
@endsection

@section('body')
    <script>
        $(document).ready(function(){
            $('.buttons-copy').attr('title',"{{ __('master.copy_crud') }}");
            $('.buttons-excel').attr('title',"{{ __('master.copy_crud') }}");
            $('.buttons-pdf').attr('title',"{{ __('master.copy_crud') }}");
            $('.buttons-print').attr('title',"{{ __('master.print_crud') }}");
        });
    </script>

    @include('partial.errores')

    <div class="p-5">

        <h1>@lang('donants.donants')</h1>

        <div class="toolbar mt-3">
            <button title="Añadir" class="btn btn-secondary buttons-html5">
                <a href="{{ action('DonanteController@create') }}">
                    <img src="{{ asset('media/img/add.png') }}" alt="">
                </a>
            </button>
            <button title="Modificar" class="btn btn-secondary buttons-html5">
                <div onclick="editDonant()">
                    <img src="{{ asset('media/img/edit.png') }}" alt="">
                    <form id="form_edit" action="" method="get">
                        @csrf
                    </form>
                </div>
            </button>
            <button title="Eliminar" class="btn btn-secondary buttons-html5">
                <div @if(Auth::user()->rol->id == 1) onclick="deleteDonant()" @else onclick="msgAdmin()" @endif>
                    <img src="{{ asset('media/img/delete.png') }}" alt="">
                    <form id="form_delete" action="" method="post">
                        @method('delete')
                        @csrf
                    </form>
                </div>
            </button>
        </div>
        <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>@lang('donants.name')</th>
                    <th>@lang('donants.cif')</th>
                    <th>@lang('donants.type')</th>
                    <th>@lang('donants.email')</th>
                    <th>@lang('donants.country')</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

@endsection
