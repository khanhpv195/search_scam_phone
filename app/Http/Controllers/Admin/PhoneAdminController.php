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
        $phones = Phone::orderBy('id', 'desc')->get();
        return view('admin.phones.index', compact('phones'));
    }

    public function edit($id)
    {
        return view('admin.phones.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $phone = Phone::find($id);
        $phone->update($request->all());
        return redirect('/admin/phones')->with('success', 'Đã cập nhật');
    }

    public function destroy($id)
    {
        // delete
        $phone = Phone::find($id);
        // delete all review
        $phone->reviews()->delete();
        $phone->delete();
        return redirect('/admin/phones')->with('success', 'Đã xóa');
    }


    public function show($id)
    {
        return view('admin.phones.show', compact('id'));
    }
}
