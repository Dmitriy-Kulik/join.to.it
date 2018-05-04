@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Map</h1>
        <div id="map"></div>
        <script>


            var markersData = [
                {
                    lat: 56.246205,     // Широта
                    lng: 43.8964165,    // Долгота
                    name: "Название 1", // Произвольное название, которое будем выводить в информационном окне
                    address:"Адрес 1"   // Адрес, который также будем выводить в информационном окне
                },
                {
                    lat: 56.2763807,
                    lng: 43.94534,
                    name: "Название 2",
                    address:"Адрес 2"
                },
                {
                    lat: 56.3144715,
                    lng: 43.9922894,
                    name: "Название 3",
                    address:"Адрес 3"
                }
            ];

            var map, infoWindow;
            function initMap() {
                var centerLatLng = new google.maps.LatLng(56.2928515, 43.7866641);
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
                    title: name
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
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1RhDovpHGcE9hrLnbxJY7D5qxB93NwmY&callback=initMap"
                async defer></script>

        @if(Auth::user()->role == 'super_admin')

            <form method="POST" action='{{route('map.index')}}'>
                <div class="form-group">
                    <label for="add_marker">Add marker</label>
                    <input type="text" class="form-control" id="add_marker" aria-describedby="add_marker" placeholder="Add marker">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @endif
    </div>
@endsection