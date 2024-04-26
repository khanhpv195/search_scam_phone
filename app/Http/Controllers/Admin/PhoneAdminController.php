<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;

class PhoneAdminController extends Controller
{
    //

    // Trong PhoneController
    public function index()
    {
        $phones = Phone::all();
        return view('admin.phones.index', compact('phones'));
    }

}
