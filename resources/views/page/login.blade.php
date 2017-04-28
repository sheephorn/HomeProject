@extends('common.layout')
@include('common.header')
@section('addCss')
@stop
@section('content')
<body>
<div id="wrapper">
    <div id=header>
        <h1>Login</h1>
    </div>
    <div id="body">
        <div id="loginbox">
            <div class="container">
                {!! Form::open(['route' => 'GET_LOGIN']) !!}
                <div class="row">
                    {!! Form::text('email', '', ['placeholder' => 'e-mail']) !!}
                </div>
                <div class="row">
                    {!! Form::password('password', '', ['placeholder' => 'password']) !!}
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    {!! Form::close() !!}
        </div>
    </div>
    <div id="footer">
    </div>
</div>

</body>
@stop
@include('common.footer')
@section('addJs')
