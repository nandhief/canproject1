<?php

namespace App\Http\Middleware;

use Closure;
use App\Setting;

class OverwriteMail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $server = Setting::mail()->server;
        $mail_config = config('mail');
        $mail_config['host'] = $server->host;
        $mail_config['username'] = $server->email;
        $mail_config['password'] = $server->password;
        config()->set('mail', $mail_config);
        $app = app()->getInstance();
        $app->register('Illuminate\Mail\MailServiceProvider');
        return $next($request);
    }
}
