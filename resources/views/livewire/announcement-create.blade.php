{{-- <div>
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                @if (session()->has('message'))
                    <div class="flex flex-row justify-center my2 alert alert-success">
                    {{session('message')}}
                    </div>
                @endif
                <form wire:submit.prevent="store">
                    @csrf
                    <div class="card col-12">
                        <div class="card-body">

                        <div class="card-title text-center display-5 my-3">Crea un nuovo Annuncio</div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Titolo</label>
                                <input value="{{$title}}" wire:model="title" type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="scrivi il titolo dell'annuncio....">
                                @error('title')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrizione</label>
                                <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" id="description" rows="10" placeholder="scrivi la descrizione dell'annuncio....">{{$description}}</textarea>
                                @error('description')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Prezzo</label>
                                <input value="{{$price}}" wire:model="price" type="number" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="scrivi il prezzo....">
                                @error('price')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="category">Categoria</label>
                                <select wire:model.defer="category" id="category" class="form-select @error('price') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Scegli la categoria</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                                </select>
                                @error('category')
                                    {{$message}}
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input wire:model="temporary_images" type="file" name="images" multiple class="form-control shadow @error('temporary_images.*') is-invalid @enderror" placeholder="Img"/>
                                @error('temporary_images.*')
                                    {{$message}}
                                @enderror
                            </div>
                            @if (!empty($images))

                            <div class="row">
                                <div class="col-12">
                                    <p>photo preview</p>
                                    <div class="row border border-4 border-info rounded shadow py-4">
                                        @foreach ($images as $key => $image)
                                            <div class="col my-3">
                                                 <div class="mx-auto shadow rounded img-preview" style="background-image:url({{$image->temporaryUrl()}});">
                                                    <button type="button" class="btn btn-danger shadow d-block text-center mt-2 mx-auto" wire:click="removeImage({{$key}})">Cancella</button>
                                                </div>
                                        @endforeach
                                         </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-auto">
                                <button wire:click='store' type="button" class="btn btn-primary mb-3">Aggiungi</button>
                            </div>
                            <p class="{{$color}}">{{$text}}</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <div class="row ">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image">
            {{-- <img src="{{ asset('images/create_announcement.png') }}" alt=""> --}}
        </div>


        <!-- The content half -->
        <div class="col-md-6 bg-white " style="overflow-y: auto; max-height: 100vh;">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                        @if (session()->has('message'))
                    <div class="flex flex-row justify-center my2 alert alert-success">
                    {{session('message')}}
                    </div>
                @endif
                            <h3 class="display-4 text-dark">Crea</h3>
                            <p class="text-muted mb-4">Ricordati di compilare tutti i campi</p>
                            <form wire:submit.prevent="store">
                                @csrf
                                <div class="form-group mb-3">
                                    <input value="{{ $title }}" wire:model.blur="title" id="title" type="text" placeholder="Titolo"

                                        class="form-control rounded-2 px-4 shadow @error('title') is-invalid @enderror">
                                    @error('title')
                                    <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <textarea wire:model.blur="description" class="form-control shadow rounded-2 px-4 @error('description') is-invalid @enderror" id="description"
                                        type="password" placeholder="scrivi la descrizione dell'annuncio...." required="">
                                        {{ $description }}
                                    </textarea>
                                    @error('description')
                                       <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <input value="{{ $price }}" wire:model.blur="price" id="price" type="number"
                                        placeholder="Prezzo" required="" autofocus=""
                                        class="form-control rounded-2 px-4 @error('price') is-invalid @enderror shadow">
                                    @error('price')
                                    <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <select wire:model.defer.blur="category" id="category"
                                        class="form-control form-select @error('category') is-invalid @enderror shadow"
                                        aria-label="Default select example">
                                        <option selected>Scegli la categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="upload__box mt-2">
                                    <div class="upload__btn-box">
                                        <label class="upload__btn">
                                            <p class="mb-2">Inserisci una immagine</p>
                                            <input wire:model="temporary_images" type="file" name="images" multiple
                                                class="upload_inputfile form-control shadow @error('temporary_images.*') is-invalid @enderror"
                                                placeholder="Img">
                                            @error('temporary_images.*')
                                                {{ $message }}
                                            @enderror
                                        </label>
                                    </div>
                                    <div class="upload__img-wrap">
                                        @if (!empty($images))

                                            <div class="row">
                                                <div class="col 12">
                                                    <p class="mt-3 pb-3">photo preview</p>
                                                    <div class="row border border-4 border-dark rounded shadow py-4">
                                                        @foreach ($images as $key => $image)
                                                            <div class="col my-3">
                                                                <div class="mx-auto shadow rounded img-preview"
                                                                    style="background-image:url({{ $image->temporaryUrl() }});">
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
                                    </div>
                                </div>                     
                            </form>
                            <!-- <button type="button" wire:click='store'
                                    class="btn btn-dark btn-block text-withe mb-2 rounded-2 shadow mt-3">Aggiungi
                                </button> -->
                                <input type="button" wire:click='store' class="btn btn-dark btn-block text-withe mb-2 rounded-2 shadow mt-3" value="Aggiungi">
                                <p class="{{ $color }}">{{ $text }}</p>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>
