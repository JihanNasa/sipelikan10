<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class AccountActivatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public ?string $reason;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\User  $user
     * @param  string|null  $reason
     */
    public function __construct(User $user, ?string $reason = null)
    {
        $this->user = $user;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     */
    public function build()
    {
          return $this->subject('Notifikasi: Akun Anda Telah Diaktifkan Kembali')
              ->view('emails.account.activated')
              ->with([
                  'user' => $this->user,
              ]);
    }
}
