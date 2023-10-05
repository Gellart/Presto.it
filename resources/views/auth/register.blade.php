<x-layout>

    <header class="site-header d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <h1 class=" text-center pt-5 text-dark">Registrati</h1>
                </div>
            </div>
        </div>
    </header>

    {{-- form register --}}
    <div class="container-fluid mb-5 bg-grey">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        @endif
        <section>
            <div class="container py-5 h-100">
                <div class="row d-flex align-items-center justify-content-center h-100">
                    <div class="col-md-8 col-lg-7 col-xl-6 ">
                        <img src="{{ URL::to('/') }}/images/register.png"
                            class="img-fluid" alt="Phone image">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                        <form action="/register" method="post" class="custom-form contact-form" role="form">
                            @csrf
                            <!-- Name and surname input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="name"><h4>Nome</h4></label>
                                <input type="text" name="name" id="name" class="form-control rounded-2 border-0 px-4 shadow"
                                    placeholder="Mario Rossi" />
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email"><h4>Email</h4></label>
                                <input type="email" name="email" id="email" class="form-control rounded-2 border-0 px-4 shadow"
                                    placeholder="mario.rossi@email.com" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password"><h4>Password</h4></label>
                                <input type="password" name="password" id="password" class="form-control rounded-2 border-0 px-4 shadow"
                                    placeholder="Inserici una password" />
                            </div>

                            <!-- Confirm password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password_confirmation"><h4>Conferma password</h4></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control rounded-2 border-0 px-4 shadow" placeholder="Conferma password" />
                            </div>

                            <div class="d-flex justify-content-around align-items-center mb-4">

                                <a href="{{ route('auth.forgot-password') }}">Password dimenticata ?</a>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-dark btn-lg btn-block col-12">Registrati</button>


                            <p class="text-center fw-bold mx-3 my-4 text-muted">OR</p>


                            <di class="row justify-content-center">
                                <div class="col-12 col-md-6 d-flex align-items-stretch justify-content-center">
                                    <a class="btn btn-primary btn-lg btn-block btn-login  "
                                        style="background-color: #DB4437" href="{{ route('google.redirect') }}"
                                        role="button">
                                        <i class="fa-brands fa-google me-2"></i>{{__('ui.continue_with_google')}}
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 d-flex align-items-stretch justify-content-center">
                                    <a class="btn btn-primary btn-lg btn-block btn-login " style="background-color:#2b3137"
                                        href="{{ route('github.redirect') }}" role="button">
                                        <i class="fa-brands fa-github me-2"></i>{{__('ui.continue_with_github')}}
                                    </a>
                                </div>
                            </di>

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                            @endif



                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>








</x-layout>
