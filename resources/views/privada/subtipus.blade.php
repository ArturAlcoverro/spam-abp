@extends('privada.templates.master')

@section('name')
    @lang('subtipus.subtype')
@endsection

@section('css')
    <script src="{{ asset('js/eventsIndexPrivat.js') }}"></script>
    <script src="{{ asset('js/eventsSubtipus.js') }}"></script>
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

    <h1>@lang('subtipus.subtype')</h1>

    <div class="toolbar mt-3">
        <a href="{{ action('SubtipoController@create') }}" title="@lang('master.add_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/add.png') }}" alt="">
        </a>
        <button onclick="editSubtipus()" title="@lang('master.edit_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/edit.png') }}" alt="">
            <form id="form_edit" action="" method="get">
                @csrf
            </form>
        </button>
        <button onclick="deleteSubtipus()" title="@lang('master.delete_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/delete.png') }}" alt="">
        </button>
        <button title="@lang('master.filter_crud')" class="btn btn-secondary buttons-html5" data-toggle="modal" data-target="#filter-modal">
            <img height="0px" src="{{ asset('media/img/filter.png') }}" alt="">
        </button>
        <a href='{{url('/tipos')}}' title="@lang('master.tipus_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/tipus.png') }}" alt="">
        </a>
    </div>

    <div class="toolbar-append">

    </div>

    <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>@lang('subtipus.id')</th>
                    <th>@lang('subtipus.name')</th>
                    <th>@lang('subtipus.type')</th>
                    <th>@lang('subtipus.high')</th>
                    <th>@lang('subtipus.medium')</th>
                    <th>@lang('subtipus.low')</th>
                    <th>@lang('subtipus.unit')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
