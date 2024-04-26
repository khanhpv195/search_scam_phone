@extends('adminlte::page')

@section('title', 'Phones')


@section('plugins.Datatables', true)

@section('content')
    <table id="example" class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Số điện thoại</th>
            <th>Danh mục</th>
            <th>Thông tin thêm</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($phones as $phone)
            <tr>
                <td>{{$phone->id}}</td>
                <td>{{$phone->phone_number}}</td>
                <td>{{$phone->business_name}}</td>
                <td>{{$phone->additional_info}}</td>
                <td>
                    <a href="#" class="btn btn-primary">Edit</a>
                </td>
            </tr>
        @endforeach
    </table>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@stop
