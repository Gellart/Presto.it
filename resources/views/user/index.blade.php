<x-layout>
    {{-- <div class="py-5"></div>

    <h1 class="text-center">LE INFORMAZIONI DEL TUO PROFILO</h1>

    <h2 class="text-center mt-5">MODIFICA DATI UTENTE</h2>
    <!-- Form per modificare dati utente -->
    <form class="container row justify-content-center mx-auto mt-2" method="POST" action="/user/profile-information">
        @csrf
        @method('PUT')
        <div class="mb-3 row">
            <div class="col-12 col-md-6">
                <label for="name" class="form-label ">Nome</label>
                <input type="text" name="name" class="form-control mb-3" id="name"
                    value="{{ auth()->user()->name }}">
            </div>
            <div class="col-12 col-md-6">
                <label for="email" class="form-label ">email</label>
                <input type="email" name="email" class="form-control mb-3" id="email"
                    value="{{ auth()->user()->email }}">
            </div>

        </div>
        <button type="submit" class="btn btn-dark col-3">Aggiorna</button>
    </form>
    <!-- Form Modifica password -->
    <h2 class="text-center mt-5">MODIFICA PASSWORD</h2>
    <form class="container row justify-content-center mx-auto mt-2" method="POST" action="/user/password">
        @csrf
        @method('PUT')
        <div class="mb-3 row">
            <div class="col-12 col-md-6">
                <label for="current_password" class="form-label ">Password attuale</label>
                <input type="password" name="current_password" class="form-control mb-3" id="current_password">
            </div>
            <div class="col-12 col-md-6">
                <label for="password" class="form-label ">Password</label>
                <input type="password" name="password" class="form-control mb-3" id="password">
            </div>
            <div class="col-12 col-md-6">
                <label for="password_confirmation" class="form-label ">Conferma password</label>
                <input type="password" name="password_confirmation" class="form-control mb-3"
                    id="password_confirmation">
            </div>



        </div>
        <button type="submit" class="btn btn-dark col-3">Aggiorna password</button>
    </form> --}}

    <div class="container-fluid profile_bg_color">
        {{-- empty div for make some space --}}
        <div class="container mt-3 pt-5"></div>

        {{-- profile user --}}
        <div class="container mt-5 pb-5 ">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"
                                        class="rounded-circle p-1 bg-primary" width="110">
                                    <div class="mt-3">
                                        <h4>{{ auth()->user()->name }}</h4>
                                        <button class="btn btn-dark"><a class="a_profile "
                                                href="{{ route('user.profile') }}">I miei annunci</a></button>
                                        <button class="btn btn-dark"><a class="a_profile "
                                                href="{{ route('user.wish') }}">Annunci preferiti</a></button>
                                    </div>
                                </div>
                                <hr class="my-4">
                                {{-- <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-globe me-2 icon-inline">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="2" y1="12" x2="22" y2="12">
                                                </line>
                                                <path
                                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                                </path>
                                            </svg>Website</h6>
                                        <span class="text-secondary">https://bootdey.com</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-github me-2 icon-inline">
                                                <path
                                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                </path>
                                            </svg>Github</h6>
                                        <span class="text-secondary">bootdey</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-twitter me-2 icon-inline text-info">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                </path>
                                            </svg>Twitter</h6>
                                        <span class="text-secondary">@bootdey</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-instagram me-2 icon-inline text-danger">
                                                <rect x="2" y="2" width="20" height="20"
                                                    rx="5" ry="5"></rect>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5">
                                                </line>
                                            </svg>Instagram</h6>
                                        <span class="text-secondary">bootdey</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="feather feather-facebook me-2 icon-inline text-primary">
                                                <path
                                                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                </path>
                                            </svg>Facebook</h6>
                                        <span class="text-secondary">bootdey</span>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        {{-- user data --}}
                        <h1>Modifica dati utente</h1>
                        <div class="card">
                            <div class="card-body">
                                <form class="" method="POST" action="/user/profile-information">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nome</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="name" class="form-control shadow" id="name"
                                                value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" name="email" id="email" class="form-control shadow"
                                                value="{{ auth()->user()->email }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-dark px-4 shadow" value="Aggiorna">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <h1>Modifica password</h1>
                                <div class="card">
                                    <div class="card-body">
                                        <form class="container row justify-content-center mx-auto mt-2" method="POST"
                                            action="/user/password">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Password attuale</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" name="current_password"
                                                        class="form-control shadow" id="current_password">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Nuova password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" name="password" id="password"
                                                        class="form-control shadow">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Conferma password</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="password" name="password_confirmation"
                                                        id="password_confirmation" class="form-control shadow">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"></div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="submit" class="btn btn-dark px-4 shadow" value="Aggiorna">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Abilitazione autentificazione a 2 fattori -->
     <h2 class="text-center mt-5">ABILITAZIONE AUTENTIFICAZIONE A DUE FATTORI</h2>
    <div class="container mt-5">
        <div class="row justify-content-center text-center">
            @if (auth()->check())
                @if (session('status') == 'two-factor-authentication-disabled')
                    <p class="text-color-success">il sistema di autentificazione a due fattori è stato disabilitato</p>
                @endif
                @if (session('status') == 'two-factor-authentication-enabled')
                    <p class="text-color-success">il sistema di autentificazione a due fattori è stato abilitato</p>
                @endif

                <form method="POST" action="/user/two-factor-authentication">
                @csrf
                @if (auth()->user()->two_factor_secret)
                    @method('DELETE')
                    <div>
                        {{!!auth()->user()->twoFactorQrCodeSvg()!!}}
                    </div>

                    <div class="container">
                        <div class="container">
                        <p class="container pt-3 mx-5">Scansiona il QR Code grazie ad una qualsiasi app di autentificazione, ti verrà inviato un TOTP con cui potrai effettuare l'accesso </p>

                        </div>

                    </div>


                    <a class="col-12" target=”_blank” href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&pcampaignid=web_share">Google Autentificator</a>
                    <br>


                     @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes)) as $code)
                     <p>{{$code}}</p>
                    @endforeach
    <button class="btn btn-primary col-3 my-5">Disabilita</button>
                @else
                    <!-- input che fa inviare l'email in caso di click su abilita -->

                    <button class="btn btn-dark col-3 my-5">Abilita</button>

                @endif
            </form>
            @endif


        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>








</x-layout>
