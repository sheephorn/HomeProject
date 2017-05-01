@extends('common.layout')
@section('addCss')
    <link rel="stylesheet" type="text/css" href="{{{ asset('assets/css/homebudget.css') }}}">
@stop
@include('common.header')
@section('content')
<body>
<div id="wrapper">
    <div id=header>
        <h1>トップ</h1>
        <a class="btn btn-default" href="{{ route('GET_DASHBOARD') }}">戻る</a>
    </div>
    <hr>
    <div id="body">
        <div id="add">
            <h2>家計の新規作成</h2>
            <p>作成する家計名を入力してください。</p>
            {!! Form::open() !!}
            <div class="container">
                <div class="form-group">
                    <label>家計名</label>
                    <div v-if="addMessage !== ''">
                        <label v-text="addMessage" style="color:red;"></label>
                    </div>
                    {!! Form::text('name', '', ['placeholder' => '家計名', 'class' => 'form-control', 'v-model' => 'homebudgetName']) !!}
                </div>
                <div class="form-group">
                    <add-button text="登録" action="{{ route('ADD_HOMEBUDGET') }}" memberid="{{ $request->session()->get('user')['member_id'] }}"></add-button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    <div id="footer">
    </div>
</div>
</div>
@stop
@section('addJs')
    <script src="{{{ asset('assets/js/homebudgetAdmin.js' )}}}"></script>
@stop
@include('common.footer')
