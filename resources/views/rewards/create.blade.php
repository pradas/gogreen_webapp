@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Premio</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/rewards') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Titulo*</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('points') ? ' has-error' : '' }}">
                            <label for="points" class="col-md-4 control-label">Puntos*</label>

                            <div class="col-md-6">
                                <input id="points" type="text" class="form-control" name="points" value="{{ old('points') }}" required>

                                @if ($errors->has('points'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('points') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category" class="col-md-4 control-label">Categoria*</label>

                            <div class="col-md-6">
                                <select id="category" class="form-control" name="category" required>
                                    <option value="0">- Selecciona una categoria -</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(old('category') == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                            <label for="end_date" class="col-md-4 control-label">Fecha finalización*</label>

                            <div class="col-md-6">

                                <div id="datepicker-end" class="input-group date" data-provide="datepicker">
                                    <input id="end_date" type="text" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>

                                @if ($errors->has('end_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('exchange_date') ? ' has-error' : '' }}">
                            <label for="exchange_date" class="col-md-4 control-label">Fecha canjeo</label>

                            <div class="col-md-6">

                                <div id="datepicker-exchange" class="input-group date" data-provide="datepicker">
                                    <input id="exchange_date" type="text" class="form-control" name="exchange_date" value="{{ old('exchange_date') }}">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-th"></span>
                                    </div>
                                </div>

                                @if ($errors->has('exchange_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exchange_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Crear
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $('#datepicker-end').datepicker({
            language: "es",
            daysOfWeekHighlighted: "0,6",
            todayHighlight: true,
            format: "dd-mm-yyyy",
            startDate: "today",
            autoclose: true
        });
        $('#datepicker-exchange').datepicker({
            language: "es",
            daysOfWeekHighlighted: "0,6",
            todayHighlight: true,
            clearBtn: true,
            format: "dd-mm-yyyy",
            startDate: "today",
            autoclose: true
        });
    </script>
@endsection