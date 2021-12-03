<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_info)
    {
        $this->user_info = $user_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('l.piro.masa.0111@exapmle.com') // 送信元
            ->subject('[HuwaHuwa]会員登録完了のお知らせ') // メールタイトル
            ->view('register_mail') // メール本文のテンプレート
            ->with(['user_info' => $this->user_info]);  // withでセットしたデータをviewへ渡す
    }
}
