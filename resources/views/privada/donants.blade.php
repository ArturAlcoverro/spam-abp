@extends('privada.templates.master')

@section('body')

<table class="table">
    <thead>
        <tr>
            <th>edad</th>
            <th>nombre</th>
            <th>ciudad</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">1</td>
            <td>artur</td>
            <td>bcn</td>
        </tr>
        <tr>
            <td scope="row">3</td>
            <td>david</td>
            <td>bcn</td>
        </tr>
        <tr>
            <td scope="row">7</td>
            <td>samuel</td>
            <td>bcn</td>
        </tr>
        <tr>
            <td scope="row">9</td>
            <td>xavi</td>
            <td>venezuela</td>
        </tr>
        <tr>
            <td scope="row">1</td>
            <td>pere</td>
            <td>ny</td>
        </tr>
        <tr>
            <td scope="row">2</td>
            <td>anton</td>
            <td>paris</td>
        </tr>
        <tr>
            <td scope="row">1</td>
            <td>artur</td>
            <td>bcn</td>
        </tr>
        <tr>
            <td scope="row">3</td>
            <td>david</td>
            <td>bcn</td>
        </tr>
        <tr>
            <td scope="row">7</td>
            <td>samuel</td>
            <td>bcn</td>
        </tr>
        <tr>
            <td scope="row">9</td>
            <td>xavi</td>
            <td>venezuela</td>
        </tr>
        <tr>
            <td scope="row">1</td>
            <td>pere</td>
            <td>ny</td>
        </tr>
        <tr>
            <td scope="row">2</td>
            <td>anton</td>
            <td>paris</td>
        </tr>
    </tbody>
</table>

<script>$(document).ready(function () {
        $('.table').DataTable();
    });</script>
@endsection
