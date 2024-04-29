@extends('adminlte::page')

@section('title', 'Phone Number Details')

@section('content')
    <div class="card">
        <div class="card-body">
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
            <h3>{{$phoneNumber->phone_number}}</h3>
            <p class="text-muted">Created at: {{ $phoneNumber->created_at->format('Y-m-d H:i') }}</p>

            <hr>
            <table id="example" class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>IP</th>
                    <th colspan="2" scope="row">Bình luận</th>
                    <th>Vị trí</th>
                    <th>Đánh giá</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($phoneNumber->reviews as $review)
                    <tr>
                        <td>{{$review->id}}</td>
                        <td>{{$review->ip_address}}</td>
                        <td colspan="2" >
                            <p class="text-wrap text-break">{{$review->comment}}</p>
                        </td>
                        <td>{{$review->region}}</td>
                        <td>
                            {!! \App\Helpers\Helper::statusBadge($review->rating) !!}
                        </td>
                        <td>
                            <!-- Delete button as a form -->
                            <form action="/admin/destroyReview/{{$review->id}}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this review?');"
                                  style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
