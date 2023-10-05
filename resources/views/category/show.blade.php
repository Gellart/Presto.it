<x-layout>

    <header class="masthead_show_announcements">
        <div class="container">

            <h2 class="display-1 text-center text-dark">
                {{ __('ui.category_ann') }} <!-- cambia nome categoria in base alla lingua impostata -->
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
                    {{ $category->en }} {{ __('ui.category') }}
                @endif

            </h2>
        </div>
    </header>

    <div class="container pt-5">
        <div class="row">

            <div class="bg0 m-t-23 p-b-140">
                <div class="container text-center">
                    <div class="row  align-items-start">
                        @forelse ($catAnnouncements as $announcement)
                            @if ($announcement->is_accepted)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">

                                    <!-- Block2 -->
                                    <div class="block2 mb-2 align-items-start">
                                        <div class="block2-pic hov-img0">
                                            <img src="{{ !$announcement->images()->get()->isEmpty()? $announcement->images()->first()->getUrl(400, 300): 'https://picsum.photos/400/300' }}"
                                                alt="IMG-PRODUCT">

                                            <a href="{{ route('announcements.show', $announcement->id) }}"
                                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                                {{ __('ui.view') }}
                                            </a>
                                        </div>

                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l ">
                                                <a href="{{ route('categoryShow', ['category' => $announcement->category]) }}"
                                                    class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                    {{ $announcement->category->name }}
                                                </a>

                                                <span class="stext-105 cl3">
                                                    Titolo: {{ $announcement->title }}
                                                </span>
                                                <span class="stext-105 cl3">
                                                    Prezzo {{ $announcement->price }}
                                                </span>
                                                <span>
                                                @if(auth()->check())
                                                    @livewire('favorite', ['announcement' => $announcement])
                                                @endif
                                            </span>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        @empty
                            <div class="col-12">
                                <p class="h1 text-center">Non sono presenti annunci per questa categoria</p>
                                <p class="h2 text-center">pubblicane uno : <a class="btn btn-dark shadow"
                                        href="{{ route('announcements.create') }}">Nuovo Annuncio</a></p>
                            </div>
                        @endforelse
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    {{ $catAnnouncements->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>
