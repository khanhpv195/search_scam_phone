<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper as Helper;

class PhoneClientController extends Controller
{
    // Method to display a list of phone numbers

    // contructor
    public function __construct()
    {
        // bind helper
        $this->helper = new Helper();
    }

    public function index(Request $request)
    {
        // Eager load reviews when listing all phone numbers, fetching only the most recent review
        $phoneNumbers = Phone::with(['reviews' => function ($query) {
            $query->select('reviews.*')
                ->joinSub(
                    Review::selectRaw('MAX(id) as id, phone_id')
                        ->groupBy('phone_id'),
                    'latest_reviews',
                    function ($join) {
                        $join->on('reviews.id', '=', 'latest_reviews.id');
                    }
                )->orderBy('created_at', 'desc');
        }])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view('client.index', compact('phoneNumbers'));
    }

    // Method to search for phone numbers
    public function search(Request $request)
    {
        $query = $request->get('query', '');
        $normalizedQuery = preg_replace('/\D/', '', $query); // Remove non-numeric characters

        // Updated query to fetch all reviews for each phone number
        $phoneNumbers = Phone::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc'); // Order reviews by creation date
        }])
            ->when($normalizedQuery, function ($queryBuilder) use ($normalizedQuery) {
                $queryBuilder->where('phone_number', 'like', '%' . $normalizedQuery . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        // Check if the request is an AJAX request
        return response()->json([
            'phoneNumbers' => $phoneNumbers
        ]);
    }


    // show
    public function show($id)
    {
        // get phone by id, join width reviews, order review by created_at
        $phoneNumber = Phone::where('id', $id)->with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->first();

        // Return the show view and pass the phone number to it
        return view('client.show', compact('phoneNumber'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'phone_number' => 'required',
        ]);

        // Check if DBVthe phone number is beautiful
        DB::beginTransaction();
        try {
            // Check if the phone number already exists
            $tag = $this->helper->determinePhoneType($request->input('phone_number'));
            $beautiful = $this->helper->isBeautifulPhoneNumber($request->input('phone_number'));
            $phone = Phone::firstOrCreate(
                ['phone_number' => $request->input('phone_number')], // Search attributes
                [
                    'business_name' => $request->input('business_name'), // Additional attributes for creation
                    'tag' => $tag,
                    'is_beauty' => $beautiful
                ]
            );

            // Save to review table
            $review = $phone->reviews()->create([
                'comment' => $request->input('comment'),
                'rating' => $request->input('rating'),
                'ip_address' => $request->ip()
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi số !');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi xảy ra, xin vui lòng thử lại sau.');
        }

    }
}
