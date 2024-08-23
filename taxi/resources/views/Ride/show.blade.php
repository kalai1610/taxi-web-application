@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <section class="content-header ml-md-5 ml-sm-3 ml-2 ">
            <div class="row ">
                <h1 class="text-bold">Rides details</h1>
                @if(auth('customer')->check())
                    <a class="ml-auto mr-5 btn btn-danger " href="{{url('customer/ride')}}">Back</a>
                @elseif(auth('driver')->check())
                    <a class="ml-auto mr-5 btn btn-danger " href="{{url('driver/ride')}}">Back</a>
                @endif
            </div>
        </section>
        <hr>
        <div class="container  p-3 mb-3 elevation-1">
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-3 ">
                    <h4 class=" text-bold">Tracking your ride:</h4>
                    <hr>
                    <div id="map" class="p-5" style="width:100%; height: 500px;"></div>
                    <div class="pl-5 border  elevation-1">
                        <div class="text-red">Note:</div>
                        <img class="img-size-32" src="{{asset('img/pickup.png')}}">Pickup Location <br>
                        <img class="img-size-32" src="{{asset('img/destination.png')}}">destination Location<br>
                        <img class="img-size-32" src="{{asset('img/driver.png')}}">driver Location
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class=" text-bold">details:</h4>
                    <hr>
                    <div class="p-5 text-lg">
                        <div class="text-bold">Pickup address:</div>
                        {{$ride->pickup_address}}
                        <hr>
                        <div class="text-bold">Destination address:</div>{{$ride->destination_address}}
                        <hr>
                        <div><strong>Request time: </strong>{{$ride->time}}</div>
                        <hr>
                        <div><strong>Distance: </strong>{{$ride->distance}}km</div>
                        <hr>
                        <div><strong>Amount (excluding taxi): </strong>{{$ride->amount}} Rs</div>
                        <hr>
                        <div><strong>Status: </strong>{{$ride->status}}</div>
                        <hr>
                        <div><strong>Ride rating : </strong>{{$ride->rating->rating??'not yet'}}</div>
                        <hr>
                        @if(!$ride->rating)
                            <a href="{{url('customer/ride/'.$ride->id.'/rating')}}" class="btn btn-primary">Rate us</a>
                            <hr>
                        @endif
                        @if($ride->driver&&auth('customer')->check())
                            <div class="text-bold">Driver:</div>
                            <div class="pl-5">
                                <div><strong>Name: </strong>{{$ride->driver->name??'nill'}}</div>
                                <hr>
                                <div><strong>Phone number: </strong>{{$ride->driver->phone_number??'nill'}}</div>
                                <hr>
                                <hr>
                                <div><strong>Payment status: </strong>{{$ride->payment->status??'nill'}}</div>
                                <hr>
                                <div><strong>Rating: </strong>{{$driver_rating??'0'}}</div>
                                <hr>
                            </div>
                        @elseif(auth('driver')->check())
                            <div class="text-bold">Customer:</div>
                            <div class="pl-5">
                                <div><strong>Name: </strong>{{$ride->customer->name??'nill'}}</div>
                                <hr>
                                <div><strong>Phone number: </strong>{{$ride->customer->phone_number??'nill'}}</div>
                                <hr>
                                <hr>
                                @if($ride->status=='completed')
                                    <div><strong>Payment status: </strong>{{$ride->driver->rating??'nill'}}</div>
                                    <hr>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <script>
                let customerLocation = [{{$ride->pickup_longitude}}, {{$ride->pickup_latitude}}];
                let destinationLocation = [{{$ride->destination_longitude}}, {{$ride->destination_latitude}}];
                console.log([{{$ride->driver->drivers_longitude}}, {{$ride->driver->drivers_latitude}}])
                let map = new ol.Map({
                    target: 'map',
                    layers: [
                        new ol.layer.Tile({
                            source: new ol.source.OSM()
                        })
                    ],
                    view: new ol.View({
                        center: ol.proj.fromLonLat(customerLocation),
                        zoom: 6,
                    })
                });
                let customerMarker = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat(customerLocation))
                });
                let iconStyle1 = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: 'http://127.0.0.1:8000/img/pickup.png',
                        scale: 0.2,
                    }),
                });
                customerMarker.setStyle(iconStyle1);

                let destinationMarker = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat(destinationLocation))
                });
                let iconStyle2 = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: 'http://127.0.0.1:8000/img/destination.png',
                        scale: 0.2,
                    }),
                });
                destinationMarker.setStyle(iconStyle2);
                let vectorSource = new ol.source.Vector({
                    features: [customerMarker, destinationMarker]
                });
                let vectorLayer = new ol.layer.Vector({
                    source: vectorSource
                });
                map.addLayer(vectorLayer);
                @if ($ride->status=='in ride')
                let driverMarker = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([{{$ride->driver->drivers_longitude}}, {{$ride->driver->drivers_latitude}}]))
                });
                let iconStyle3 = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: 'http://127.0.0.1:8000/img/driver.png',
                        scale: 0.2,
                    }),
                });
                driverMarker.setStyle(iconStyle3);
                let driverVectorSource = new ol.source.Vector({
                    features: [driverMarker]
                });
                let driverVectorLayer = new ol.layer.Vector({
                    source: driverVectorSource
                });
                map.addLayer(driverVectorLayer);
                $(document).ready(function () {
                    let interval = setInterval(function () {
                        console.log('getRequest');
                        $.ajax({
                            type: 'GET',
                            url: '{{ url('/driver/'.$ride->driver_id.'/location') }}',
                            success: function (response) {
                                console.log(response);
                                driverMarker.getGeometry().setCoordinates(ol.proj.fromLonLat([response.driver.drivers_longitude, response.driver.drivers_latitude]));
                                console.log('location Update');
                                map.getView().setCenter(ol.proj.fromLonLat([response.driver.drivers_longitude, response.driver.drivers_latitude]));
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    }, 5000);
                });
                @endif

            </script>
        </div>
@endsection
