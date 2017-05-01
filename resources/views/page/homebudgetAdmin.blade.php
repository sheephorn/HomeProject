@extends('common.layout')
@section('addCss')
@stop
@include('common.header')
@section('content')
<body>
<div id="wrapper">
    <div id=header>
        <h1>トップ</h1>
    </div>
    <div id="body">
        <div id="add">
            {!! Form::open() !!}
            <div class="container">
                <div class="form-group">
                    <label>家計名</label>
                    <div v-if="addMessage !== ''">
                        <label v-text="addMessage" style="color:red;"></label>
                    </div>
                    {!! Form::text('name', '', ['placeholder' => '家計名', 'class' => 'form-control', 'v-model' => 'homebudgetName']) !!}
                </div>
                <add-button text="登録" action="{{ route('ADD_HOMEBUDGET') }}" memberid="{{ $request->session()->get('user')['member_id'] }}"></add-button>
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
