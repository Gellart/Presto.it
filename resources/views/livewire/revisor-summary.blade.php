<div>
    <div class="container">
        <div class="row fw-bolder border">
            <div class="col-3 border text-truncate">
                <p>Titolo</p>
            </div>
            <div class="col-2 border text-truncate">
                <p>Autore</p>
            </div>
            <div class="col-1 border text-truncate">
                <p>Immagini</p>
            </div>
            <div class="col-2 border text-truncate">
                <p>Revisionato da</p>
            </div>
            <div class="col-1 border text-truncate">
                <p>Stato</p>
            </div>
            <div class="col-1 border text-truncate">
                <p>Accetta</p>
            </div>
            <div class="col-1 border text-truncate">
                <p>Rifiuta</p>
            </div>
            <div class="col-1 border text-truncate">
                <p>Annulla</p>
            </div>
        </div>
        <div class="row border text-truncate">
            @foreach($announcements as $announcement)
                <div class="col-3 text-truncate border">
                    <p>{{$announcement->title}}</p>
                </div>
                <div class="col-2 text-truncate border">
                    <p>{{$announcement->user->name}}</p>
                </div>
                <div class="col-1 text-truncate border">
                    <p>{{count($announcement->images)}}</p>
                </div>
                <div class="col-2 border text-truncate">
                    @foreach($users as $user)
                        @if($announcement->user_revisor_id==$user->id)
                            <p>{{$user->name}}</p>
                        @endif
                    @endforeach
                </div>
                <div class="border text-truncate col-1">
                    @if($announcement->is_accepted==1)
                        <p>Accettato</p>
                    @elseif($announcement->is_accepted==0 && $announcement->user_revisor_id !=0 )
                        <p>Rifiutato</p>
                    @else
                        <p></p>
                    @endif
                </div>
                <div class="border text-truncate col-1">
                    @if(auth()->user()->id != $announcement->user->id && $announcement->is_accepted !=1 )
                        <input type="checkbox" wire:model="selectedAccetta" value="{{ $announcement->id }}">
                    @endif
                </div>
                <div class="border text-truncate col-1">
                    @if(auth()->user()->id != $announcement->user->id)
                        @if($announcement->is_accepted == 1 || $announcement->user_revisor_id == null )
                            <input type="checkbox" wire:model="selectedRifiuta" value="{{ $announcement->id }}">
                        @endif
                    @endif
                </div>
                <div class="border text-truncate col-1">
                    @if(auth()->user()->id != $announcement->user->id && $announcement->user_revisor_id != null)
                        <input type="checkbox" wire:model="selectedAnnulla" value="{{ $announcement->id }}">
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            <button wire:click="updateStatus">Esegui azione</button>
        </div>
    </div>
</div>
