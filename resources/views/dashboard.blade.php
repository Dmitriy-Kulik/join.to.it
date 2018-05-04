@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2>Sidebar</h2>
                        <ul class="list-group">
                            <li class="list-group-item active"><a href="{{route('dashboard.index')}}">Dashboard <span class="sr-only">(current)</span></a></li>
                            <li class="list-group-item"><a href="{{route('charts.index')}}">Charts</a></li>
                            <li class="list-group-item"><a href="{{route('tables.index')}}">Tables</a></li>
                            <li class="list-group-item"><a href="{{route('cards.index')}}">Cards</a></li>
                            <li class="list-group-item"><a href="{{route('map.index')}}">Map</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection