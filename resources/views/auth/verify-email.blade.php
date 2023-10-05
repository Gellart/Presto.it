<x-layout>

    <div class="container my-5 py-5">
        <div class="row text-center">
            <div class="card">
                <div class="card-body">
                    <!-- verify e-mail view -->
                    <p class="card-title h3 py-5">{{ auth()->user()->name }} è stata inviata una mail di conferma
                        all'indirizzo {{ auth()->user()->email }} </p>

                    <!-- form for new e-mail -->
                    <form class="pt-2 pb-5" action="/email/verification-notification" method="post">
                        @csrf
                        <!-- input for new verify e-mail -->
                        <input class="btn btn-lg btn-primary shadow" type="submit" value="invia una nuova email">
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
