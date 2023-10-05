<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function index() {
        $currentUserId = auth()->id();
        $announcement_to_check = Announcement::where('is_accepted',null)->where('user_id', '!=', $currentUserId)->first();
        return view('revisor.index',compact('announcement_to_check'));
    }

    public function acceptAnnouncement(Announcement $announcement){
        $announcement->status_date = now();
        $announcement->user_revisor_id = auth()->id();
        $announcement->setAccepted(true);        
        return redirect()->back()->with('message','Complimenti!,hai accettato l\'annuncio');
    }

    public function rejectAnnouncement(Announcement $announcement){
        $announcement->status_date = now();
        $announcement->user_revisor_id = auth()->id();
        $announcement->setAccepted(false);
        return redirect()->back()->with('message','Complimenti!,hai rifiutato l\'annuncio');
    }

    public function createRevisor(){
        return view ('revisor.create');
    }

    public function becomeRevisor() {
        Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user()));
        return redirect()->back()->with('message','Complimenti!2 La tua richiesta di diventare revisore è andata a buon fine');
    }

    public function makeRevisor(User $user){
        Artisan::call('presto:MakeUserRevisor',['email'=>$user->email]);
        return redirect('/')->with('message','Complimenti! L\'utente è diventato revisore');
    }

    public function requestRevisor(){

        $currentUser= Auth::user();
        return view ('revisor.request', ['user'=> $currentUser]);

    }

    public function editRevisor(Request $request)
    {
        // Prendo l'id dell'utente loggato
        $currentUserId = auth()->id();
    
        // Prendo l'annuncio che è stato revisionato dal revisore corrente e ha l'ultima modifica
        $lastAcceptedAnnouncement = Announcement::where('user_revisor_id', $currentUserId)
            ->whereNotNull('status_date')
            ->latest('status_date')
            ->first();
    
        if ($lastAcceptedAnnouncement) 
        {
            $lastAcceptedAnnouncement->is_accepted = null;
            $lastAcceptedAnnouncement->status_date = null;
            $lastAcceptedAnnouncement->user_revisor_id = null;
            $lastAcceptedAnnouncement->save();
    
            $successMessage = "L'ultima modifica relativa all'annuncio con il titolo " . $lastAcceptedAnnouncement->title . " è stata annullata";
        } else {
            $successMessage = "Non puoi annullare ulteriori operazioni";
        }
    
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
    
        return redirect()->route('revisor.index')->with(['successMessage' => $successMessage, 'announcement_to_check' => $announcement_to_check]);
    }
    
}
