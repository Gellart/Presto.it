<x-layout>

    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="display-1 text-dark">Questa è la pagina annunci,  sfoglia e trova il più adatto a te!!</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- announcements --}}
    <div class="container pt-5">
        <div class="row">

            <div class="bg0 m-t-23 p-b-140">
                <div class="container text-center">
                    <div class="row  align-items-start">
                        @foreach ($announcements as $announcement)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women ">

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
                        @endforeach
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    {{ $announcements->links() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



</x-layout>
