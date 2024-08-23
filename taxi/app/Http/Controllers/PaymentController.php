<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function driverIndex()
    {
        $payments = Payment::with('ride.driver')->whereIn('ride_id', function ($query) {
            $query->select('ride_id')
                ->from('rides')
                ->where('driver_id', '=', auth('driver')->id());
        })->orderBy('id', 'desc')->paginate(5);
        return view('Payment.index', compact('payments'));
    }

    public function customerIndex()
    {
        $payments = Payment::with('ride.customer')->whereIn('ride_id', function ($query) {
            $query->select('ride_id')
                ->from('rides')
                ->where('customer_id', '=', auth('customer')->id());
        })->orderBy('id', 'desc')->paginate(5);
        return view('Payment.index', compact('payments'));
    }

    public function pay(string $id)
    {
        $payment = Payment::findOrFail($id);
        if ($payment->status == 'not paid') {
            $payment->status = 'paid';
            $payment->save();
        }
        return redirect()->route('customer.payment.index');
    }

    public function show(string $id)
    {
        $payment = Payment::with('ride.customer', 'ride.driver')->whereid($id)->first();
        return view('Payment.show', compact('payment'));
    }

}

