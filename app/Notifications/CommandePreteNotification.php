<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandePreteNotification extends Notification
{
    use Queueable;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // Enregistrement en base + envoi mail
    }

    public function toArray($notifiable)
    {
        // Générer le lien du fichier PDF de la facture
        $factureUrl = route('factures.download', ['commande' => $this->commande->id]);
    
        return [
            'message' => "Votre commande est prête ! Cliquez pour voir votre facture.",
             'url' => route('commandes.showFacture', ['commande' => $this->commande->id]),
            'filename' => "facture_{$this->commande->id}.pdf",
            'commande_id' => $this->commande->id // ✅ Ajout de la clé commande_id
        ];
    }
    

    public function toMail($notifiable)
    {
        $factureUrl = route('factures.download', ['commande' => $this->commande->id]);

        return (new MailMessage)
        ->subject('Votre commande est prête !')
        ->line("Votre commande N°{$this->commande->id} est prête.")
        ->action('Télécharger la facture', route('factures.download', ['commande' => $this->commande->id])) // ✅ Correction du lien
        ->line('Merci pour votre commande chez ISI BURGER !');
}
}
