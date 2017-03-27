@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-10">
                            Listado de premios
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-primary" href="{{url('rewards/create')}}">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Crear
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Titulo</th>
                            <th>Puntos</th>
                            <th>Categoria</th>
                            <th>Fecha finalización</th>
                            <th>Fecha intercambio</th>
                            <th>Opciones</th>
                        </tr>
                        @foreach($rewards as $reward)
                            <tr>
                                <td>{{$reward->title}}</td>
                                <td>{{$reward->points}}</td>
                                <td>{{$reward->category}}</td>
                                <td>{{$reward->end_date}}</td>
                                <td>{{$reward->exchange_date}}</td>
                                <td>
                                    <form method="POST" action="{{ url('/rewards/'.$reward->id) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                    <a class="btn btn-warning btn-sm" href="{{url('rewards/'.$reward->id.'/edit')}}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
