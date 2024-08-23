@extends('template.admin')
@section('content')
    <div class="content-wrapper">
        <section class="content-header ml-md-5 ml-sm-3 ml-2 ">
            <div class="row ">
                <h1 class="text-bold">Ratings</h1>
            </div>
        </section>
        <hr>
        <div class="container-fluid p-sm-3">
            <div class="row">

                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="bg-gradient-blue">
                            <th>S.no</th>
                            <th>Ride id</th>
                            <th>Rating</th>
                            <th>Feedback</th>
                            @if(auth('driver')->check())
                                <th>Customer name</th>
                            @endif
                            @if(auth('customer')->check())
                                <th> Driver name</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ratings as $key => $rating)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$rating->ride_id}}</td>
                                <td>{{$rating->rating}}</td>
                                <td>{{$rating->feedback}}</td>
                                @if(auth('driver')->check())
                                    <td>{{$rating->ride->customer->name}}</td>
                                @endif
                                @if(auth('customer')->check())
                                    <td>{{$rating->ride->driver->name}}</td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class=" row justify-content-center">
                        <div class="col-sm-6">{{$ratings->links()}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
