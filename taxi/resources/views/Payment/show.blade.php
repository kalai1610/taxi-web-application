@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header ml-md-5 ml-sm-3 ml-2">
            <div class="row ">
                <h1 class="text-bold">Payment details</h1>
                @if(auth('customer')->check())
                    <a class="ml-auto mr-5 btn btn-danger " href="{{url('customer/payment')}}">Back</a>
                @elseif(auth('driver')->check())
                    <a class="ml-auto mr-5 btn btn-danger " href="{{url('driver/payment')}}">Back</a>
                @endif
            </div>
        </section>
        <hr>
        <div class="container  p-3 elevation-1">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-3 ">
                    <div class="text-bold">Ride id</div>
                    <hr>
                    <div class="text-bold">Ride distance</div>
                    <hr>
                    <div class="text-bold">Pickup address</div>
                    <hr>
                    <div class="text-bold">Destination address</div>
                    <hr>
                    <div class="text-bold">Ride fare(Rs)</div>
                    <hr>
                    <div class="text-bold">Tax(Rs)</div>
                    <hr>
                    <div class="text-bold">Booking charge(Rs)</div>
                    <hr>
                    <div class="text-bold">Total payment(Rs)</div>
                    <hr>
                    <div class="text-bold">status</div>
                    <hr>
                    @if(auth('customer')->check())
                        <div class="text-bold">Driver name</div>
                        <hr>
                        <div class="text-bold">Driver phone number</div>
                        <hr>
                    @endif
                    @if(auth('driver')->check())
                        <div class="text-bold">Customer name</div>
                        <hr>
                        <div class="text-bold">Customer phone number</div>
                        <hr>
                    @endif
                </div>
                <div class="col-lg-6 mb-3">
                    <div>:{{$payment->ride_id}}</div>
                    <hr>
                    <div>:{{$payment->ride->distance}} Km</div>
                    <hr>
                    <div>{{$payment->ride->pickup_address}}</div>
                    <hr>
                    <div>{{$payment->ride->destination_address}}</div>
                    <hr>
                    <div>{{$payment->ride->amount}} Rs</div>
                    <hr>
                    <div>{{$payment->tax}} Rs</div>
                    <hr>
                    <div>{{$payment->booking_charge}} Rs</div>
                    <hr>
                    <div>{{$payment->total_payment}} Rs</div>
                    <hr>
                    <div>{{$payment->status}}</div>
                    <hr>
                    @if(auth('customer')->check())
                        <div>{{$payment->ride->driver->name}}</div>
                        <hr>
                        <div>{{$payment->ride->driver->phone_number}}</div>
                        <hr>
                    @endif
                    @if(auth('driver')->check())
                        <div>{{$payment->ride->customer->name}}</div>
                        <hr>
                        <div>{{$payment->ride->customer->phone_number}}</div>
                        <hr>
                    @endif
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
