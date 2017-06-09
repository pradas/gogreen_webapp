@extends('layouts.info')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Información</div>

                    <div class="panel-body">
                        {{ $reward->title }} usado correctamente.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
