<?php

namespace App\lib;

use Illuminate\Http\Request;

class Common
{
    /**
     * ページボタン振り分け処理
     *
     * @return string
     */
    public function getPage($type)
    {
        $func = [
            'product' => '商品管理'
        ];

        $view = [
            'list' => 'リスト',
            'edit' => '',
            'conf' => '確認',
            'done' => '完了'
        ];

        // 対象のURL
        $url = basename(url()->current());
        // 対象のURLを分割
        $url_count = mb_strrpos($url, '_');
        $url_part[] = mb_substr($url, 0, $url_count);
        $url_part[] = mb_substr($url, $url_count + 1);

        echo '<div class="page_btn">'
            . '<p>' . $func[$url_part[0]] . (!empty($type) ? config('const.common.type.' . $type): '') . $view[$url_part[1]] . '</p>'
            . '</div>'
        ;
    }
}
