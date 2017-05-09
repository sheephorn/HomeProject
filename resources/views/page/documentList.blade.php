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
            <h2>書類の新規作成</h2>
            <p>作成する書類の入力してください。</p>
            <div class="container">
                <div v-if="message !== ''">
                    <label v-text="message" style="color:red;"></label>
                </div>
                <div class="form-group">
                    <label>書類名</label>
                    {!! Form::text('', '', ['placeholder' => '書類名', 'class' => 'form-control', 'v-model' => 'title']) !!}
                </div>
                <div class="form-group">
                    <label>家計</label>
                    <select class="form-control" v-model="homebudgetId"><option value="aaa">NEW</option></select>
                </div>
                <div class="form-group">
                    <label>重要度</label>
                    <select class="form-control" v-model="important"><option value="aaa">NEW</option></select>
                </div>
                <div class="form-group">
                    <p class="control-label"><b>保管期限</b></p>
                    <div class="radio-inline">
                        {!! Form::radio('limit', 'infinite', false, ['v-model' => 'limit_target']) !!}
                        <span>無期限</span>
                    </div>
                    <br>
                    <div class="radio-inline">
                        {!! Form::radio('limit', 'days', false, ['v-model' => 'limit_target']) !!}
                        <span>期間指定</span>
                    </div>
                    <div class="row">
                        <div class="col-xs-1">
                            {!! Form::text('', '', ['class' => 'form-control', 'v-bind' => '{disabled : disabled_limit_days}', 'v-bind:class' => '{disabled : disabled_limit_days}', 'v-model' => 'limitDays']) !!}
                        </div>
                        <div class="col-xs-3">
                            {!! Form::select('', ['years' => '年', 'months' => 'ヶ月', 'days' => '日'], '', ['class' => 'form-control', 'v-bind:class' => '{disabled : disabled_limit_days}', 'v-bind' => '{disabled : disabled_limit_days}', 'style' => 'padding:0px', 'v-model' => 'limitDaysUnit']) !!}
                        </div>
                    </div>
                    <div class="radio-inline">
                        {!! Form::radio('limit', 'date', false, ['v-model' => 'limit_target']) !!}
                        <span>日付指定</span>
                        {!! Form::text('', '', ['class' => 'datepicker', 'readonly' => 'readonly', 'v-bind' => '{disabled : disabled_limit_date}', ':class' => 'disabled_limit_date', 'v-model' => 'limitDate', 'id' => 'limit-date']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" class="btn btn-primary" @click="add('{{ route('ADD_DOCUMENT') }}')">登録</button>
                </div>
            </div>
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
