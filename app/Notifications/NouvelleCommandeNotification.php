<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Commande;

class NouvelleCommandeNotification extends Notification
{
    use Queueable;

    public $commande;

    public function __construct(Commande $commande)
    {
        $this->commande = $commande;
    }

    // ✅ Indiquer les canaux de notification
    public function via($notifiable)
    {
        return ['database', 'mail']; // Enregistre en base et envoie un mail
    }

    // ✅ Notification enregistrée en base de données
    public function toArray($notifiable)
    {
        return [
            'message' => 'Une nouvelle commande a été reçue.',
            'contenu' => "Commande N°{$this->commande->id} passée par {$this->commande->client->name} pour {$this->commande->montant_total}€.",
            'url' => url('/gestionnaire/commandes'),
        ];
    }

    // ✅ Notification envoyée par email
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle commande reçue')
            ->line("Une nouvelle commande N°{$this->commande->id} a été passée par {$this->commande->client->name}.")
            ->line("Montant total : {$this->commande->montant_total} €.")
            ->action('Voir les commandes', url('/gestionnaire/commandes'))
            ->line('Merci de vérifier et de préparer la commande.');
    }
}
