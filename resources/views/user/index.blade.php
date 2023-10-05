<x-layout>


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
