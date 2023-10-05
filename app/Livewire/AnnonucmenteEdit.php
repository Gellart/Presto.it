<?php

namespace App\Livewire;
use File;
use App\Models\Image;
use Livewire\Component;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use Illuminate\Support\Facades\Auth;


class AnnonucmenteEdit extends Component
{
    use WithFileUploads;

    public $announcement, $title, $description , $price , $color, $text, $category ,$temporary_images, $images=[], $currentImages, $image, $imageId;

    public function mount($announcement)
    {
        
        $this->title = $this->announcement->title;
        $this->description = $this->announcement->description;
        $this->price = $this->announcement->price;
        $this->category = $this->announcement->category->id;
        $this->currentImages=$this->announcement->images;
       
    }

    public function render()
    {
       $announcement=$this->announcement;
        return view('livewire.annonucmente-edit', ['announcement'=>$announcement]);
    }

       
    //regole per le validazioni
    protected $rules = [
        'title' => 'required|min:6',
        'description'=> 'required|min:6',
        'price'=>'required|numeric',
        'category'=>'required',
        'images.*'=>'image|max:1024',
        'temporary_images.*'=>'image|max:1024',
    ];

    //messaggi personalizzati per le validazioni

    protected $messages = [
        'required'=>'Il campo è richiesto',
        'min'=>'Il campo è troppo corto , minimo 6 caratteri',
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

    public function removeAImage($aImage){
       $idImage = $aImage['id'];
       $pathImage = $aImage['path'];
       $pathImageArray=explode("/", $pathImage);
       $imgName=$pathImageArray['2'];
       $imgDirectory=$pathImageArray['1'];
        $image=Image::find($idImage);
        $image->delete();
        File::delete(storage_path("app/public/$pathImage"));
        File::delete(storage_path("app/public/announcements/$imgDirectory/crop_400x300_$imgName"));
      return back()->with('mex',"L'immagine è stata eliminata");
            
    }

 
    //funzione store per caricare i dati del nuovo annuncio

    public function store() {
       //fa prima partire le validazioni
       $this->validate();

       $currentAnnouncemet=Announcement::find($this->announcement->id);
       $currentAnnouncemet->title=$this->title;
       $currentAnnouncemet->description=$this->description;
       $currentAnnouncemet->category_id=$this->category;
       $currentAnnouncemet->price=$this->price;
       $currentAnnouncemet->status_date=null;
       $currentAnnouncemet->is_accepted=null;
       $currentAnnouncemet->user_revisor_id=null;
       
       $this->currentImages=$currentAnnouncemet->images;

        //if per controllare se ci sono immagini e nel caso crea un path nella tabella e le salva tramite store nel public images
        if(count($this->images)){
            foreach ($this->images as $image) {
                
                $newFileName = "announcements/{$this->announcement->id}";
                $newImage = $this->announcement->images()->create(['path'=>$image->store($newFileName, 'public')]);
    
                RemoveFaces::withChain(
                    [
                        (new ResizeImage($newImage->path , 400 , 300 )),
                        (new GoogleVisionSafeSearch($newImage->id)),
                        (new GoogleVisionLabelImage($newImage->id))
                    ]
                )->dispatch($newImage->id);
             
                
            }
            $this->images=[];
            File::deleteDirectory(storage_path('app/livewire-tmp'));
        }
        $currentAnnouncemet->save();

        
            //messaggio flash che compare dopo il save con successo
            session()->flash('message','Annuncio modificato con successo e in attesa di validazione');
       }

    //rende le validazioni di errore in tempo reale
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function delete(){
        $image = Image::find($this->imageId);

        if ($image) {
        // Elimina l'immagine dal database
        $image->delete();}
    }

}
