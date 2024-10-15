@extends('layouts.main-auth')

@section('container')

@include('sweetalert::alert')

<!-- Start Hero -->
<div class="hero hero-login">
</div>

<div class="container">
    <div class="hero__inner">
        <div class="row">
            <div class="col-12 col-md-7">
                <div class="left-login">
                    <h2><span style="color: #cdcdcd">Si</span><span style="color: #fff">Monev<span style="color: #cdcdcd"></h2>
                    <h4>Sistem Monitoring dan Evaluasi<br>Kementrian Pertanian RI</h4>
                    <div class="kotak-info">
                        <h1>Pertanian Makro</h1>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5">
                <div class="right-login">

                    <h3 class="title-form">Sign In</h3>
                    <form action="/login" method="POST" class="form-input" novalidate>

                        <h2>Sign In</h2>
                        @csrf
                        <input type="email" placeholder="email" autofocus value="{{old('email')}}" class="input-form" name="email" required />
                        @error('email')<div class="small-text">{{ $message }}</div>@enderror

                        <input type="password" placeholder="password @error('password') is-invalid @enderror" autofocus required value="{{old('password')}}" class="input-form" name="password" />
                        @error('password')<div class="small-text">{{ $message }}</div>@enderror

                        <button type="submit" class="button-submit">Sign In</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Hero -->
@endsection