@extends('privada.templates.master') @section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"> @endsection @section('body')

<div class="p-5">
    <ul class="toolbar">
        <li title="Añadir">
            <a href="{{ route('createUser') }}">
                <img src="{{ asset('media/img/add.png') }}" alt="">
            </a>
        </li>
        <li title="Modificar">
                <img src="{{ asset('media/img/edit.png') }}" alt="">
            </li>
        <li title="Eliminar">
                <img src="{{ asset('media/img/delete.png') }}" alt="">
            </li>
        <li title="Consultar">
                <img src="{{ asset('media/img/save.png') }}" alt="">
        </li>
    </ul>
    <table id="table" class="table table-hover table-striped display responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>dcorredera</td>
                    <td>temp@gmail.com</td>
                    <td>David</td>
                    <td>Admin</td>
                </tr>
            </tbody>
        </table>
</div>

<script>$(document).ready(function () {
        $('#table').DataTable({
            select: {
                items: 'row'
            },

        });
    });</script> @endsection
