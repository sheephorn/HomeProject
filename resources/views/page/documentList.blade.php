@extends('common.layout')
@section('addCss')
    <link rel="stylesheet" type="text/css" href="{{{ asset('assets/css/documentList.css') }}}">
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
        <div id="buttons">
            <button type="button" class="btn btn-default" @click="toggleDiv('list')">一覧表示</button>
            <button type="button" class="btn btn-default" @click="toggleDiv('add')">書類登録</button>
        </div>
        <div id="list" v-cloak v-show="showlist" data-action="{{ route('GET_DOCUMENT_CONTENTS') }}">
            <div class="container">
                <table class="table">
                    <thead>
                        <th>ID<br>タイトル</th>
                        <th>保管先</th>
                        <th>説明</th>
                    </thead>
                    <tbody>
                        <tr v-for="(list, index) in lists" v-cloak>
                            <td>@{{ list.document_id }}<br>@{{ list.title }}</td>
                            <td>@{{ list.address }}</td>
                            <td>@{{ list.description }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="add" v-cloak v-show="showadd">
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
    <script src="{{{ asset('assets/js/documentList.js' )}}}"></script>
@stop
@include('common.footer')
