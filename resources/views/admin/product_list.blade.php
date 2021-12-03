@extends('admin/template')
@section('content')
    {{ Common::getPage(Request::input('type')) }}
    <section class="admin_panel">
        <table class="admin_table_list">
            <tr class="admin_table_list_header">
                <th>
                    <a href="{{ route('admin_product_list', ['sort' => 'id', 'order' => 'ASC']) }}">▲</a>ID
                    <a href="{{ route('admin_product_list', ['sort' => 'id', 'order' => 'DESC']) }}">▼</a>
                </th>
                <th>画像</th>
                <th>
                    <a href="{{ route('admin_product_list', ['sort' => 'name', 'order' => 'ASC']) }}">▲</a>商品名
                    <a href="{{ route('admin_product_list', ['sort' => 'name', 'order' => 'DESC']) }}">▼</a>
                </th>
                <th>表示順</th>
                <th>登録日時</th>
                <th>
                    <a href="{{ route('admin_product_list', ['sort' => 'updated_at', 'order' => 'ASC']) }}">▲</a>更新日時
                    <a href="{{ route('admin_product_list', ['sort' => 'updated_at', 'order' => 'DESC']) }}">▼</a>
                </th>
                <th><a href="{{ route('admin_product_edit', ['type' => 'new']) }}" class="admin_btn">新規登録</a></th>
            </tr>
            @if ($products->isEmpty())
                <tr>
                    <td colspan="7" class="product_list_txt">商品の登録がありません。</td>
                </tr>
            @endif
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product['id'] }}</td>
                    <td><img src="{{ !empty($product['img']) ? asset('storage/' . $product['img']) : '' }}"></td>
                    <td>{{ $product['name'] }}</td>
                    <td>{{ $product['turn'] }}</td>
                    <td>{{ $product['created_at'] }}</td>
                    <td>{{ !empty($product['updated_at']) ? $product['updated_at'] : '' }}</td>
                    <td>
                        <a href="{{ route('admin_product_edit', ['type' => 'edit', 'id' => $product['id']]) }}" class="admin_btn edit_btn">編集</a>
                        <form action="{{ url('admin/product_list/' . $product['id']) }}" method="post" class="delete_form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <p><input type="submit" id="delete" class="admin_btn" name="delete" value="削除"></p>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
@endsection
