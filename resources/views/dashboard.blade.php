@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2">
                @include('components.sidebar')
            </div>
            <div class="col-sm-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <td>#</td>
                                <td>Имя</td>
                                <td>Фамилия</td>
                                <td>Email</td>
                                <td>Роль</td>
                                <td>Дата создания</td>
                                <td>Дата редактирования</td>
                                <td>Дата удаления</td>
                                <td>Редактировать</td>
                                <td>Удалить</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->first_name}}</td>
                                    <td>{{$user->last_name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>{{$user->deleted_at}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route('is_super_admin.dashboard.edit', $user)}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        <form onsubmit="if(confirm('Удалить?')){ return true} else false" action="{{route('is_super_admin.dashboard.destroy', $user)}}" method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn"><i class="fa fa-trash"></i></button>
                                            {{ csrf_field() }}
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $users -> links() }}
                        </div>
                        <div class="text-center">
                            <a class="btn btn-primary" href="{{route('is_super_admin.dashboard.create')}}">Add user</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection