<x-layout>

    {{-- <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <h2 class="display-2 text-center">Annuncio {{ $announcement->title }}</h2>
            </div>
        </div>
    </div> --}}

    {{-- <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card col-12">
                    <div class="card-body">
                        <div id="carouselExample" class="carousel slide mb-3">
                            <!-- immagini del carosello da cercare coun un if se non ci sono immagini caricate -->
                            @if ($announcement->images && count($announcement->images) > 0)
                                <div class="carousel-inner">
                                    @foreach ($announcement->images as $image)
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img src="{{ $image->getUrl(400, 300) }}" class="d-block w-100"
                                                alt="...">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="https://picsum.photos/400/301" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/400/300" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="https://picsum.photos/400/300" class="d-block w-100" alt="...">
                                    </div>
                                </div>
                            @endif
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="col-12">
                            <h5 class="card-title mb-3">Titolo:{{ $announcement->title }}</h5>
                            <p class="class-text mb-3">Descrizione: {{ $announcement->description }}</p>
                            <p class="class-text mb-3">Prezzo : {{ $announcement->price }} €</p>
                            <a class="card-link btn btn-success shadow mb-5"
                                href="{{ route('categoryShow', ['category' => $announcement->category]) }}">Categoria :
                                {{ $announcement->category->name }}</a>
                            <p class="card-footer">Pubblicato il : {{ $announcement->created_at->format('d/m/Y') }} -
                                Autore : {{ $announcement->user->name ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="col-lg-4 col-md-6 col-12 mb-4 mb-lg-0">
        <div class="custom-block bg-white shadow-lg">
            <a href="topics-detail.html">
                <div class="d-flex">
                    <div>
                        <h5 class="mb-2">Annuncio {{$announcement->title}}</h5>

                        <p class="mb-0"></p>
                    </div>

                    <span class="badge bg-design rounded-pill ms-auto">14</span>
                </div>

                <img src="images/topics/undraw_Remote_design_team_re_urdx.png"
                    class="custom-block-image img-fluid" alt="">
            </a>
        </div>
    </div> --}}

    <!-- Product section-->
    <!-- <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="https://dummyimage.com/600x700/dee2e6/6c757d.jpg" alt="..." /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">SKU: BST-498</div>
                        <h1 class="display-5 fw-bolder">Shop item template</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">$45.00</span>
                            <span>$40.00</span>
                        </div>
                        <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
    <!-- Related items section-->


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
