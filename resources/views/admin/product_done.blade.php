@extends('admin/template')
@section('content')
    {{ Common::getPage(Request::input('type')) }}
    <section class="admin_panel">
        <p class="admin_form_done_text">{{ config('const.common.type.' . $type) }}完了しました。</p>
    </section>
@endsection
