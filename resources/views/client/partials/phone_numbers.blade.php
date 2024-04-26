@if ($phoneNumbers->count() > 0)
    <div class="container mt-3">
        @foreach ($phoneNumbers->chunk(3) as $chunk) {{-- Chunking phone numbers into groups of 3 --}}
        <div class="row g-3 mb-4"> {{-- Added mb-4 for margin bottom to each row for better vertical spacing --}}
            @foreach ($chunk as $phoneNumber)
                <div class="col-md-4"> {{-- Each phone number takes up 4 columns of the 12-column grid, making it 3 per row --}}
                    <div class="card h-100"> {{-- Added h-100 to make cards of equal height in a row --}}
                        <a href="/phones/{{ $phoneNumber->id }}" class="stretched-link" style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; z-index: 1;" title="View Phone Number {{ $phoneNumber->phone_number }}"></a>
                        <div class="card-header">
                            <h5 class="card-title mb-0 d-flex justify-content-between align-items-center">
                                {{ $phoneNumber->phone_number }}
                                @php
                                    $firstReview = $phoneNumber->reviews->first();
                                @endphp
                                @if ($firstReview)
                                    <small class="text-muted">{{ $firstReview->created_at->format('Y-m-d') }}</small>
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($firstReview)
                                <p class="card-text"><i class="fa fa-comment"></i> {{ Illuminate\Support\Str::limit($firstReview->comment, 100) }}</p>
                                <p>{!! App\Helpers\Helper::statusBadge($firstReview->rating) !!}</p>
                            @else
                                <p class="card-text">No reviews yet.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
@else
    <div class="alert alert-info" role="alert">
        No phone numbers found.
    </div>
@endif
