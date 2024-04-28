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
    <script>
        $(document).ready(function () {
            var searchDelay;
            $('#search-input').on('input', function () {
                var query = $(this).val().trim();

                // Clear any existing timeout to reset the timer
                clearTimeout(searchDelay);

                searchDelay = setTimeout(function () {
                    // Check the length of the query
                    if (query.length >= 2) {
                        $.ajax({
                            url: "{{ route('search') }}",
                            method: 'GET',
                            data: { query: query },
                            success: function (response) {
                                updatePhoneNumberList(response.phoneNumbers);
                            },
                            error: function (xhr, status, error) {
                                console.error("Error occurred:", xhr, status, error);
                            }
                        });
                    } else if (query.length === 0) {
                        // Load the initial state or all phone numbers when the query is cleared
                        loadAllPhoneNumbers();
                    } else {
                        // If the query length is less than 3 and not empty, clear results
                        $('.results-list').html('<p>Type at least 3 characters to search phone numbers.</p>');
                    }
                }, 500); // 500 milliseconds delay
            });

            function loadAllPhoneNumbers() {
                $.ajax({
                    url: "{{ route('search') }}", // You might need a different endpoint to fetch all
                    success: function (response) {
                        updatePhoneNumberList(response.phoneNumbers);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching all phone numbers:", xhr, status, error);
                    }
                });
            }

            function updatePhoneNumberList(phoneNumbers) {
                $('.results-list').empty();
                if (phoneNumbers.data.length > 0) {
                    let contentHtml = '<div class="container mt-3">';
                    let chunks = chunkArray(phoneNumbers.data, 3);
                    chunks.forEach(function(chunk) {
                        contentHtml += '<div class="row g-3 mb-4">';
                        chunk.forEach(function(phoneNumber) {
                            contentHtml += `
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <a href="/phones/${phoneNumber.id}" class="stretched-link"></a>
                                    <div class="card-header">
                                        <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                            ${phoneNumber.phone_number}
                                            ${phoneNumber.reviews && phoneNumber.reviews.length > 0 ?
                                `<small class="text-muted">${new Date(phoneNumber.reviews[0].created_at).toISOString().slice(0, 10)}</small>` : ''}
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        ${phoneNumber.reviews && phoneNumber.reviews.length > 0 ?
                                `<p><i class="fa fa-comment"></i> ${phoneNumber.reviews[0].comment.substring(0, 100)}</p>
                                             <p>${statusBadge(phoneNumber.reviews[0].rating)}</p>` :
                                `<p>No reviews yet.</p>`}
                                    </div>
                                </div>
                            </div>`;
                        });
                        contentHtml += '</div>'; // End row
                    });
                    contentHtml += '</div>'; // End container
                    $('.results-list').html(contentHtml);
                } else {
                    $('.results-list').html('<div class="alert alert-info" role="alert">No phone numbers found.</div>');
                }
            }

            function chunkArray(array, size) {
                const chunked_arr = [];
                for (let i = 0; i < array.length; i++) {
                    const last = chunked_arr[chunked_arr.length - 1];
                    if (!last || last.length === size) {
                        chunked_arr.push([array[i]]);
                    } else {
                        last.push(array[i]);
                    }
                }
                return chunked_arr;
            }

            function statusBadge(rating) {
                let badgeHtml = '<span class="badge ';
                switch(rating.toLowerCase()) {
                    case 'spam': badgeHtml += 'bg-danger'; break;
                    case 'scam': badgeHtml += 'bg-warning'; break;
                    case 'positive': badgeHtml += 'bg-success'; break;
                    case 'uncertain': badgeHtml += 'bg-secondary'; break;
                    default: badgeHtml += 'bg-secondary'; break;
                }
                badgeHtml += `">${rating}</span>`;
                return badgeHtml;
            }
        });
    </script>

@endpush


