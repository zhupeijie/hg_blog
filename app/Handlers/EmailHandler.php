<?php
/**
 * Created by HanGang.
 * Date: 2017/11/12
 */

namespace App\Handlers;

use App\Models\User;
use App\Traits\SendCloudEmail;

class EmailHandler
{
    use SendCloudEmail;

    protected $methodMap = [
        'new_reply'      => 'sendNewReplyNotifyMail',
        'new_message'    => 'sendNewMessageNotifyMail',
    ];

    /**
     * 发送激活邮件
     *
     * @param User $user
     */
    public function sendActivateMail(User $user)
    {
        $bindData = [
            'url'  => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name,
        ];

        return $this->_send('template_register', $user->email, $bindData);
    }

    /**
     * 发送重置密码申请链接
     *
     * @param $email
     * @param $token
     */
    public function sendResetPasswordMail($email, $token)
    {
        // 模板变量
        $bindData = [
            'url'  => url(config('app.url').route('password.reset', $token, false)),
        ];

        return $this->_send('reset_password', $email, $bindData);
    }

    public function sendNotifyMail($type, $fromUser, $toUser, $title, $content)
    {

    }

    private function _send($template, $email, array $bindData)
    {
        return $this->setBindData($bindData)
            ->setTemplate($template)
            ->setReceiver($email)
            ->sendEmailByTemplate();
    }
}