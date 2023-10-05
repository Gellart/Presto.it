{{-- <div class="card-body mt-2 mb-5">
    <form wire:submit.prevent="becomeRevisor">
        <div class="mb-3">
            <p class="card-text text-center h1 pb-3">Perchè dovremmo assumerti?</p>
            <label for="formMessage" class="form-label">Scrivi la tua richiesta</label>
            <textarea class="form-control @error('formMessage') is-invalid @enderror" wire:model="formMessage" name="formMessage" id="formMessage" rows="5" placeholder="Inserisci il tuo messaggio qui"></textarea>
            @error('formMessage')
                {{$message}}
            @enderror
        </div>

        <div class="mb-3">
            <button class="btn btn-dark" type="submit">Invia Richiesta</button>
        </div>
        <p class="text-color-success">{{$feedback}}</p>
    </form>
</div> --}}

<section>
    <div class="container pt-5 ">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-8 col-lg-7 col-xl-6">
                <!-- immagine laterale al login -->
                <img src="{{ asset('images/revisor_request.png') }}" class="img-fluid" alt="Phone image">
            </div>
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1  ">

                <form wire:submit.prevent="becomeRevisor">
                    <h4 class="card-text text-center pb-3">Perchè dovremmo assumerti?</h4>
                    <div class="form-group mb-3">
                        <textarea wire:model="formMessage" class="form-control @error('formMessage') is-invalid @enderror" id="formMessage"
                            type="password" placeholder="scrivi la tua richiesta" required=""
                            class="form-control border-0 form-control rounded-2 shadow px-4 text-primary shadow"></textarea>
                        @error('formMessage')
                            {{ $message }}
                        @enderror
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class=" col-12 btn btn-dark btn-lg btn-block">Invia richiesta</button>

                    <p class="text-center fw-bold mx-3 my-4 text-muted">{{ $feedback }}</p>

                </form>
            </div>
        </div>
    </div>
</section>
