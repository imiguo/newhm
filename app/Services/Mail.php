<?php
namespace App\Services;

class Mail
{
    public static function send($to, $templateId, $data)
    {
        $mail = \App\Mail::where('id', $templateId)->where('status', 1)->first();
        if (! $mail) return false;

        $subject = preg_replace('/#site_name#/', config('app.name'), $mail->subject);
        $subject = preg_replace('/#site_url#/', config('hm.url'), $subject);

        $text = preg_replace('/#site_name#/', config('app.name'), $mail->text);
        $text = preg_replace('/#site_url#/', config('hm.url'), $text);

        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $v = $v[0];
            }
            $text = preg_replace(''.'/#'.$k.'#/', $v, $text);
            $subject = preg_replace(''.'/#'.$k.'#/', $v, $subject);
        }

        $from = config('hm.mailer');
        return mail($to, $subject, $text, ''.'From: '.$from.'Reply-To: '.$from);
    }
}
