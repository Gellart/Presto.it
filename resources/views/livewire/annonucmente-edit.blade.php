<div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <!-- Se l'utente che prova a modificare l'annuncio è lo stesso che lo ha creato può procedere -->
    @if ($announcement->user_id == Auth::id())
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <!-- Anteprima con risultato finale -->
                <div class="col-6">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="carouselExample" class="carousel slide mb-3">
                                        <!-- immagini del carosello da cercare con un if se non ci sono immagini caricate -->
                                        @if ($currentImages)
                                            <div class="carousel-inner">
                                                @foreach ($currentImages as $image)
                                                    <div
                                                        class="carousel-item @if ($loop->first) active @endif">

                                                        <img src="{{ $image->getUrl(400, 300) }}" class="d-block w-100"
                                                            alt="{{ $image->announcement->title }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <img src="https://picsum.photos/400/301" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="https://picsum.photos/400/300" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="https://picsum.photos/400/300" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                            </div>
                                        @endif
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExample" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExample" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="card-title mb-3">Titolo: {{ $announcement->title }}</h5>
                                        <p class="class-text mb-3">Descrizione: {{ $announcement->description }}</p>
                                        <p class="class-text mb-3">Prezzo : {{ $announcement->price }} €</p>
                                        <a class="card-link btn btn-success shadow mb-5"
                                            href="{{ route('categoryShow', ['category' => $announcement->category]) }}">Categoria
                                            :
                                            {{ $announcement->category->name }}</a>
                                        <p class="card-footer">Pubblicato il :
                                            {{ $announcement->created_at->format('d/m/Y') }} -
                                            Autore : {{ $announcement->user->name ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- form per le modifiche -->
                <div class="col-12 col-md-6">
                    <div class="container my-5">
                        <div class="row">
                            <div class="col-12">
                                @if (session()->has('message'))
                                    <div class="flex flex-row justify-center my-2 alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <form wire:submit.prevent="store">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title text-center display-5 my-3">Modifica Annuncio</div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">Titolo</label>
                                                <input value="{{ $announcement->title }}" wire:model="title"
                                                    type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    id="title">
                                                @error('title')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Descrizione</label>
                                                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description"
                                                    rows="10">{{ $announcement->description }}</textarea>
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Prezzo</label>
                                                <input value="{{ $announcement->price }}" wire:model="price"
                                                    type="number"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    id="price">
                                                @error('price')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label for="category">Categoria</label>
                                                <select wire:model.defer="category" id="category"
                                                    class="form-select @error('price') is-invalid @enderror"
                                                    aria-label="Default select example">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id == $announcement->category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <input wire:model="temporary_images" type="file" name="images"
                                                    multiple
                                                    class="form-control shadow @error('temporary_images.*') is-invalid @enderror"
                                                    placeholder="Img" />
                                                @error('temporary_images.*')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                            @if (!empty($images))
                                                <div class="row">
                                                    <div class="col-12">
                                                        <p>Photo Preview</p>
                                                        <div
                                                            class="row border border-4 border-info rounded shadow py-4">
                                                            <!-- Immagini anteprima modifica -->
                                                            @foreach ($images as $key => $image)
                                                                <div class="col my-3">
                                                                    <div class="mx-auto shadow rounded img-preview"
                                                                        style="background-image:url({{ $image->temporaryUrl() }});">
                                                                        <!-- bottone per eliminare l'immagine -->
                                                                        <button type="button"
                                                                            class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                                                                            wire:click="removeImage({{ $key }})">Cancella</button>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-auto">
                                                <button wire:click='store' type="button"
                                                    class="btn btn-primary mb-3">Modifica</button>
                                            </div>
                                            <p class="{{ $color }}">{{ $text }}</p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-12 text-center my-5">
             @if(session()->has('mex'))
                                    <div class="flex flex-row justify-center my-2 alert alert-success">
                                        {{ session('mex') }}
                                    </div>
                                @endif
                <div class="display-2 mt-2 mb-4">Elimina le immagini</div>
                @foreach ($announcement->images as $key => $aImage)
                    <div class=" shadow rounded img-preview"
                        style="background-image:url({{ $aImage->getUrl(400, 300) }});">
                        <!-- bottone per eliminare l'immagine -->
                        <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto"
                            wire:click="removeAImage({{ $aImage }})">Cancella</button>
                    </div>
                @endforeach
            </div>
        </div>
</div>
<!-- messaggio in cui un utente cerchi di modificare un annuncio che non ha pubblicato -->
@else
<div class="container my-5 py-5">
    <p class="fs-1 text-center">
        Non sei autorizzato a modificare questo Annuncio
    </p>
</div>
@endif
</div>
