@extends('template')
@section('content')
    <div class="error_panel">
        <h2 class="error">{!! $message !!}</h2>
        <a href="{{ url('/index')}}" class="error_btn">トップページへ</a>
    </div>
@endsection
