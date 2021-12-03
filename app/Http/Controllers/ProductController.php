<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Auth;

class ProductController extends Controller
{
    /**
     * トップ画面の表示
     *
     * @return void
     */
    public function showTop()
    {
        return view('admin/top');
    }

    /**
     * 商品一覧画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showProductList(Request $request)
    {
        // 商品一覧の取得
        $products = $this->getProductList($request->sort, $request->order);
        // 商品一覧画面の表示
        return view('admin/product_list', ['products' => $products]);
    }

    /**
     * 商品登録(編集)画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showProductEdit(Request $request)
    {
        // 商品情報の取得
        if ($request->id) {
            $product = $this->getProduct($request->id);
        } else {
            $product = '';
        }

        // 不正リクエストの防止
        if (!$request->has('type')) {
            return redirect()->route('admin_product_edit', ['type' => 'new']);
        }

        // 商品登録(編集)画面の表示
        return view('admin/product_edit', ['type' => $request->type, 'id' => $request->id, 'product' => $product]);
    }

    /**
     * 商品登録確認画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showProductConf(Request $request)
    {
        // 直接遷移対策
        if (!$request->session()->has('form_input.conf')) {
            return redirect()->route('admin_product_edit', ['type' => 'new']);
        }
        // 確認画面の表示
        return view('admin/product_conf', ['type' => $request->type, 'id' => $request->id]);
    }

    /**
     * 商品登録完了画面の表示
     *
     * @param Request $request
     * @return void
     */
    public function showProductDone(Request $request)
    {
        // 直接遷移対策
        if (!$request->session()->has('send')) {
            return redirect()->route('admin_product_edit', ['type' => 'new']);
        }
        // 登録完了画面の表示
        return view('admin/product_done', ['type' => $request->type, 'id' => $request->id]);
    }

    /**
     * 商品一覧の取得
     *
     * @return void
     */
    public function getProductList($sort, $order)
    {
        // 商品をすべて取得する
        $product = new Product;
        if (empty($sort) || empty($order)) { //ソートボタンが押されていない場合
            return $product->Where('delete_flg', FALSE)->orderBy('id', 'desc')->get();
        }
        return $product->Where('delete_flg', FALSE)->orderByRaw($sort . ' IS NULL ASC')->orderBy($sort, $order)->get();
    }

    /**
     * 商品の取得
     *
     * @param Int $id
     * @return void
     */
    public function getProduct(int $id)
    {
        // 対象の商品を取得する
        $product = new Product;
        return $product->where('id', $id)->first();
    }

    /**
     * edit画面のform処理
     *
     * @param Request $request
     * @return void
     */
    public function sendEditForm(Request $request)
    {
        if ($request->has('upload')) { // fファイル送信ボタンが押された場合

            //ファイルの保存処理
            $file_name = $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('public', $file_name);
            try {
                // データベースに登録
                $product = new Product();
                $product = $product->find($request->id);
                $product->img = $file_name;
                $product->save();

            } catch (\Exception $exception) {
                // DBとの不整合を避けるためアップロードしたファイルを削除
                Storage::delete('public/' . $file_name);
                abort(500);
            }
            // 編集画面にリダイレクト
            return redirect()->route('admin_product_edit',  ['type' => $request->type, 'id' => $request->id])->withInput($request->all())->with('success', 'ファイルのアップロードに成功しました。');
        }
        // 確認画面にリダイレクト
        return redirect()->route('admin_product_conf', ['type' => $request->type, 'id' => $request->id])->with(['form_input' => $request->all()]);
    }

    /**
     * conf画面のform処理
     *
     * @param Request $request
     * @return void
     */
    public function sendConfForm(Request $request)
    {
        if ($request->has('back')) { // 修正するボタンが押された場合
            // 編集画面にリダイレクト
            return redirect()->route('admin_product_edit',  ['type' => $request->type, 'id' => $request->id])->withInput($request->all());
        }

        if ($request->type == 'new') { // 商品登録の場合
            $this->registerProduct($request->all());
        } elseif ($request->type == 'edit') { // 商品編集の場合
            $this->editProduct($request->all());
        }

        // 完了画面にリダイレクト
        return redirect()->route('admin_product_done', ['type' => $request->type, 'id' => $request->id])->with(['send' => $request->only('send')]);
    }

    /**
     * 商品登録処理
     *
     * @param array $product_info
     * @return void
     */
    public function registerProduct(array $product_info)
    {
        // 商品の登録処理
        $product = new Product;
        $product->name = $product_info['name'];
        $product->description = $product_info['description'];
        $product->price = $product_info['price'];
        $product->turn = $product_info['turn'];
        $product->create_user = Auth::guard('admin')->user()->id;
        $product->created_at = now();
        $product->updated_at = NULL;
        $product->save();
    }

    /**
     * 商品編集処理
     *
     * @param array $product_info
     * @return void
     */
    public function editProduct(array $product_info)
    {
        // 商品の編集処理
        $product = new Product;
        $product = $product->find($product_info['id']);
        $product->name = $product_info['name'];
        $product->description = $product_info['description'];
        $product->price = $product_info['price'];
        $product->turn = $product_info['turn'];
        $product->update_user = Auth::guard('admin')->user()->id;
        $product->updated_at = now();
        $product->save();
    }

    /**
     * 商品削除処理
     *
     * @param Product $product
     * @return void
     */
    public function productDelete(Product $product)
    {
        //商品の削除処理、商品一覧画面にリダイレクト
        $product->delete_flg = TRUE;
        $product->save();
        return redirect()->route('admin_product_list');
    }
}
