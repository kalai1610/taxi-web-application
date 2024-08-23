@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <h4 class="text-bold pt-3 pl-3">Create Ride</h4>
        <hr>
        <div class="container bg-blue p-3 elevation-1">
            <div class="text-xl text-bold">Ride</div>
        </div>
        <div class="container  p-3 mb-3 elevation-1">
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <h4 class=" text-bold">Pickup location:</h4>
                    Lat: <span id="displayPickLat">nill</span>,
                    Long: <span id="displayPickLong">nill</span>
                    Address: <span id="displayPickupAddress">nill</span>
                    <div id="pickup" class="p-5" style="width:100%; height: 500px;"></div>
                    <div class="pl-sm-5 pb-5">
                        <button id="pickupGetCurrentLocationButton" class="btn btn-secondary mr-3">Use my current
                            location
                        </button>
                        <button id="pickupUseLocationButton" class="btn btn-secondary">Mark selected location</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h3 class="text-bold">Destination location:</h3>
                    Lat: <span id="displayDestinationLat">nill</span>,
                    Long: <span id="displayDestinationLong">nill</span>,
                    Address: <span id="displayDestinationAddress">nill</span>
                    <div id="destination" class="p-5" style="width:100%; height: 500px;"></div>
                    <div class="pl-sm-5">
                        <button id="destinationGetCurrentLocationButton" class="btn btn-secondary">Use my current
                            location
                        </button>
                        <button id="destinationUseLocationButton" class="btn btn-secondary">Mark selected location
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <form id="myForm" action="{{url('customer/ride')}}" method="post">
                @csrf
                @method("POST")
                <input type='hidden' id='pickupLong' name='pickupLong'>
                <input type='hidden' id='pickupLat' name='pickupLat'>
                <input type='hidden' id='destinationLong' name='destinationLong'>
                <input type='hidden' id='destinationLat' name='destinationLat'>
                <input type="hidden" id="pickupAddress" name="pickupAddress">
                <input type="hidden" id="destinationAddress" name="destinationAddress">
                <button type="submit" class="btn btn-primary ml-5">Create ride</button>
                <a href="{{url('customer/ride')}}" class="btn btn-danger ml-4">Cancel</a>
            </form>

        </div>
        <script src="{{asset('js/getMapLocation.js')}}"></script>
    </div>
@endsection
