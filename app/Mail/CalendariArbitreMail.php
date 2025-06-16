<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Collection;

class CalendariArbitreMail extends Mailable
{
    use Queueable, SerializesModels;

    public $arbitre;
    public $partits;

    public function __construct(User $arbitre, Collection $partits)
    {
        $this->arbitre = $arbitre;
        $this->partits = $partits;
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.calendari-arbitre',
            with: [
                'arbitre' => $this->arbitre,
                'partits' => $this->partits,
            ],
        );
    }
}

