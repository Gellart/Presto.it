<x-layout>
        <br><br><br><br><br><br><br><br><br><br><br>
    <!-- form per reset password -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-12 text-center"><h2 class="display-2 mb-5">Crea una nuova password</h2></div>
                <div class="card">
                    <div class="card-body">
                        <form action="/reset-password" method="post">
                        @csrf
                        <!-- input inserimento campo email -->
                        <label for="email"> Inserisci la tua Email</label>
                        <input class="form-control mb-3" type="email" name="email" id="email" placeholder="mario.rossi@gmail.com">
                        <!-- input inserimento campo password -->
                        <label for="password"> Inserisci la nuova Password</label>
                        <input class="form-control mb-3" type="password" name="password" id="password" placeholder="Password">
                        <!-- input inserimento campo conferma password -->
                        <label for="password_confirmation"> Conferma la nuova password</label>
                        <input class="form-control mb-3" type="password" name="password_confirmation" id="password_confirmation" placeholder="Conferma Passsword">
                        <!-- valore token nascosto -->
                        <input class="form-control mb-3" type="hidden" name="token" value="{{request()->route('token')}}">
                        <!-- submit per reset password -->
                        <input class="btn btn-dark mb-3" type="submit" value="Invio Conferma Password">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-layout>
