<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\Category;
use App\Mail\ContactAdmin;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function home () {

        $announcements = Announcement::where('is_accepted',true)->orderBy('created_at','desc')->take(8)->get();

        return view('home.index', compact('announcements'));
    }

    public function categoryShow(Category $category){
        Paginator::useBootstrap();
            // $announcements=Announcement::paginate(12);
            $catAnnouncements=Announcement::where('is_accepted','=',true)->where('category_id','=',$category->id)->paginate(12);
            
        return view('category.show',compact('category','catAnnouncements'));
    }

    public function searchAnnouncements(Request $request){
        $announcements = Announcement::search($request->searched)->where('is_accepted',true)->paginate(8);

        return view('announcements.index',compact('announcements'));
    }
  
    // messaggi di errore per il form contattaci
    protected function formMessages()
{
    return [
        'name.required' => 'Il campo Nome è obbligatorio.',
        'name.max' => 'Il campo Nome non può superare i 50 caratteri.',
        'email.required' => 'Il campo Email è obbligatorio.',
        'email.email' => 'Inserisci un indirizzo email valido.',
        'user_message.required' => 'Il campo Messaggio è obbligatorio.',
        'user_message.max' => 'Il campo Messaggio non può superare i 1000 caratteri.',
        'phone.required' => 'Il campo Telefono è obbligatorio.',
        'phone.min' => 'Il campo Telefono deve avere almeno 10 caratteri.',
        'phone.max' => 'Il campo Telefono non può superare i 15 caratteri.',
        'phone.regex' => 'Il campo Telefono contiene caratteri non validi.',
    ];
}
    // Email per il dorm contattaci
    public function contact(Request $request){
        $request->validate([
            'name' => 'required|max:50|min:2',
            'email' => 'required|email',
            'user_message' => 'required|max:1000|min:8',
            'phone' => 'required|min:10|max:15||regex:/^[0-9 ()-]+$/',
    
        ],$this->formMessages());
        $name= $request->name;
        $email= $request->email;
        $user_message= $request->user_message;
        $phone= $request->phone;

        // email mandata al servizio clienti
        Mail::to('service@presto.it')->send(new ContactAdmin($name, $email, $user_message, $phone));
        
        // email di conferma mandata al mittente
        try{Mail::to($email)->send(new Contact($name, $email, $user_message, $phone));}
        catch(Exeption $error)
        {
            return redirect()->back()->with('errorMessage', 'Si è verificato un errore durante l\'invio della mail.');
        };        
        return redirect(route('home.index'))->with('successMessage', 'Grazie per averci contattato, abbiamo ricevuto la tua email. Ti risponderemo il prima possibile');
    }

    // Rotta per settare la lingua
    public function setLanguage($lang){
        session()->put('locale', $lang);
        return redirect()->back();
    }
}
