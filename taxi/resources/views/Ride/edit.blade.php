@extends('template.admin')

@section('content')
    <div class="content-wrapper">
        <h4 class="text-bold pt-3 pl-3">Edit Ride</h4>
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
                        <div id="pickup" class="p-5" style="width:100%; height: 500px;"></div>
                        <div class="pl-sm-5 pb-5">
                            <button id="pickupGetCurrentLocationButton" class="btn btn-secondary mr-3">Use my current
                                location
                            </button>
                            <button id="pickupUseLocationButton" class="btn btn-secondary">Mark selected location
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h3 class="text-bold">Destination location:</h3>
                        Lat: <span id="displayDestinationLat">nill</span>,
                        Long: <span id="displayDestinationLong">nill</span>
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
                <form id="myForm" action="{{url('customer/ride/'.$ride->id)}}" method="post">
                    @csrf
                    @method("POST")
                    <input type='hidden' id='pickupLong' name='pickupLong'>
                    <input type='hidden' id='pickupLat' name='pickupLat'>
                    <input type='hidden' id='destinationLong' name='destinationLong'>
                    <input type='hidden' id='destinationLat' name='destinationLat'>
                    <button type="submit" class="btn btn-primary ml-5">Update ride</button>
                    <a href="{{url('customer/ride')}}" class="btn btn-danger ml-4">Cancel</a>
                </form>

            </div>
            <script>
                let iconFeature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([{{$ride->pickup_longitude}}, {{$ride->pickup_latitude}}])),
                });
                let iconStyle = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: 'http://127.0.0.1:8000/img/pickup.png',
                        scale: 0.2,
                    }),
                });
                iconFeature.setStyle(iconStyle);

                let vectorSource = new ol.source.Vector({
                    features: [iconFeature],
                });

                let vectorLayer = new ol.layer.Vector({
                    source: vectorSource,
                });

                let rasterLayer = new ol.layer.Tile({
                    source: new ol.source.OSM(),
                });

                let map = new ol.Map({
                    layers: [rasterLayer, vectorLayer],
                    target: 'pickup',
                    view: new ol.View({
                        center: ol.proj.fromLonLat([{{$ride->pickup_longitude}}, {{$ride->pickup_latitude}}]),
                        zoom: 10,
                    }),
                });

                let modify = new ol.interaction.Modify({
                    hitDetection: vectorLayer,
                    source: vectorSource,
                });
                modify.on(['modifystart', 'modifyend'], function (evt) {
                    map.getTargetElement().style.cursor = evt.type === 'modifystart' ? 'grabbing' : 'pointer';
                });

                let overlaySource = modify.getOverlay().getSource();

                overlaySource.on(['addfeature', 'removefeature'], function (evt) {
                    map.getTargetElement().style.cursor = evt.type === 'addfeature' ? 'pointer' : '';
                });
                map.addInteraction(modify);


                let iconFeature1 = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([{{$ride->destination_longitude}}, {{$ride->destination_latitude}}])),
                });
                let iconStyle1 = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: "http://127.0.0.1:8000/img/destination.png",
                        scale: 0.2,
                    }),
                });
                iconFeature1.setStyle(iconStyle1);

                let vectorSource1 = new ol.source.Vector({
                    features: [iconFeature1],
                });

                let vectorLayer1 = new ol.layer.Vector({
                    source: vectorSource1,
                });

                let rasterLayer1 = new ol.layer.Tile({
                    source: new ol.source.OSM(),
                });

                let map1 = new ol.Map({
                    layers: [rasterLayer1, vectorLayer1],
                    target: 'destination',
                    view: new ol.View({
                        center: ol.proj.fromLonLat([{{$ride->destination_longitude}}, {{$ride->destination_latitude}}]),
                        zoom: 10,
                    }),
                });

                let modify1 = new ol.interaction.Modify({
                    hitDetection: vectorLayer1,
                    source: vectorSource1,
                });

                modify1.on(['modifystart', 'modifyend'], function (evt) {
                    map1.getTargetElement().style.cursor = evt.type === 'modifystart' ? 'grabbing' : 'pointer';
                });

                let overlaySource1 = modify1.getOverlay().getSource();

                overlaySource1.on(['addfeature', 'removefeature'], function (evt) {
                    map1.getTargetElement().style.cursor = evt.type === 'addfeature' ? 'pointer' : '';
                });
                map1.addInteraction(modify1);
                let pickup = [{{$ride->pickup_longitude}}, {{$ride->pickup_latitude}}];
                let destination = [{{$ride->destination_longitude}}, {{$ride->destination_latitude}}];
                $('#displayPickLong').text(pickup[0]);
                $('#displayPickLat').text(pickup[1]);
                $('#displayDestinationLong').text(destination[0]);
                $('#displayDestinationLat').text(destination[1]);
                $(document).ready(function () {
                    $('#pickupGetCurrentLocationButton').click(function () {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            pickup = [position.coords.longitude, position.coords.latitude]
                            $('#displayPickLong').text(pickup[0]);
                            $('#displayPickLat').text(pickup[1]);
                            console.log(pickup);
                            let newCoordinates = ol.proj.fromLonLat(pickup);
                            iconFeature.getGeometry().setCoordinates(newCoordinates);
                        });
                    });

                    $('#pickupUseLocationButton').click(function () {
                        let iconCoordinates = iconFeature.getGeometry().getCoordinates();
                        console.log('Pickup Location:', iconCoordinates);
                        pickup = ol.proj.transform(iconCoordinates, 'EPSG:3857', 'EPSG:4326');
                        $('#displayPickLong').text(pickup[0]);
                        $('#displayPickLat').text(pickup[1]);
                        console.log(pickup);
                    });
                    $('#destinationGetCurrentLocationButton').click(function () {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            destination = [position.coords.longitude, position.coords.latitude];
                            let newCoordinates = ol.proj.fromLonLat(destination);
                            iconFeature1.getGeometry().setCoordinates(newCoordinates);
                            $('#displayDestinationLong').text(destination[0]);
                            $('#displayDestinationLat').text(destination[1]);
                        });
                    });
                    $('#destinationUseLocationButton').click(function () {
                        let iconCoordinates1 = iconFeature1.getGeometry().getCoordinates();
                        console.log('Destination Location:', iconCoordinates1);
                        destination = ol.proj.transform(iconCoordinates1, 'EPSG:3857', 'EPSG:4326');
                        $('#displayDestinationLong').text(destination[0]);
                        $('#displayDestinationLat').text(destination[1]);
                        console.log(destination)
                    });
                    $('#myForm').submit(function (e) {
                        e.preventDefault();
                        $('#pickupLong').val(pickup[0]);
                        $('#pickupLat').val(pickup[1]);
                        $('#destinationLong').val(destination[0]);
                        $('#destinationLat').val(destination[1]);
                        this.submit();
                    });
                });

            </script>
    </div>
@endsection
