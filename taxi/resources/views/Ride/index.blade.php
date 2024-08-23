@extends('template.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header ml-md-5 ml-sm-3 ml-2 ">
            <div class="row ">
                <h1 class="text-bold">Rides</h1>
                @if(auth('customer')->check())
                    <a class=" ml-auto mr-5 btn btn-primary " href="{{url('customer/ride/create')}}">Create ride
                        request</a>
                @endif
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
                            <th>Pickup location</th>
                            <th>destination location</th>
                            <th>distance (Km)</th>
                            <th>Amount (tax excluded)</th>
                            <th>Requested time</th>
                            <th>status</th>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rides as $key => $ride)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$ride->pickup_address}}</td>
                                <td>{{$ride->destination_address}}</td>
                                <td>{{$ride->distance}}</td>
                                <td>{{$ride->amount}}</td>
                                <td>{{$ride->time}}</td>
                                <td>{{$ride->status}}</td>
                                <td>
                                    @if(Auth::guard('customer')->check())
                                        <a class='btn' href="{{url('customer/ride/'.$ride->id)}}"><i
                                                class="fas fa-eye text-gray"></i></a>
                                        @if($ride->status=='requested')
                                            <a class='btn ' href="{{url('customer/ride/'.$ride->id.'/edit')}}"><i
                                                    class="fas fa-edit text-warning"></i></a>
                                            <a class='btn-sm btn-danger'
                                               href="{{url('customer/ride/'.$ride->id.'/cancel')}}">Cancel</a>
                                        @endif
                                    @endif
                                    @if(Auth::guard('driver')->check())
                                        <a class='btn' href="{{url('driver/ride/'.$ride->id)}}"><i
                                                class="fas fa-eye text-primary"></i></a>
                                        @if($ride->status=='requested')
                                            <a class='btn-sm btn-success'
                                               href="{{url('driver/ride/'.$ride->id.'/accept')}}">Accept</a>
                                            <a class='btn-sm btn-danger'
                                               href="{{url('driver/ride/'.$ride->id.'/Reject')}}">Reject</a>
                                        @endif
                                        @if($ride->status=='in ride')
                                            <a class='btn-sm btn-success'
                                               href="{{url('driver/ride/'.$ride->id.'/complete')}}">completed</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=" row justify-content-center">
                        <div class="col-sm-6">{{$rides->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
