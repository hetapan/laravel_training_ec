@extends('admin/template')
@section('content')
    {{ Common::getPage(Request::input('type')) }}
    <section class="admin_panel">
        <table class="admin_table_edit">
            <tr>
                <th>商品名</th>
                <td>{{ Session::get('form_input.name') }}</td>
            </tr>
            <tr>
                <th>値段</th>
                <td>{{ Session::get('form_input.price') }}</td>
            </tr>
            <tr>
                <th>表示順</th>
                <td>{{ Session::get('form_input.turn') }}</td>
            </tr>
            <tr>
                <th>説明文</th>
                <td>{!! nl2br(e(Session::get('form_input.description'))) !!}</td>
            </tr>
        </table>
        <div class="admin_edit_box">
            <form action="{{ url('admin/product_conf?type=' . $type . (!empty($id) ? '&id=' . $id : '')) }}" class="conf_form" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="name" value="{{ Session::get('form_input.name') }}">
                <input type="hidden" name="price" value="{{ Session::get('form_input.price') }}">
                <input type="hidden" name="turn" value="{{ Session::get('form_input.turn') }}">
                <input type="hidden" name="description" value="{{ Session::get('form_input.description') }}">
                <p class="admin_edit_form_submit"><input type="submit" name="send" value="{{ config('const.common.type.' . $type) }}完了"></p>
                <p class="admin_edit_form_submit admin_edit_form_submit_fix"><input type="submit" name="back" value="修正"></p>
            </form>
            <div class="admin_edit_box_2"></div>
        </div>
    </section>
@endsection
