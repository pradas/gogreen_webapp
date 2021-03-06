@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear Premio</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/rewards') }}" enctype='multipart/form-data'>
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

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Descripción*</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" rows="4">{{ old('description') }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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

                        <div class="form-group{{ $errors->has('exchange_info') ? ' has-error' : '' }}">
                            <label for="exchange_info" class="col-md-4 control-label">Informacion Canjeo*</label>

                            <div class="col-md-6">
                                <textarea id="exchange_info" class="form-control" name="exchange_info" rows="4">{{ old('exchange_info') }}</textarea>

                                @if ($errors->has('exchange_info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exchange_info') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_web') ? ' has-error' : '' }}">
                            <label for="contact_web" class="col-md-4 control-label">Web*</label>

                            <div class="col-md-6">
                                <input id="contact_web" type="text" class="form-control" name="contact_web" value="{{ old('contact_web') }}" required>

                                @if ($errors->has('contact_web'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_web') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('contact_info') ? ' has-error' : '' }}">
                            <label for="contact_info" class="col-md-4 control-label">Informacion Contacto*</label>

                            <div class="col-md-6">
                                <textarea id="contact_info" class="form-control" name="contact_info" rows="4">{{ old('contact_info') }}</textarea>

                                @if ($errors->has('contact_info'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('contact_info') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('exchange_latitude') ? ' has-error' : '' }}">
                            <label for="exchange_latitude" class="col-md-4 control-label">Latitude Mapa (X)</label>

                            <div class="col-md-6">
                                <input id="exchange_latitude" type="text" class="form-control" name="exchange_latitude" value="{{ old('exchange_latitude') }}" required>

                                @if ($errors->has('exchange_latitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exchange_latitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('exchange_longitude') ? ' has-error' : '' }}">
                            <label for="exchange_longitude" class="col-md-4 control-label">Longitud Mapa (Y)</label>

                            <div class="col-md-6">
                                <input id="exchange_longitude" type="text" class="form-control" name="exchange_longitude" value="{{ old('exchange_longitude') }}" required>

                                @if ($errors->has('exchange_longitude'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('exchange_longitude') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reward_image') ? ' has-error' : '' }}">
                            <label for="reward_image" class="col-md-4 control-label">Imagen</label>

                            <div class="col-md-6">
                                <input type="file" id="reward_image" name="reward_image">

                                @if ($errors->has('reward_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reward_image') }}</strong>
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