<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class MailResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Template reset mail.
     * @var string
     */
    public $customTemplate = 'mails.reset_pass.email';

    /**
     * @author : Phi .
     * MailResetPasswordNotification constructor.
     * @param string $token
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * @author : Phi .
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $domain = get_env_url();

        return (new MailMessage)
            ->subject(Lang::getFromJson(__('【121チャンネル】パスワードをリセットしました。')))
            ->markdown($this->customTemplate)
            ->line(Lang::getFromJson(__('アカウントのパスワードリセットリクエストを受け取ったため、このメールを送信しています。')))
            ->action(Lang::getFromJson(__('Reset Password')), url($domain . route('passchange',
                    ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
            ->line(Lang::getFromJson(__('このパスワードリセットリンクは:count分で期限切れになります。'),
                ['count' => config('auth.passwords.users.expire')]))
            ->line(Lang::getFromJson(__('上のボタンをクリックしてパスワードリセットを完了してください。')));
    }
}
