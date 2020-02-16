<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     // 発行されたトークンを受け取ってメッセージを作成する
     public function __construct($token)
         {
             $this->token = $token;
         }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->from('admin@example.com', config('app.name'))
        ->subject('パスワード再設定｜STEP')
        ->line('パスワード再設定リクエストがありましたので、メッセージを送信しました。')
        ->line('下記の「パスワード再設定」ボタンもしくはURLをクリックいただくと、パスワード再設定ページに移ります。')
        ->line('※有効期限は30分となります')
        ->action('パスワード再設定', url('http://127.0.0.1:8000/'.route('password.reset', $this->token, false)))
        ->line('もし心当たりがない場合は、本メッセージは破棄してください。');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
