@extends('admin/template')
@section('content')
    {{ Common::getPage(Request::input('type')) }}
    <section class="admin_panel">
        <form action="{{ url('admin/product_edit?type=' . $type . (!empty($id) ? '&id=' . $id : '')) }}" method="post">
            {{ csrf_field() }}
            <table class="admin_table_edit">
                <tr>
                    <th>商品名</th>
                    <td>
                        <input type="text" name="name" value="{{ old('name', !empty($product->name) ? $product->name : '') }}">
                    </td>
                </tr>
                <tr>
                    <th>値段</th>
                    <td>
                        <input type="text" name="price" value="{{ old('price', !empty($product->price) ? $product->price : '') }}">
                    </td>
                </tr>
                <tr>
                    <th>表示順</th>
                    <td>
                        <input type="text" name="turn" value="{{ old('turn', !empty($product->turn) ? $product->turn : '') }}">
                    </td>
                </tr>
                <tr>
                    <th>説明文</th>
                    <td>
                        <textarea name="description">{{ old('description', !empty($product->description) ? $product->description : '') }}</textarea>
                    </td>
                </tr>
            </table>
            <p class="admin_edit_form_submit"><input type="submit" name="conf" value="確認画面へ"></p>
        </form>
        @if ($type == 'edit')
            <hr class="table_divide"></hr>
            <form action="{{ url('admin/product_edit?type=' . $type . (!empty($id) ? '&id=' . $id : '')) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @if (Session::get('success'))
                    <p class="file_success">{{ Session::get('success') }}</p>
                @endif
                <table class="admin_table_edit_file">
                    <tr>
                        <th>サムネイル</th>
                        <td><input type="file" name="file"></td>
                    </tr>
                    <tr>
                        <th>トップページサムネイル</th>
                        <td>
                            @if (!empty($product->img))
                                <img src="{{ asset('storage/' . $product->img) }}">
                                <p>{{ $product->img }}</p>
                            @endif
                        </td>
                    </tr>
                </table>
                <p class="admin_edti_form_notes">半角英数字のファイルのみアップ可能です。</p>
                <p class="admin_edit_form_submit"><input type="submit" id="upload" name="upload" value="アップロード"></p>
            </form>
        @endif
    </section>
@endsection
