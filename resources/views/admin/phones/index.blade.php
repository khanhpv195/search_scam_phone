@extends('adminlte::page')

@section('title', 'Phones')


@section('plugins.Datatables', true)

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
    <table id="example" class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
            <th>Số điện thoại</th>
            <th>Loại </th>
            <th>Số đẹp</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($phones as $phone)
            <tr>
                <td>{{$phone->id}}</td>
                <td>{{$phone->phone_number}}</td>
                <td>{{$phone->tag}}</td>
                <td>{{$phone->is_beauty ? 'Có' : 'Không'}}</td>
                <td>
                    <a href="/admin/phones/{{$phone->id}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                    <!-- Delete button as a form -->
                    <form action="/admin/phones/{{$phone->id}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this phone?');" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
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
        function confirmDelete() {
            return confirm('Are you sure you want to delete this phone?');
        }
    </script>
@stop
