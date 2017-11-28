<?php
/**
 * Created by HanGang.
 * Date: 2017/10/13
 */

namespace App\Traits;

use Mail;
use Naux\Mail\SendCloudTemplate;

trait SendCloudEmail
{
    /**
     * Send From
     *
     * @var string
     */
    protected $from = 'hg@hgblog.com';

    /**
     * Send From Name
     *
     * @var string
     */
    protected $fromer = 'hgblog';

    /**
     * Email Receiver
     *
     * @var string
     */
    private $receiver = '';

    /**
     * Email Bind Data
     *
     * @var array
     */
    private $bindData = [];

    /**
     * Email Template Name On SendCloud
     *
     * @var null
     */
    private $template = null;

    public function setBindData($data)
    {
        $this->bindData = $data;

        return $this;
    }

    public function setTemplate($tmpName)
    {
        if (empty($tmpName)) {
            throw new \Exception('template name can not be null');
        }

        $this->template = new SendCloudTemplate($tmpName, $this->bindData);

        return $this;
    }

    public function setReceiver($email)
    {
        if (empty($email)) {
            throw new \Exception('the receiver email can not be null');
        }

        $this->receiver = $email;

        return $this;
    }

    public function sendEmailByTemplate()
    {
        Mail::raw($this->template, function ($message) {
            $message->from($this->from, $this->fromer);
            $message->to($this->receiver);
        });
    }
}