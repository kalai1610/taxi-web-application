<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Ride;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DriverRideController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $rides = Ride::wheredriver_id(Auth::guard('driver')->id())->orderBy('id', 'desc')->paginate(5);
        return view('Ride.index', compact('rides'));
    }

    public function show(string $id)
    {
        $ride = Ride::findOrFail($id);
        return view('Ride.show', compact('ride'));
    }

    public function accept(string $id): RedirectResponse
    {
        $ride = Ride::findOrFail($id);
        if ($ride->status == 'requested') {
            $ride->status = 'in ride';
            $ride->save();
        }
        return redirect()->route('driver.ride.index');
    }

    public function reject(string $id): RedirectResponse
    {
        $ride = Ride::findOrFail($id);
        if ($ride->status == 'requested') {
            $ride->status = 'rejected';
            $ride->save();
        }
        return redirect()->route('driver.ride.index');
    }

    public function complete(string $id): RedirectResponse
    {
        $ride = Ride::findOrFail($id);
        if ($ride->status == 'in ride') {
            $ride->status = 'completed';
            $ride->save();
            Payment::create([
                'ride_id' => $id,
                'tax' => $ride->amount * 0.2,
                'booking_charge' => 20,
                'total_payment' => ($ride->amount * 0.2) + 20 + $ride->amount,
                'status' => 'not paid'
            ]);
        }
        return redirect()->route('driver.ride.index');
    }

}
