@extends('template.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header ml-md-5 ml-sm-3 ml-2 ">
            <div class="row ">
                <h1 class="text-bold">Payments</h1>
            </div>
        </section>
        <hr>
        @if(isset($msg))
            <div class="alert alert-success alert-dismissible ml-4 mr-4">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>{{$msg}}</strong>
            </div>
        @endif
        <div class="container-fluid p-sm-3">
            <div class="row">

                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-gradient-blue">
                            <th>S.no</th>
                            <th>Ride id</th>
                            <th>Ride distance</th>
                            <th>Ride fare(Rs)</th>
                            <th>Tax(Rs)</th>
                            <th>Booking charge(Rs)</th>
                            <th>Total payment(Rs)</th>
                            <th>status</th>
                            @if(auth('driver')->check())
                                <th>customer name</th>
                            @endif
                            @if(auth('customer')->check())
                                <th>driver name</th>
                            @endif
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $key => $payment)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$payment->ride_id}}</td>
                                <td>{{$payment->ride->distance}}</td>
                                <td>{{$payment->ride->amount}}</td>
                                <td>{{$payment->tax}}</td>
                                <td>{{$payment->booking_charge}}</td>
                                <td>{{$payment->total_payment}}</td>
                                <td>{{$payment->status}}</td>
                                @if(auth('driver')->check())
                                    <td>{{$payment->ride->customer->name}}</td>
                                @endif
                                @if(auth('customer')->check())
                                    <td>{{$payment->ride->driver->name}}</td>
                                @endif
                                <td>
                                    @if(auth('driver')->check())
                                        <a class='btn' href="{{url('driver/payment/'.$payment->id)}}"><i
                                                class="fas fa-eye text-primary"></i></a>
                                    @endif
                                    @if(auth('customer')->check())
                                        <a class='btn' href="{{url('customer/payment/'.$payment->id)}}"><i
                                                class="fas fa-eye text-primary"></i></a>
                                    @endif
                                    @if(auth('customer')->check()&&$payment->status=='not paid')
                                        <a class='btn btn-success'
                                           href="{{url('customer/payment/'.$payment->id.'/pay')}}">Pay</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=" row justify-content-center">
                        <div class="col-sm-6">{{$payments->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
