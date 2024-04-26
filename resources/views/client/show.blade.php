@extends('layouts.client.main')

@section('title', 'Phone Number Details')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card shadow-sm">
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
                </div>
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center" style="background-color: #00bcd4 !important">
                        <h5 class="card-title mb-0">Phản hồi của mọi người về số điện thoại {{$phoneNumber->phone_number}}</h5>
                        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModal">
                          <i class="fa fa-plus-circle"> </i>  Đánh giá
                        </button>
                    </div>

                    <div class="card-body">
                       <div class="row">
                           <div class="col-12">
                               <h2>{{ $phoneNumber->phone_number }}</h2>
                               <p class="text-muted">Ngày tạo: {{ $phoneNumber->created_at->format('Y-m-d H:i') }}</p>

                           </div>
                       </div>

                        <hr>
                        @if ($phoneNumber->reviews->isNotEmpty())
                            @foreach ($phoneNumber->reviews as $review)
                                <div class="review mb-3 pb-3 border-bottom">
                                    <strong class="d-block mb-2" style="font-size: 1.1em;">{{ $review->ip_address }}</strong>
                                    <p class="mb-1" style="font-size: 0.9em;">{{ $review->comment }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        {!! \App\Helpers\Helper::statusBadge($review->rating) !!}
                                        <span class="text-muted" style="background-color: #f8f9fa; padding: 0.2em 0.5em; font-size: 0.8em; border-radius: 5px;">
                    {{ $review->created_at->format('Y-m-d H:i') }}
                </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No reviews yet.</p>
                        @endif

                    </div>
                </div>

                {{-- Form for status evaluation --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Thêm số điện thoại</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('phones.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <div class="col-12 ">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="">Tên doanh nghiệp hoặc loại hình:</label>
                                                <input type="text" name="business_name" id="modal-input" class="form-control"
                                                />
                                            </div>
                                            <div class="form-group mb-3 ">
                                                <label class="form-label"> Số điện
                                                    thoại <strong class="text-danger">*</strong></label>
                                                <input type="text" name="phone_number" id="modal-input" class="form-control"
                                                    value="{{$phoneNumber->phone_number}}" readonly   required/>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label for="" class="form-label">Trạng thái:</label>
                                                <select class="form-control" id="rating" name="rating">
                                                    <option value="Spam">Thư rác</option>
                                                    <option value="Scam">Lừa đảo</option>
                                                    <option value="Positive">Tích cực</option>
                                                    <option value="Uncertain" selected>Chưa có thông tin</option>
                                                </select>
                                            </div>
                                            <div class="form-group ">
                                    <textarea placeholder="Nhập vào đánh giá của bạn" name="comment" id="" cols="10"
                                              rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn bg_add">Thêm mới</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Separate card for reviews --}}
            </div>
        </div>
    </div>
@endsection
