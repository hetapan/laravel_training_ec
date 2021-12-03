<?php
$birth_year = [];
$birth_month = [];
$birth_day = [];
for ($i = 1900; $i <= 2021; $i++) {
    $birth_year += array($i => $i);
}
for ($i = 1; $i <= 12; $i++) {
    $birth_month += array($i => $i);
}
for ($i = 1; $i <= 31; $i++) {
    $birth_day += array($i => $i);
}

//画像の保存パス
// define('IMGS_PATH', '../images/upload/');
// define('IMGS_PATH_TOP', 'images/upload/');

// //商品購入
// define('MODIFY', [
//     '1' => '変更しない',
//     '2' => '変更する'
// ]);

return [
    'common' => [
        'birth_year' => $birth_year,
        'birth_month' => $birth_month,
        'birth_day' => $birth_day,
        'gender' => ['1' => '男性', '2' => '女性', '99' => '未回答'],
        'pref' => [
            '1' => '北海道', '2' => '青森県', '3' => '岩手県', '4' => '宮城県', '5' => '秋田県', '6' => '山形県', '7' => '福島県', '8' => '茨城県', '9' => '栃木県', '10' => '群馬県',
            '11' => '埼玉県', '12' => '千葉県', '13' => '東京都', '14' => '神奈川県', '15' => '山梨県', '16' => '新潟県', '17' => '富山県', '18' => '石川県', '19' => '福井県', '20' => '長野県',
            '21' => '岐阜県', '22' => '静岡県', '23' => '愛知県', '24' => '三重県', '25' => '滋賀県', '26' => '京都府', '27' => '大阪府', '28' => '兵庫県', '29' => '奈良県', '30' => '和歌山県',
            '31' => '鳥取県', '32' => '島根県', '33' => '岡山県', '34' => '広島県', '35' => '山口県', '36' => '徳島県', '37' => '香川県', '38' => '愛媛県', '39' => '高知県', '40' => '福岡県',
            '41' => '佐賀県', '42' => '長崎県', '43' => '熊本県', '44' => '大分県', '45' => '宮崎県', '46' => '鹿児島県', '47' => '沖縄県'
        ],
        'payment' => ['1' => '各種クレジットカード決済', '2' => '銀行振込', '3' => '代金引換'],
        'type' => ['new' => '登録', 'edit' => '編集'],
    ],

    'mail' => [
        'mail_from' => '{{HuwaHuwa}<{info@huwahuwa.com}>',
        'mail_title' => '[HuwaHuwa]会員登録完了のお知らせ',
        'mail_title_purchase' => '[HuwaHuwa]商品購入完了のお知らせ',
        'mail_header' => [
            'MIME-Version' => '1.0',
            'Content-Transfer-Encoding' => '7bit',
            'Content-Type' => 'text/plain; charset=ISO-2022-JP-MS',
            'Return-Path' => 'info@huwahuwa.com',
            'From' => 'HuwaHuwa <info@huwahuwa.com>',
            'Sender' => 'HuwaHuwa <info@huwahuwa.com>'
        ]
    ],


];
