<x-layout>
    <div class="py-5"></div>
    @if(session('successMessage'))
    <div class="container">
        <div>
            <p>{{ session('successMessage') }}</p>
        </div>
    </div>
    @endif

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h1 class="display-2">
                    {{ $announcement_to_check ? 'Ecco l\'annuncio da revisionare' : 'Non ci sono annunci da revisionare' }}
                </h1>
            </div>
        </div>
    </div>

    @if($announcement_to_check)
    <div class="container">
        <div class="row justify-content-center mx-auto">
            <div class="card col-6 justify-content-center">
                <div id="carouselExample" class="carousel slide mb-4">
                    <!-- immagini del carosello da cercare coun un if se non ci sono immagini caricate -->
                    @if($announcement_to_check->images && count($announcement_to_check->images)>0)
                    <div class="carousel-inner">
                        @foreach ($announcement_to_check->images as $image)
                        <div class="carousel-item @if($loop->first)active @endif">
                            <img src="{{$image->getUrl(400,300)}}" class="d-block w-100" alt="...">
                        </div>
                        @endforeach
                    </div> 
                    @else  
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://picsum.photos/400/301" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/400/300" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="https://picsum.photos/400/300" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $announcement_to_check->title }}</h5>
                    <p class="card-text text-truncate">{{ $announcement_to_check->description }}</p>
                    <p class="card-text">{{ $announcement_to_check->price }}</p>
                    <a href="{{ route('announcements.show', $announcement_to_check->id) }}" class="btn btn-dark">Visualizza</a>
                    <p class="card-footer">Pubblicato il: {{ $announcement_to_check->created_at->format('d/m/Y') }}
                        - Autore : {{$announcement_to_check->user->name ?? '' }}</p>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <form action="{{ route('revisor.accept_announcement',['announcement'=>$announcement_to_check]) }}"
                            method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success shadow">Accetta</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-6">
                        <form action="{{ route('revisor.reject_announcement',['announcement'=>$announcement_to_check]) }}"
                            method="post">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger shadow">Rifiuta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
 
 
    <div class="container py-5 justify-content-center mx-auto ">
       <div class="row  justify-content-center mx-auto">
        <!-- ANNULLA ULTIMA MODIFICA -->
       <div class="col-6 d-flex justify-content-center">
            <form action="{{ route('editRevisor') }}" method="POST">
                @csrf
                @method('PUT')
                <input class="btn btn-dark" type="submit" value="Annulla Modifica">
            </form>
        </div>

      
        <!-- MODALE DI RIEPILOGO -->
        <div class="col-6 d-flex justify-content-center"> 
           <!-- Button trigger modal  -->
           <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#Riepilogo">
                Riepilogo Revisore
            </button>

            <!-- Modal -->
             <div class="modal fade" id="Riepilogo" tabindex="-1" aria-labelledby="RiepilogoLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="RiepilogoLabel">Riepilogo Revisore</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            @livewire('revisor-summary')
                            
                        </div>
                       
                    </div>
                </div>
            </div> 
        </div>
       </div>
    </div>

    @if($announcement_to_check)
    <div class="container">
        <div class="row">
            @if($announcement_to_check->images)
            @foreach($announcement_to_check->images as $image)
            <div class="card mb-3">
                <div class="row p-2">
                    <div class="col-12 col-md-6">
                        <img src="{{$image->getUrl(400,300)}}" alt="" class="img-fluid p-3 rounded">
                    </div>
                    <div class="col-12col-md-3">
                         <h5 class="mt-3 ">Tags</h5>
                         
                        <div class="p-2">
                            @if($image->labels)
                            @foreach($image->labels as $label)
                            <p class="d-inline">{{$label}}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body">
                            <h5>Revisione immagini</h5>
                            <p>Adulti : <span class="{{$image->adult}}"></span></p>
                            <p>Satira : <span class="{{$image->spoof}}"></span></p>
                            <p>Medicina : <span class="{{$image->medical}}"></span></p>
                            <p>Violenza : <span class="{{$image->violence}}"></span></p>
                            <p>Contenuto Audace : <span class="{{$image->racy}}"></span></p>
                        </div>
                    </div>


                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @endif
</x-layout>
