@extends('common.layout')
@section('addCss')
@stop
@include('common.header')
@section('content')
<body>
<div id="wrapper">
    <div id=header>
        <h1>Login</h1>
    </div>
    <div id="body">
        <div id="loginbox">
            <div class="container" id="login-entry" v-show="showLogin">
                {!! Form::open(['route' => 'GET_LOGIN']) !!}
                <p>ログイン</p>
                @if(isset($message))
                <p class="error">{{{ $message }}}</p>
                @endif
                <div class="row">
                    {!! Form::text('email', '', ['placeholder' => 'e-mail']) !!}
                </div>
                <div class="row">
                    {!! Form::password('password',['placeholder' => 'password']) !!}
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary">ログイン</button>
                    <button type="button" class="btn btn-default" @click="toggleLoginAndRegist()">新規登録画面へ</button>
                    </div>
                    {!! Form::close() !!}
                    <div class="row">
                        {!! Form::open(['route' => 'GET_DASHBOARD', 'method' => 'get']) !!}
                        <auto-button login="{{ session('user') ? 1: 0 }}"></auto-button>
                        {!! Form::close() !!}
                    </div>
        </div>
        <div class="container one-time-hidden" v-show="showRegist">
            {!! Form::open(['route' => 'USER_REGIST']) !!}
            <p>新規登録</p>
            <div class="row">
                {!! Form::text('email', '', ['placeholder' => 'e-mail']) !!}
            </div>
            <div class="row">
                {!! Form::password('password', ['placeholder' => 'password']) !!}
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary">登録</button>
                <button type="button" class="btn btn-default" @click="toggleLoginAndRegist()">ログイン画面へ</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div id="footer">
    </div>
</div>

</body>
@stop
@section('addJs')
    <script src="{{{ asset('assets/js/login.js' )}}}"></script>
@stop
@include('common.footer')
