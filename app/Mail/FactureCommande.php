<?php
namespace App\Mail;

use App\Models\Commande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureCommande extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function build()
    {
        $pdf = Pdf::loadView('pdf.facture', ['commande' => $this->commande]);

        return $this->subject('Votre facture ISI BURGER')
                    ->markdown('emails.commandes.facture')
                    ->attachData($pdf->output(), "facture_{$this->commande->id}.pdf");
    }
}
