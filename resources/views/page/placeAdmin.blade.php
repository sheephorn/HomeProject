@extends('common.layout')
@section('addCss')
    <link rel="stylesheet" type="text/css" href="{{{ asset('assets/css/place.css') }}}">
@stop
@include('common.header')
@section('content')
<body>
<div id="wrapper">
    <div id=header>
        <h1>消費場所管理</h1>
        <a class="btn btn-default" href="{{ route('GET_DASHBOARD') }}">戻る</a>
    </div>
    <hr>
    <div id="body">
        <div id="buttons">
            <button type="button" class="btn btn-default" @click="toggleDiv('group')">グループ登録</button>
        </div>
        <div id="group" v-cloak v-show="show">
            <h2>グループの新規作成</h2>
            <p>作成するグループ名を入力してください。</p>
            <div class="container">
                <div class="form-group">
                    <label>グループ名</label>
                    <div v-if="message !== ''">
                        <label v-text="message" style="color:red;"></label>
                    </div>
                    {!! Form::text('name', '', ['placeholder' => 'グループ名', 'class' => 'form-control', 'v-model' => 'groupName']) !!}
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" @click="regist('{{ route('ADD_PLACE_GROUP') }}')">登録</button>
                </div>
            </div>
        </div>
        <div id="place">
            <h2>消費場所の新規作成</h2>
            <p>作成する消費場所を入力してください。</p>
            <div class="container">
                <div class="form-group">
                    <label>グループ</label>
                    <div v-if="message !== ''">
                        <label v-text="message" style="color:red;"></label>
                    </div>
                    {!! Form::select('groupId', isset($data['select']['groups'])?$data['select']['groups']:[], '', [
                    'class' => '',
                    ]) !!}
                </div>
                <div class="form-group">
                    <label>名称</label>
                    {!! Form::text('name', '', ['placeholder' => '名称', 'v-model' => 'placeName']) !!}
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-success" @click="regist('{{ route('ADD_PLACE') }}')">登録</button>
                </div>
            </div>
        </div>

    <div id="footer">
    </div>
</div>
</div>
@stop
@section('addJs')
    <script src="{{{ asset('assets/js/placeAdmin.js' )}}}"></script>
@stop
@include('common.footer')
