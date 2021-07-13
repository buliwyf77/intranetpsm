@extends('layouts.auth')

@section('title', 'Login')

@section('content')
   
    <img ali alt="psm" class="w-15" src="{{asset("template/dist/images/logo-psm.png")}}">    
     
    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Intranet PSM Servicios Informáticos y Logísticos LTDA</div>
    <div class="intro-x mt-8">
        
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" id="email" name="email" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email">
            @error('email')
                <span class="invalid-feedback text-danger" role="alert">
                    <strong class="red">{{ $message }}</strong>
                </span>
            @enderror

            <input type="password"  name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong class="red">{{ $message }}</strong>
                </span>
            @enderror

    </div>
    <div class="intro-x flex text-gray-700 text-xs sm:text-sm mt-4">
        <div class="flex items-center mr-auto">
            <input type="checkbox" class="input border mr-2" id="remember-me">
            <label class="cursor-pointer select-none" for="remember-me">Recordar</label>
        </div>
        @if (Route::has('password.request'))
            <a class="" href="{{ route('password.request') }}">
                ¿Olvidaste tu Clave?
            </a>
        @endif
    </div>
    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
        
        <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">
            Ingresar
        </button>
        {{--<a class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0" href="{{ route('register') }}">
            Registrarse
        </a>--}}
    </div>
</form>


@endsection