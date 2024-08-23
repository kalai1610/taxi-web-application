let iconFeature = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.fromLonLat([77.238396, 11.504776])),
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
        center: ol.proj.fromLonLat([77.238396, 11.504776]),
        zoom: 12,
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
    geometry: new ol.geom.Point(ol.proj.fromLonLat([77.238396, 11.504776])),
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
        center: ol.proj.fromLonLat([77.238396, 11.504776]),
        zoom: 12,
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
let pickup;
let destination;
$(document).ready(function(){
$('#pickupGetCurrentLocationButton').click(function () {
    navigator.geolocation.getCurrentPosition(function (position) {
        pickup=[position.coords.longitude, position.coords.latitude]
        $('#displayPickLong').text(pickup[0]);
        $('#displayPickLat').text(pickup[1]);
        console.log(pickup);
        let newCoordinates = ol.proj.fromLonLat(pickup);
        iconFeature.getGeometry().setCoordinates(newCoordinates);
    });
});

$('#pickupUseLocationButton').click( function () {
    let iconCoordinates = iconFeature.getGeometry().getCoordinates();
    console.log('Pickup Location:', iconCoordinates);
    pickup = ol.proj.transform(iconCoordinates, 'EPSG:3857', 'EPSG:4326');
    $('#displayPickLong').text(pickup[0]);
    $('#displayPickLat').text(pickup[1]);
    console.log(pickup);
});
$('#destinationGetCurrentLocationButton').click( function () {
    navigator.geolocation.getCurrentPosition(function (position) {
        destination=[position.coords.longitude, position.coords.latitude];
        let newCoordinates = ol.proj.fromLonLat(destination);
        iconFeature1.getGeometry().setCoordinates(newCoordinates);
        $('#displayDestinationLong').text(destination[0]);
        $('#displayDestinationLat').text(destination[1]);
    });
});
$('#destinationUseLocationButton').click( function () {
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
