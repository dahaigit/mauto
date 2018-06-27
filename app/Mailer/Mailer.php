<?php
namespace App\Mailer;

class Mailer
{
    /**
     * 普通发送邮件
     */
    public function sendTo($user, $subject, $view, $data = [])
    {
        // 发送邮件
        \Mail::send($view, $data, function ($message) use ($user, $subject){
            $message->from('a2210411072@163.com', '大海测试事件');
            $message->subject($subject)->to($user->email);
        });
    }

    /**
     * sendCloud发送邮件
     */
    public function cloudTo($user, $subject, $view, $data = [])
    {
        $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';

        $vars = json_encode(array("to" => array($user->email), "sub" => $data));

        $API_USER = 'dahaigit_test_bU5b9R';
        $API_KEY = 'VjnsQybUvX4D8t4J';
        $param = array(
            'apiUser' => $API_USER, # 使用api_user和api_key进行验证
            'apiKey' => $API_KEY,
            'from' => 'a2210411072@163.com', # 发信人，用正确邮件地址替代
            'fromName' => '大海测试事件',
            'xsmtpapi' => $vars,
            'templateInvokeName' => $view,
            'subject' => $subject,
            'respEmailId' => 'true'
        );


        $data = http_build_query($param);

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $data
            ));
        $context  = stream_context_create($options);
        $result = file_get_contents($url, FILE_TEXT, $context);

        return $result;
    }
}