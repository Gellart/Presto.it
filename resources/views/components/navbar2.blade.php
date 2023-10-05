<nav class="navbar acoli navbar-expand-lg shadow py-2 fixed-top bg-warning mb-5 ">


    <div class="container">
        <!-- Logo che riporta alla Homepage -->
        <div class="small-circle" style="display: flex; justify-content: center; align-items: center;">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.png') }}" class="small-logo ps-3" alt="logo">
            </a>
        </div>

        <!-- Menu a tendina responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav align-items-md-center mb-2 mb-lg-0">
                <!-- Link crea annuncio visibile solo a chi è autenticato -->
                @if (auth()->check())
                    <li class="nav-item overlay">
                        <a class="nav-link active text-dark" aria-current="page"
                            href="{{ route('announcements.create') }}">{{ __('ui.article_create') }}</a>
                    </li>
                @endif
                <!-- Vista tutti gli annunci -->
                <li class="nav-item overlay">
                    <a class="nav-link click-scroll text-dark text-dark"
                        href="{{ route('announcements.index') }}">{{ __('ui.announcements') }}</a>
                </li>
                <!-- Menu a tendina con tutte le categorie -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarLightDropdownMenuLink"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ __('ui.categories') }}</a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item " href="{{ route('categoryShow', compact('category')) }}">
                                    <!-- cambia nome categoria in base alla lingua impostata -->
                                    <!-- quando parte la sessione se la lingua preferita del browser è italiano -->
                                    @if (session('locale') == null && substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'it')
                                        {{ $category->name }}
                                        <!-- quando parte la sessione se la lingua preferita del browser è francese -->
                                    @elseif(session('locale') == null && substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'fr')
                                        {{ $category->fr }}
                                        <!-- quando l'utente seleziona l'italiano -->
                                    @elseif(session('locale') == 'it')
                                        {{ $category->name }}
                                        <!-- quando l'utente seleziona il francese -->
                                    @elseif(session('locale') == 'fr')
                                        {{ $category->fr }}
                                        <!-- in tutti gli altri casi -->
                                    @else
                                        {{ $category->en }}
                                    @endif

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <!-- Barra di ricerca -->
                <form action="{{ route('announcements.search') }}" method="get" class="d-flex">
                    <input name="searched" type="search" class="form-control mx-2" placeholder="{{ __('ui.search') }}"
                        aria-label="Ricerca">
                    <button class="btn btn-outline-dark" type="submit">{{ __('ui.search') }}</button>
                </form>

                <!-- Menu utente -->
                <li class="nav-item dropdown d-flex align-items-center px-md-2 mx-md-2">
                    <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-circle-user fs-1" style="color: #303640;"></i>
                    </a>
                    <ul id="dropdownMenu" class="dropdown-menu">
                        <!-- Accedi e registrati -->
                        @if (!auth()->check())
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="/login">{{ __('ui.login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="/register">{{ __('ui.register') }}</a>
                            </li>
                        @else
                            <!-- Pagina profilo utente -->
                            <li class="nav-item">
                                <a class="nav-link text-dark"
                                    href="{{ route('user.index') }}">{{ __('ui.profile') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-dark"
                                    href="{{ route('user.profile') }}">{{ __('ui.your_announcements') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark"
                                    href="{{ route('user.wish') }}">{{ __('ui.wish_list') }}</a>
                            </li>

                            <li class="nav-item mx-4 d-none">
                                <form action="/logout" method="post">
                                    @csrf
                                    <input class="d-none" type="submit" value="Logout" id="logout-nav">
                                </form>
                            </li>
                            <li class="nav-item">
                                <label class="nav-link text-dark" for="logout-nav">{{ __('ui.logout') }}</label>
                            </li>
                        @endif
                        <!-- Visibile solo se si è revisori e registrati -->
                        @if (auth()->check() && Auth::user()->is_revisor)
                            <li class="nav-item">
                                <a class="nav-link active btn btn-dark btn-sm  position-relative" aria-current="page"
                                    href="{{ route('revisor.index') }}">{{ __('ui.revisor_zone') }}
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ App\Models\Announcement::toBeRevisionedCount() }}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <!-- Menu multi lingua -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarLightDropdownMenuLink"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-globe fs-4"></i>
                        <!-- {{ __('ui.language') }} -->
                    </a>
                    <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                        <!-- Italiano -->
                        <li class="m-0 nav-link active me-2 g-light d-flex ">
                            <x-_locale id="italiano" class="flag" lang="it" nation="it" value="it" />
                            <p class="mx-2">Italiano</p>
                        </li>
                        <!-- Inglese -->
                        <li class="m-0 nav-link active me-2 g-light d-flex">
                            <x-_locale class="flag" lang="en" nation="gb" value="gb" />
                            <p class="mx-2">English</p>
                        </li>
                        <!-- Francese -->
                        <li class="m-0 nav-link active me-2 g-light d-flex">
                            <x-_locale class="flag" lang="fr" nation="fr" value="fr" />
                            <p class="mx-2">Français</p>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
