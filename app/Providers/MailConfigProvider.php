<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class MailConfigProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            if (Setting::get('smtp_enabled') === '1') {
                $config = Setting::getSmtpConfig();

                config([
                    'mail.default' => 'smtp',
                    'mail.mailers.smtp.host' => $config['smtp_host'],
                    'mail.mailers.smtp.port' => (int) $config['smtp_port'],
                    'mail.mailers.smtp.encryption' => $config['smtp_encryption'] ?: null,
                    'mail.mailers.smtp.username' => $config['smtp_username'],
                    'mail.mailers.smtp.password' => $config['smtp_password'],
                    'mail.from.address' => $config['smtp_from_address'],
                    'mail.from.name' => $config['smtp_from_name'],
                ]);
            } else {
                config(['mail.default' => 'sendmail']);
            }
        } catch (\Throwable) {
            // Table may not exist yet (fresh install / migration pending)
        }
    }
}
