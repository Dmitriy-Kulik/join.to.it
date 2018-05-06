@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Map</div>
            <div class="card-body">
                <div id="map"></div>
                <script>
                    var markersData = [];

                     var map, infoWindow;
                     function initMap() {
                         var coordinates = {lat: 50.4501, lng: 30.5234}
                         if(markersData.length > 0){
                            coordinates.lat = markersData[markersData.length - 1].lat;
                            coordinates.lng = markersData[markersData.length - 1].lng;
                         }

                         var centerLatLng = new google.maps.LatLng(coordinates.lat, coordinates.lng);

                         var mapOptions = {
                             center: centerLatLng,
                             zoom: 8
                         };
                         map = new google.maps.Map(document.getElementById("map"), mapOptions);
                         // Создаем объект информационного окна и помещаем его в переменную infoWindow
                         // Так как у каждого информационного окна свое содержимое, то создаем пустой объект, без передачи ему параметра content
                         infoWindow = new google.maps.InfoWindow();
                         // Отслеживаем клик в любом месте карты
                         google.maps.event.addListener(map, "click", function() {
                             // infoWindow.close - закрываем информационное окно.
                             infoWindow.close();
                         });
                         // Перебираем в цикле все координата хранящиеся в markersData
                         for (var i = 0; i < markersData.length; i++){
                             var latLng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
                             var name = markersData[i].name;
                             var address = markersData[i].address;
                             // Добавляем маркер с информационным окном
                             addMarker(latLng, name, address);
                         }
                     }
                     google.maps.event.addDomListener(window, "load", initMap);

                     // Функция добавления маркера с информационным окном
                     function addMarker(latLng, name, address) {
                         var marker = new google.maps.Marker({
                             position: latLng,
                             map: map,
                             title: name,
                             animation: google.maps.Animation.DROP
                         });
                         // Отслеживаем клик по нашему маркеру
                         google.maps.event.addListener(marker, "click", function() {
                             // contentString - это переменная в которой хранится содержимое информационного окна.
                             var contentString = '<div class="infowindow">' +
                                 '<h3>' + name + '</h3>' +
                                 '<p>' + address + '</p>' +
                                 '</div>';
                             // Меняем содержимое информационного окна
                             infoWindow.setContent(contentString);
                             // Показываем информационное окно
                             infoWindow.open(map, marker);
                         });
                     }

                     function GetAddress(){
                         var title = document.getElementById('title').value;
                         var address = document.getElementById('address').value;

                         $.ajax({
                             type: 'get',//тип запроса: get,post либо head
                             url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&sensor=false&language=ru',//url адрес файла обработчика
                             data: {'q': '1'},//параметры запроса
                             response: 'json',//тип возвращаемого ответа text либо xml

                             success: function (data) {//возвращаемый результат от сервера
                                 if(data.status){
                                     markersData.push({
                                         lat: data.results[0].geometry.location.lat,
                                         lng: data.results[0].geometry.location.lng,
                                         name: title,
                                         address: address
                                     });
                                 }

                                 initMap();
                             },
                             error: function (error) {
                                 console.log(error.responseJSON.error_message);
                             }
                         });
                     }

                     function SaveMarkers() {
                         $.ajax({
                             type: 'post',//тип запроса: get,post либо head
                             url: 'api/map',//url адрес файла обработчика
                             data: {'marker': markersData},//параметры запроса
                             response: 'json',//тип возвращаемого ответа text либо xml

                             success: function (data) {//возвращаемый результат от сервера
                                 console.log(data);
                             },
                             error: function (error) {
                                 console.log(error);
                             }
                         });
                     }

                     // var markersData = [
                     //     // {
                     //     //     lat: 56.246205,     // Широта
                     //     //     lng: 43.8964165,    // Долгота
                     //     //     name: "Название 1", // Произвольное название, которое будем выводить в информационном окне
                     //     //     address:"Адрес 1"   // Адрес, который также будем выводить в информационном окне
                     //     // },
                     //     // {
                     //     //     lat: 56.2763807,
                     //     //     lng: 43.94534,
                     //     //     name: "Название 2",
                     //     //     address:"Адрес 2"
                     //     // },
                     //     // {
                     //     //     lat: 56.3144715,
                     //     //     lng: 43.9922894,
                     //     //     name: "Название 3",
                     //     //     address:"Адрес 3"
                     //     // }
                     // ];
                     //
                     // var map, infoWindow;
                     // function initMap() {
                     //     var coordinates = {lat: 47.212325, lng: 38.933663},
                     //
                     //         map = new google.maps.Map(document.getElementById('map'), {
                     //             center: coordinates,
                     //             zoom: 8
                     //         });
                     //
                     //     SendGet();
                     //
                     //     function addMarker() {
                     //         marker = new google.maps.Marker({
                     //             position: {lat: markersData[0].lat, lng: markersData[0].lng},
                     //             map: map,
                     //             animation: google.maps.Animation.DROP
                     //         });
                     //     }
                     //
                     //     for (var i = 0; i < markersData.length; i++){
                     //          var latLng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
                     //          var name = markersData[i].name;
                     //          var address = markersData[i].address;
                     //          // Добавляем маркер с информационным окном
                     //          addMarker(latLng, name, address);
                     //      }
                     //
                     //     //addMarker();
                     //
                     // }
                     //
                     // function SendGet(){
                     //     var title = document.getElementById('title').value;
                     //     var address = document.getElementById('address').value;
                     //     console.log(address, title);
                     //     //markersData.push({title, address});
                     //     //console.log(markersData);
                     //
                     //     $.ajax({
                     //         type: 'get',//тип запроса: get,post либо head
                     //         url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + address + '&sensor=false&language=ru',//url адрес файла обработчика
                     //         data: {'q': '1'},//параметры запроса
                     //         response: 'json',//тип возвращаемого ответа text либо xml
                     //
                     //         success: function (data) {//возвращаемый результат от сервера
                     //             //console.log(data.results[0].geometry.location);
                     //             if(data.status){
                     //                 markersData.push({
                     //                     lat: data.results[0].geometry.location.lat,
                     //                     lng: data.results[0].geometry.location.lng,
                     //                     name: title,
                     //                     address: address
                     //                 });
                     //             }
                     //             console.log(markersData);
                     //
                     //
                     //             //console.log(markersData);
                     //             // var marker = new google.maps.Marker({
                     //             //     position: {lat: markersData[0].lat, lng: markersData[0].lat},
                     //             //     map: map,
                     //             //     title: name
                     //             // });
                     //             // google.maps.event.addListener(marker, "click", function() {
                     //             //     // contentString - это переменная в которой хранится содержимое информационного окна.
                     //             //     var contentString = '<div class="infowindow">' +
                     //             //         '<h3>' + name + '</h3>' +
                     //             //         '<p>' + address + '</p>' +
                     //             //         '</div>';
                     //             //     // Меняем содержимое информационного окна
                     //             //     infoWindow.setContent(contentString);
                     //             //     // Показываем информационное окно
                     //             //     infoWindow.open(map, marker);
                     //             // });
                     //         },
                     //         error: function (error) {
                     //             console.log(error.responseJSON.error_message);
                     //         }
                     //     });
                     // }

                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1RhDovpHGcE9hrLnbxJY7D5qxB93NwmY&callback=initMap"
                        async defer></script>

                @if(Auth::user()->role == 'super_admin' || Auth::user()->role == 'admin')
                    <form action="/" id='myform' name="myform" method="post">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" value="london" placeholder="Add title">
                        </div>
                        <div class="form-group">
                            <label for="address">Add address</label>
                            <input type="text" class="form-control" id="address" name="address" aria-describedby="address" value="london" placeholder="Add address">
                        </div>
                        <input type="button" class="btn btn-primary run" onclick="GetAddress()" value="Add a marker to the map"></input>
                        <input class="subm btn btn-primary run" type="button" onclick="SaveMarkers()" value="Save markers"><br>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection

{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--<link href="https://developers.google.com/maps/documentation/javascript/examples/default.css" rel="stylesheet">--}}
{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1RhDovpHGcE9hrLnbxJY7D5qxB93NwmY&callback=initialize"--}}
{{--async defer></script>--}}
{{--<script>--}}
    {{--var geocoder;--}}
    {{--var map;--}}
    {{--var mapOptions = {--}}
        {{--zoom: 17,--}}
        {{--mapTypeId: google.maps.MapTypeId.ROADMAP--}}
    {{--}--}}
    {{--var marker;--}}
    {{--function initialize() {--}}
        {{--geocoder = new google.maps.Geocoder();--}}
        {{--map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);--}}
        {{--codeAddress();--}}
    {{--}--}}
    {{--function codeAddress() {--}}
        {{--var address = document.getElementById('address').value;--}}
        {{--geocoder.geocode( { 'address': address}, function(results, status) {--}}
            {{--if (status == google.maps.GeocoderStatus.OK) {--}}
                {{--map.setCenter(results[0].geometry.location);--}}
                {{--if(marker)--}}
                    {{--marker.setMap(null);--}}
                {{--marker = new google.maps.Marker({--}}
                    {{--map: map,--}}
                    {{--position: results[0].geometry.location,--}}
                    {{--draggable: true--}}
                {{--});--}}
                {{--google.maps.event.addListener(marker, "dragend", function() {--}}
                    {{--document.getElementById('lat').value = marker.getPosition().lat();--}}
                    {{--document.getElementById('lng').value = marker.getPosition().lng();--}}
                {{--});--}}
                {{--document.getElementById('lat').value = marker.getPosition().lat();--}}
                {{--document.getElementById('lng').value = marker.getPosition().lng();--}}
            {{--} else {--}}
                {{--alert('Geocode was not successful for the following reason: ' + status);--}}
            {{--}--}}
        {{--});--}}
    {{--}--}}
{{--</script>--}}
{{--</head>--}}
{{--<body onload="initialize()">--}}
{{--<div>--}}
    {{--<input id="address" type="textbox" style="width:60%" value="rua tabapuã - vila olimpia - são paulo">--}}
    {{--<input type="button" value="Geocode" onclick="codeAddress()">--}}
    {{--<input type="text" id="lat"/>--}}
    {{--<input type="text" id="lng"/>--}}

{{--</div>--}}
{{--<div id="map_canvas" style="height:60%;top:30px"></div>--}}
{{--@endsection--}}