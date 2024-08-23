<?php

namespace App\Http\Controllers;

use App\Jobs\SearchNearestDrive;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerRideController extends Controller
{
    public function index()
    {
        $rides = Ride::wherecustomer_id(Auth::guard('customer')->id())->orderBy('id', 'desc')->paginate(5);
        return view('Ride.index', compact('rides'));
    }

    public function create()
    {
        return view('Ride.create');
    }

    public function store(Request $request)
    {
        $distance = distance($request->pickupLat, $request->pickupLong, $request->destinationLat, $request->destinationLong);
        $ride = Ride::create([
            'customer_id' => Auth::guard('customer')->id(),
            'pickup_latitude' => $request->pickupLat,
            'pickup_longitude' => $request->pickupLong,
            'destination_latitude' => $request->destinationLat,
            'destination_longitude' => $request->destinationLong,
            'pickup_address' => $request->pickupAddress,
            'destination_address' => $request->destinationAddress,
            'distance' => $distance,
            'amount' => $distance * 20,
            'status' => 'requested',
            'time' => now(),
        ]);
        dispatch(new SearchNearestDrive($ride));
        return redirect()->route('customer.ride.index')->with(['msg' => 'Ride request Create successfully']);
    }

    public function show(string $id)
    {
        $ride = Ride::with('customer', 'driver', 'payment', 'rating')
            ->find($id);
        /*return $ride;*/
        return view('Ride.show', compact('ride'));

    }

    public function edit(string $id)
    {
        $ride = Ride::findOrFail($id);
        return view('Ride.edit', compact('ride'));
    }

    public function update(Request $request, string $id)
    {
        $distance = distance($request->pickupLat, $request->pickupLong, $request->destinationLat, $request->destinationLong);
        $ride = Ride::find($id)->update([
            'customer_id' => Auth::guard('customer')->id(),
            'pickup_latitude' => $request->pickupLat,
            'pickup_longitude' => $request->pickupLong,
            'destination_latitude' => $request->destinationLat,
            'destination_longitude' => $request->destinationLong,
            'pickup_address' => $request->pickupAddress,
            'destination_address' => $request->destinationAddress,
            'distance' => $distance,
            'amount' => $distance * 20,
            'status' => 'requested',
            'time' => now(),
        ]);
        dispatch(new SearchNearestDrive($ride));
        return redirect()->route('customer.ride.index')->with(['msg' => 'Ride request update successfully']);
    }

    public function cancel(string $id)
    {
        $ride = Ride::findOrFail($id);
        $ride->status = 'cancelled';
        $ride->save();
        return redirect()->route('customer.ride.index');
    }
}
