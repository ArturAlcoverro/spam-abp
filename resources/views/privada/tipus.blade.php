@extends('privada.templates.master')

@section('name')
    @lang('tipus.type')
@endsection

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

    <h1>@lang('tipus.type')</h1>

    <div class="toolbar mt-3">
        <a title="@lang('master.add_crud')" class="btn btn-secondary buttons-html5" data-toggle="modal" data-target="#create-modal">
            <img height="0px" src="{{ asset('media/img/add.png') }}" alt="">
        </a>
        <a title="@lang('master.edit_crud')" class="btn btn-secondary buttons-html5" onclick="openEdit()">
            {{-- data-toggle="modal" data-target="#edit-modal" --}}
            <img height="0px" src="{{ asset('media/img/edit.png') }}" alt="">
        </a>
        <button onclick="deleteTipus()" title="@lang('master.delete_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/delete.png') }}" alt="">
        </button>
        <a href='{{url('/subtipos')}}' title="@lang('master.subtipus_crud')" class="btn btn-secondary buttons-html5">
            <img height="0px" src="{{ asset('media/img/subtipus.png') }}" alt="">
        </a>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="create-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('tipus.new')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="container pt-2" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="addNombre" class="col-form-label">@lang('tipus.name')</label>
                                <div class="">
                                    <input name="addNombre" id="addNombre" type="text" placeholder="@lang('tipus.name')" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer pt-0 border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('tipus.close')</button>
                    <button onclick="addTipus()" type="button" class="btn btn-primary" data-dismiss="modal">@lang('tipus.accept')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('tipus.edit')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="container pt-2" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="editNombre" class="col-form-label">@lang('tipus.name')</label>
                                <div class="">
                                    <input name="editNombre" id="editNombre" type="text" placeholder="@lang('tipus.name')" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer pt-0 border-0">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('tipus.close')</button>
                    <button onclick="editTipus()" type="button" class="btn btn-primary" data-dismiss="modal">@lang('tipus.accept')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="toolbar-append">

    </div>

    <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>@lang('tipus.id')</th>
                    <th>@lang('tipus.name')</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
