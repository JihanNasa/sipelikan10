<?php

namespace App\Services;

use App\Mail\ForgotPasswordMail;
use App\Mail\TestingMail;
use App\Mail\VerificationAccountMail;
use App\Models\User;
use App\Repositories\EmailRepository;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class EmailService
{

    /**
     * constructor method
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * prepare config
     *
     * @return void
     */
    public function prepare()
    {
        $mail_provider     = EmailRepository::emailProvider();
        $mail_from_address = EmailRepository::fromAddress();
        $mail_from_name    = EmailRepository::fromName();
        if ($mail_provider === 'smtp') {
            $mail_host         = EmailRepository::smtpHost();
            $mail_port         = EmailRepository::smtpPort();
            $mail_username     = EmailRepository::smtpUsername();
            $mail_password     = EmailRepository::smtpPassword();
            $mail_encryption   = EmailRepository::smtpEncryption();
        } else if ($mail_provider === 'mailtrap') {
            $mail_host         = EmailRepository::mailtrapHost();
            $mail_port         = EmailRepository::mailtrapPort();
            $mail_username     = EmailRepository::mailtrapUsername();
            $mail_password     = EmailRepository::mailtrapPassword();
            $mail_encryption   = EmailRepository::mailtrapEncryption();
        } else {
        }
        config(['mail.from.address' => $mail_from_address]);
        config(['mail.from.name' => $mail_from_name]);
        if ($mail_provider === 'smtp' || $mail_provider === 'mailtrap') {
            config(['mail.default' => 'smtp']);
            config(['mail.mailers.smtp' => [
                'transport'  => 'smtp',
                'host'       => $mail_host,
                'port'       => $mail_port,
                'encryption' => $mail_encryption,
                'username'   => $mail_username,
                'password'   => $mail_password,
                'timeout'    => null,
                'auth_mode'  => null,
            ]]);
        } else if ($mail_provider === 'mailgun') {
            $domain = EmailRepository::mailgunDomain();
            $apiKey = EmailRepository::mailgunApiKey();
            config(['mail.default' => 'mailgun']);
            config([
                'services.mailgun' => [
                    'domain'   => $domain,
                    'secret'   => $apiKey,
                    'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
                ]
            ]);
        }
        // config(['mail.from.name' => 'New Name']);
        (new \Illuminate\Mail\MailServiceProvider(app()))->register();

        // dd(config('mail'));
    }

    /**
     * send direct
     *
     * @return void
     */
    public function sendDirect(string $to, Mailable $mailable)
    {
        $this->prepare();
        Mail::to($to)->send($mailable);
    }

    /**
     * send queue
     *
     * @return void
     */
    public function sendQueue(string $to, Mailable $mailable)
    {
        $this->prepare();
        Mail::to($to)->queue($mailable);
    }

     /**
     * Kirim email reset password
     *
     * @param User $user
     * @param bool $isVerificationCode
     * @return void
     */
    public function forgotPassword(User $user, bool $isVerificationCode = false)
    {
        try {
            Mail::to($user->email)->send(new ForgotPasswordMail($user, $isVerificationCode));
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email reset password: ' . $e->getMessage());
        }
    }

    /**
     * verification account
     *
     * @param User $user
     * @param bool $isVerificationCode
     * @return void
     */
    public function verifyAccount(User $user, bool $isVerificationCode = false)
    {
        $this->sendDirect($user->email, new VerificationAccountMail($user, $isVerificationCode));
    }

 /**
     * Method testing untuk cek email service
     *
     * @param string $email
     * @param string|null $msg
     * @return void
     */
    public function testing(string $email, string $msg = null)
    {
        try {
            $fakeUser = new User([
                'email' => $email,
                'name'  => 'Tester',
                'email_token' => \Str::random(60),
                'verification_code' => rand(100000, 999999),
            ]);

            Mail::to($email)->send(new ForgotPasswordMail($fakeUser, false));

            \Log::info("✅ Email test berhasil dikirim ke {$email}");
        } catch (\Exception $e) {
            \Log::error("❌ Email test gagal: " . $e->getMessage());
        }
    }

    /**
     * send mailtrap test
     *
     * @param string $to
     * @param Mailable $mailable
     * @param string $mail_from_address
     * @param string $mail_from_name
     * @return void
     */
    public function sendMailTrapTest(string $to, Mailable $mailable, string $mail_from_address = 'anam@anam.anam', string $mail_from_name = 'Hairul Anam')
    {
        config(['mail.from.address' => $mail_from_address]);
        config(['mail.from.name' => $mail_from_name]);
        config(['mail.default' => 'smtp']);
        config(['mail.mailers.smtp' => [
            'transport'  => 'smtp',
            'host'       => 'sandbox.smtp.mailtrap.io',
            'port'       => 2525,
            'encryption' => 'tls',
            'username'   => 'b1cb77a738c140',
            'password'   => 'be3a601e17cd16',
            'timeout'    => null,
            'auth_mode'  => null,
        ]]);
        Mail::to($to)->send($mailable);
    }
    
}
