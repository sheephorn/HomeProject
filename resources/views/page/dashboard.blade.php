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
        <div id="customerNav">
            <ul>
                <li><a href="" title="ユーザー情報を変更できます">登録情報変更</a></li>
                <li><a href="{{ route('GET_HOMEBUDGETADMIN_PAGE') }}" title="家計の設定を行います">家計設定</a></li>
                <li><a href="" title="消費場所の追加を行います">消費場所管理</a></li>
                <li><a href="{{ route('GET_DOCUMENT_LISTPAGE') }}" title="書類一覧ページを表示します">書類一覧</a></li>
                <li><a href="{{ route('LOGOUT') }}" title="ログアウトを行います">ログアウト</a></li>
            </ul>
        </div>
        <div id="content">

        </div>
    <div id="footer">
    </div>
</div>

</body>
@stop
@section('addJs')
    <script src="{{{ asset('assets/js/dashboard.js' )}}}"></script>
@stop
@include('common.footer')
