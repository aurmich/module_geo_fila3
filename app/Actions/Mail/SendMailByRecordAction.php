<?php

declare(strict_types=1);

namespace Modules\Xot\Actions\Mail;

use Illuminate\Support\Facades\Mail;
use Modules\Xot\Mail\RecordMail;
use Spatie\QueueableAction\QueueableAction;

/**
 * Class SendMailByRecordAction
 * 
 * Invia una mail utilizzando un record come dati.
 */
class SendMailByRecordAction
{
    use QueueableAction;

    /**
     * Invia la mail.
     *
     * @param array<string, mixed> $data I dati del record
     * @param string $to Indirizzo email del destinatario
     * @return void
     */
    public function execute(array $data, string $to): void
    {
        $mailable = new RecordMail($data);
        Mail::to($to)->send($mailable);
    }
}
