<?php
namespace App\Mail;

use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommandePreteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function build()
    {
        // Vérifier que la commande et ses burgers existent
        if (!$this->commande || $this->commande->burgers->isEmpty()) {
            return $this->view('emails.commande_prete')
                ->subject('Votre commande #'.$this->commande->id.' est prête !');
        }

        // Générer le PDF de la facture
        $pdf = Pdf::loadView('emails.facture', ['commande' => $this->commande]);

        return $this->subject('Votre commande #'.$this->commande->id.' est prête !')
                    ->view('emails.commande_prete')
                    ->attachData($pdf->output(), 'facture_'.$this->commande->id.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}

