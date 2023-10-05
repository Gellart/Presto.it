<x-layout>
    <div class="py-5"></div>
    <!-- Messaggi di errore -->
    <div class="container-fluid mb-5 bg-grey">
        @if (session()->has('message'))
            <div class="flex flex-row justify-center my2 alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <h1 class=" text-center  text-dark">Accedi</h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenitore del form Login -->
        <section>
            <div class="container pt-5 ">
                <div class="row d-flex align-items-center justify-content-center ">
                    <div class="col-md-8 col-lg-7 col-xl-6">
                        <!-- immagine laterale al login -->
                        <img src="{{asset ('images/login.png')}}"
                            class="img-fluid" alt="Phone image">
                    </div>
                    <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1 ">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach
                        @endif
                        <form action="/login" method="post">
                            @csrf

                            <!-- Email input -->
                            <div class="form-outline mb-4 mt-5">
                                <label class="form-label" for="form1Example13"><h3 class="text-dark">Email</h3></label>
                                <input name="email" type="email" id="form1Example13"
                                    class="form-control form-control-lg  rounded-2 border-0 px-4 shadow"
                                    placeholder="mario.rossi@gmail.com" />

                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="form1Example23"><h3 class="text-dark">Password</h3></label>
                                <input name="password" type="password" id="form1Example23"
                                    class="form-control form-control-lg  rounded-2 border-0 px-4 shadow"
                                    placeholder="Zabra123!" />

                            </div>

                            <div class="d-flex justify-content-around align-items-center mb-4">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3"
                                        checked />
                                    <label class="form-check-label" for="form1Example3"> {{ __('ui.remember_me') }}
                                    </label>
                                </div>
                                <a href="{{ route('auth.forgot-password') }}">{{ __('ui.forgot_password') }} ?</a>
                            </div>

                            <!-- Submit button -->
                            <button type="submit"
                                class=" col-12 btn btn-dark btn-lg btn-block">{{ __('ui.login') }}</button>

                            <p class="text-center fw-bold mx-3 my-4 text-muted">OR</p>

                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6 d-flex align-items-stretch justify-content-center">
                                    <a class="btn btn-primary btn-lg btn-block btn-login mb-3"
                                        style="background-color: #DB4437" href="{{ route('google.redirect') }}"
                                        role="button">
                                        <i class="fa-brands fa-google me-2"></i>{{ __('ui.continue_with_google') }}
                                    </a>
                                </div>
                                <div class="col-12 col-md-6 d-flex align-items-stretch justify-content-center">
                                    <a class="btn btn-primary btn-lg btn-block btn-login mb-3"
                                        style="background-color:#2b3137" href="{{ route('github.redirect') }}"
                                        role="button">
                                        <i class="fa-brands fa-github me-2"></i>Continua con Github
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-layout>
