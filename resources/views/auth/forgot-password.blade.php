<x-layout>

    <div class="my-auth-container my-forgot vh-100 d-flex justify-content-center align-items-center">
        <div class="my-auth-box container d-flex justify-content-center align-items-center m-auto">
            <div class="row">
                <div class="col-12">
                    <!-- password recovery -->
                    <form action="/forgot-password" method="post" class="container-fluid" id="forgotForm">
                        @csrf
                        <div class="row forgot-box ">
                            <input class=" forgotten col-12 text-center my-2 py-2 border border-5" type="email"
                                name="email" id="email" placeholder="mario.rossi@live.it">
                            <input class=" forgotten col-12 text-center my-2 py-2 border border-5" type="submit"
                                value="Richiedi nuova password">
                            <div class="row">
                                <!-- end form -->
                            </div>
                        </div>
                    </form>

                    <!-- status recovery password -->
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif

                    <!-- error message if there is an error -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <div class="overlay">

            </div>
        </div>

    </div>

</x-layout>
