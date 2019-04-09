@extends('privada.templates.master')

@section('css')
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
    <script src="{{ asset('js/eventsTipus.js') }}"></script>
@endsection

@section('body')

<script>
    $(document).ready(function(){
        $('.buttons-copy').attr('title',"{{ __('master.copy_crud') }}");
        $('.buttons-excel').attr('title',"{{ __('master.xls_crud') }}");
        $('.buttons-pdf').attr('title',"{{ __('master.pdf_crud') }}");
        $('.buttons-print').attr('title',"{{ __('master.print_crud') }}");
    });
</script>
<div class="p-5">

    <h1>Tipus de donacions</h1>

    <div class="toolbar mt-3">
        <a href="{{ action('SubtipoController@create') }}" title="@lang('master.add_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/add.png') }}" alt="">
        </a>
        <button onclick="editTipus()" title="@lang('master.edit_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/edit.png') }}" alt="">
            <form id="form_edit" action="" method="get">
                @csrf
            </form>
        </button>
        <button onclick="deleteTipus()" title="@lang('master.delete_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/delete.png') }}" alt="">
        </button>
        <button title="@lang('master.filter_crud')" class="btn btn-secondary buttons-html5" data-toggle="modal" data-target="#filter-modal">
            <img height="0px" src="{{ asset('media/img/filter.png') }}" alt="">
        </button>
        <a href='{{url('/tipos')}}' title="@lang('master.Tipus_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/tipus.png') }}" alt="">
        </a>
    </div>

    <div class="toolbar-append">

    </div>

    <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
