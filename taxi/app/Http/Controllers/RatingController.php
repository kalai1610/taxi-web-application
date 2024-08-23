<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Ride;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function driverIndex()
    {
        $ratings = Rating::with('ride.customer')->whereIn('ride_id', function ($query) {
            $query->select('ride_id')
                ->from('rides')
                ->wheredriver_id(auth('driver')->id());
        })->orderBy('id', 'desc')
            ->paginate('5');
        /*return $ratings;*/
        return view('Rating.index', compact('ratings'));
    }

    public function customerIndex()
    {
        $ratings = Rating::with('ride.driver')->whereIn('ride_id', function ($query) {
            $query->select('ride_id')
                ->from('rides')
                ->wherecustomer_id(auth('customer')->id());
        })->orderBy('id', 'desc')
            ->paginate('5');
        return view('Rating.index', compact('ratings'));
    }

    public function create(string $ride_id)
    {
        $ride = Ride::findOrFail($ride_id);
        if (!$ride->rating) {
            return view('Rating.create', compact('ride_id'));
        } else {
            return redirect()->route('customer.ride.rating.index');
        }
    }

    public function store(Request $request, string $id)
    {
        $ride = Ride::findOrFail($id);
        if (!$ride->rating) {
            $rating = Rating::create([
                'ride_id' => $id,
                'rating' => $request->rating,
                'feedback' => $request->feedback,
            ]);
        }
        return redirect()->route('customer.ride.rating.index')->with(['msg' => 'rating submitted successfully']);
    }

}
