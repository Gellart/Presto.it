<x-layout>
<br><br><br><br><br><br><br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Autentificazione') }}</div>

                <div class="card-body">
                   

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="code" class="col-md-4 col-form-label text-center"> {{ __('Perfavore inserisci il codice TOTP') }}</label>

                            <div class="col-md-6">
                                <input id="code" type="code" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="current-code">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary col-6">
                                    {{ __('Accedi') }}
                                </button>
                                
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="card">
                <div class="card-header">{{ __('Two factor Challenge') }}</div>

                <div class="card-body">
                    {{ __('Please enter your authentication recovery_code to login.') }}

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="recovery_code" class="col-md-4 col-form-label text-md-end">{{ __('recovery_code') }}</label>

                            <div class="col-md-6">
                                <input id="recovery_code" type="recovery_code" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" required autocomplete="current-recovery_code">

                                @error('recovery_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                                
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>


</x-layout>