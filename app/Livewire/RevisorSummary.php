<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Announcement;
use Livewire\WithPagination;

class RevisorSummary extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $announcements;
    public $users;
    public $selectedAccetta = []; 
    public $selectedRifiuta = [];
    public $selectedAnnulla = [];

    public function mount()
    {
        $this->announcements = Announcement::all();
        $this->users = User::all();
    }
    public function render()
    {
        $users= User::all();
        $announcements= Announcement::all();
        return view('livewire.revisor-summary', ['announcements'=>$announcements,'users'=>$users]);
    }

    public function updateStatus()
    {
        foreach ($this->announcements as $announcement) {
            if (in_array($announcement->id, $this->selectedAccetta)) {
                
                $announcement->is_accepted = 1;
                $announcement->status_date = now();
                $announcement->user_revisor_id = auth()->user()->id;
                $announcement->save();
            }
            if (in_array($announcement->id, $this->selectedRifiuta)) {
                
                $announcement->is_accepted = 0;
                $announcement->status_date = now();
                $announcement->user_revisor_id = auth()->user()->id;
                $announcement->save();
            }
            if (in_array($announcement->id, $this->selectedAnnulla)) {
                
                $announcement->is_accepted = null;
                $announcement->status_date = null;
                $announcement->user_revisor_id = null;
                $announcement->save();
            }
        }

        
        $this->selectedAccetta = [];
        $this->selectedRifiuta= [];
        $this->selectedAnnulla=[];

        
    }
}
