@extends('common.layout')
@include('common.header')
@section('addCss')
@stop
@section('content')

<passport-clients></passport-clients>
<passport-authorized-clients></passport-authorized-clients>
<passport-personal-access-tokens></passport-personal-access-tokens>
<div id="app"></div>


@stop
@include('common.footer')
@section('addJs')
