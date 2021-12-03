@extends('admin/template')
@section('content')
    <div class="error_panel">
        <h2 class="error">{!! $message !!}</h2>
        <a href="{{ route('admin_top')}}" class="error_btn">トップページへ</a>
    </div>
@endsection
