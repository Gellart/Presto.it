<?php

namespace App\Livewire;

use App\Models\User; 
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Favorite extends Component
{
    public $announcement;
    public $isFavorite;

    public function mount($announcement)
    {
        $this->announcement = $announcement;
        $this->isFavorite = $this->announcementIsFavorite();
    }

    public function toggleFavorite()
    {
        $user = auth()->user(); // Recupero l'utente autenticato

        if ($this->isFavorite) {
            // Rimuovo l'annuncio dai preferiti dell'utente
            $user->favorites()->detach($this->announcement->id);
        } else {
            // Aggiungo l'annuncio ai preferiti dell'utente
            $user->favorites()->attach($this->announcement->id);
        }

        $this->isFavorite = !$this->isFavorite; // Inverto lo stato dei preferiti
    }

    private function announcementIsFavorite()
    {
        $userId = auth()->user()->id; 
        $announcementId = $this->announcement->id;
        $checkFavorite = DB::table('user_favorite_announcements')
        ->where('user_id', $userId)
        ->where('announcement_id', $announcementId)
        ->exists();


        return $checkFavorite;
    }

    public function render()
    {
        return view('livewire.favorite');
    }
}
