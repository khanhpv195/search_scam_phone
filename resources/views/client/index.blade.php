@extends('layouts.client.main')

@section('content')
    <div class="container">
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
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">CheckSĐT - Tra Cứu SĐT</h1>
                <p>Danh bạ điện thoại, cung cấp thông tin tìm kiếm số điện thoại tại Việt Nam, <br/> bao gồm các cuộc
                    gọi làm phiền, lừa đảo, số điện thoại đáng tin cậy, quảng cáo, thông tin doanh nghiệp, v.v...</p>
                <button type="button" class="btn bg_add mb-5" data-toggle="modal" data-target="#exampleModal">
                    Cập nhật số điện thoại mới
                </button>
            </div>
        </div>
        <form id="search-form" class="d-flex mb-5">
            <input type="number" name="phone" id="search-input" class="form-control me-2"
                   placeholder="Nhập số điện thoại..." required/>
        </form>
        <div class="results-list bg-light p-3 border rounded">
            <h1 class="standard-header">Danh bạ điện thoại</h1>
            @include('client.partials.phone_numbers', ['phoneNumbers' => $phoneNumbers])
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="text-center">
                    <img src="https://via.placeholder.com/600x120?text=Ad+Space" alt="Ad Space" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
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
                                    <input type="number" name="phone_number" id="modal-input" class="form-control"
                                           required/>
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
                                    <textarea placeholder="Nhập vào đánh giá của bạn" name="comment" id="" cols="30"
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
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the form from submitting via the browser.
                var query = $('#search-input').val();

                $.ajax({
                    url: "{{ route('search') }}",
                    method: 'GET',
                    data: {query: query},
                    success: function (data) {
                        $('.results-list').html(data.html);
                    }
                });
            });

            $('#search-input').on('keyup', function () {
                $(this).closest('form').submit(); // Trigger search when typing.
            });
        });
    </script>
@endpush
