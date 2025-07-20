<?php

namespace App\Helpers;

use App\Models\EmailTemplate;

class EmailTemplateHelper
{
    public static function get($key)
    {
        return EmailTemplate::where('key', $key)->first();
    }

    public static function renderBody($key, array $variables = [])
    {
        $template = self::get($key);
        $body = $template?->body ?? '';

        foreach ($variables as $variable => $value) {
            $body = str_replace('{' . $variable . '}', $value, $body);
        }

        return $body;
    }

    public static function renderSubject($key, array $variables = [])
    {
        $template = self::get($key);
        $subject = $template?->subject ?? '';

        foreach ($variables as $variable => $value) {
            $subject = str_replace('{' . $variable . '}', $value, $subject);
        }

        return $subject;
    }

    public static function renderAction($key, array $variables = [])
    {
        $template = self::get($key);
        $actionText = $template?->action ?? '';

        foreach ($variables as $variable => $value) {
            $actionText = str_replace('{' . $variable . '}', $value, $actionText);
        }

        return $actionText;
    }
}
