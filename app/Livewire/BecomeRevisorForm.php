<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\BecomeRevisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BecomeRevisorForm extends Component
{
    public $formMessage, $feedback;
    public function render()
    {
        return view('livewire.become-revisor-form');
    }

    protected $rules = [
        'formMessage' => 'required|min:10',
    ];

    protected $messages = [
        'required'=>'E\' richiesto un messaggio di testo',
        'min'=>'Il messaggio è troppo corto , minimo 10 caratteri',
    ];

    public function becomeRevisor()
    {           
        $this->validate();

        $mailMessage = $this->formMessage;
        
        // Passa correttamente la variabile $mailMessage al costruttore di BecomeRevisor
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user(), $mailMessage));
        $this->formMessage="";
        $this->feedback= "Richiesta inviata correttamente";

    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    
}
