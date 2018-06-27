<?php
namespace App\Mailer;

class UserMailer  extends Mailer
{
    /**
     * 用户注册时发送邮件通知
     */
    public function register($user)
    {
        $data = [
            'username' => '二狗子',
        ];
        $subject = 'user register subject';
        $view = 'emails.user.register';

        $this->sendTo($user, $subject, $view, $data);
    }

    public function cloudRegister($user)
    {
        $data = [
            '%username%' => ['二狗子'],
        ];
        $subject = '欢迎注册mauto会员';
        $view = 'user_register_modes';

        $this->cloudTo($user, $subject, $view, $data);
    }
}