<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Customer;


class CustomerController extends Controller
{
    public function show(string $id)
    {
        $user = Customer::find($id);
        $edit_url = '/customer/profile/edit/' . $id;
        return view('Profile.index', compact('user', 'edit_url'));
    }

    public function edit(string $id)
    {
        $user = Customer::find($id);
        $update_url = '/customer/profile/update/' . $id;
        return view('Profile.edit', compact('user', 'update_url'));
    }

    public function update(string $id, ProfileUpdateRequest $request)
    {
        $user = Customer::find($id);
        $user->update([
            'name' => $request->name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'address' => $request->address,
        ]);
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = 'img/' . $image->getClientOriginalName();
            $image->move(public_path('img'), $imageName);
            $user->picture = $imageName;
        }
        $user->save();
        return redirect('customer/profile/' . $id);
    }
}
