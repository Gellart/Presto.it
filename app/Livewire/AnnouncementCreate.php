<?php

namespace App\Livewire;

use File;
use Livewire\Component;
use App\Models\Category;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLogo;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;

class AnnouncementCreate extends Component
{

     use WithFileUploads;

    // 

   

    public $title , $description , $price , $color,$text, $category ,$temporary_images;

    public $images=[];
    public $image;


    //regole per le validazioni
    protected $rules = [
        'title' => 'required|min:4',
        'description'=> 'required|min:10',
        'price'=>'required|numeric',
        'category'=>'required',
        'images.*'=>'image|max:1024',
        'temporary_images.*'=>'image|max:1024',
    ];

    //messaggi personalizzati per le validazioni

    protected $messages = [
        'required'=>'Il campo è richiesto',
        'title.min'=>'Il titolo è troppo corto , minimo 4 caratteri',
        'description.min'=>'La descrizione è troppo corta , minimo 10 caratteri',
        'numeric'=>'Il campo dev\'essere un numero',
        'temporary_images.required'=>'L\'immagine è richiesta',
        'temporary_images.*.image'=>'Dev\'essere un\'immagine',
        'temporary_images.*.max'=>'L\'immagine dev\'essere massimo di 1mb',
        'images.image'=>'Dev\essere un\'immagine',
        'image.max'=>'Dev\'essere massimo di 1mb',
    ];


    //manda le immagini salvate nella $temporary_image.* a $image dopo un'ulteriore validazione

    public function updatedTemporaryImages(){
        if($this->validate([
            'temporary_images.*'=>'image|max:1024'
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[]=$image;
            }
        }
    }

    //funzione per rimuovere le immagini caricate una ad una

    public function removeImage($key){
        if(in_array($key,array_keys($this->images))){
            unset($this->images[$key]);
        }
    }

    //funzione store per caricare i dati del nuovo annuncio

    public function store() {



        //fa prima partire le validazioni
       $this->validate();

       //salva i dati nelle tabelle

       $this->announcement = Category::find($this->category)->announcements()->create($this->validate());
       //la tabella images è collegata ad announcements tramite una foreign ma non il contrario,queste due righe di codice la collegano
       $this->announcement->user()->associate(Auth::user());
       $this->announcement->save();
       //if per controllare se ci sono immagini e nel caso crea un path nella tabella e le salva tramite store nel public images
       if(count($this->images)){
        foreach ($this->images as $image) {
            // $this->announcement->images()->create(['path'=>$image->store('images','public')]);
            $newFileName = "announcements/{$this->announcement->id}";
            $newImage = $this->announcement->images()->create(['path'=>$image->store($newFileName, 'public')]);
            
            RemoveFaces::withChain(
                [
                    
                    (new GoogleVisionLogo($newImage->id)),
                    (new ResizeImage($newImage->path , 400 , 300 )),                   
                    (new GoogleVisionSafeSearch($newImage->id)),
                    (new GoogleVisionLabelImage($newImage->id)),
                    
                ]
            )->dispatch($newImage->id);
            
        
        }

         File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

       // vecchio codice per salvare annuncio prima delle immagini
        // $category = Category::find($this->category);
        // $announcement = $category->announcements()->create([
        //     'title'=>$this->title,
        //     'description'=>$this->description,
        //     'price'=>$this->price
        // ]);

        //messaggio flash che compare dopo il save con successo
        session()->flash('message','Annuncio inserito con successo, in attesa di validazione');
    
        // Auth::user()->announcements()->save($announcement);

        //richiamo funzione per pulire i campi del form
        $this->cleanForm();

    }

    //rende le validazioni di errore in tempo reale
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // funzione per pulire i campi del form
    public function cleanForm() {
        $this->title ='';
        $this->description ='';
        $this->price='';
        $this->category='';
        $this->image='';
        $this->images=[];
        $this->temporary_images=[];
        }

        //funzione di ritorno della vista
    public function render()
    {
        return view('livewire.announcement-create');
    }
}
