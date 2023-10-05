<x-layout>

    {{-- announcements section --}}
    <section class="pt-5 pb-5 show_section_color">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="pt-4 ">
                    <p></p>
                </div>
                <div id="carouselExampleAutoplaying" class="col carousel slide card-img-top mb-5 mb-md-0"
                    data-bs-ride="carousel">
                    @if ($announcement->images && count($announcement->images) > 0)
                        <div class="carousel-inner pb-5">
                            @foreach ($announcement->images as $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ $image->getUrl(400, 300) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="carousel-inner">
                            <div class="carousel-item active shadow">
                                <img src="https://picsum.photos/400/301" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/400/301" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://picsum.photos/400/301" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    @endif
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="col-md-6">

                    <h1 class="display-5 fw-bolder text-dark">{{ $announcement->title }}</h1>
                    <div class="fs-5 mt-3 mb-3">
                        <span class="text-dark">{{ $announcement->price }} €</span>
                    </div>
                    <p class="lead mb-3"><span class="text-dark">Descrizione : </span>{{ $announcement->description }}
                    </p>
                    <p class="lead mb-3"> <span class="text-dark">Autore : </span>{{ $announcement->user->name ?? '' }}
                    </p>
                    <div class="d-flex">

                        <button class="btn btn-outline-dark" type="button" href=""><a class="ann_link"
                                href="{{ route('announcements.index') }}">{{ $announcement->category->name }}</a>
                        </button>
                    </div>
                </div>
                <div class="pb-5">
                    <p></p>
                </div>
            </div>
        </div>
    </section>



</x-layout>
