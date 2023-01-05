@extends('frontendLayout')
@section('main_content')

    <section id="why-us" class="why-us">
        <div class="container">
    
        <div class="row d-flex justify-content-center">
            <div class="col-xl-4 col-lg-5" data-aos="fade-up">
            <div class="content">
                <h3 class="text-center">Administrator Login</h3>

                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" />
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="inputEmail" class="text-dark">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" value="{{ old('password') }}" placeholder="Password" />
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <label for="inputPassword" class="text-dark">Password</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                        <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <input class="more-btn" type="submit" value="Login">
                    </div>
                </form>
            </div>
            </div>
    
        </div>
    
        </div>
    </section>    

@endsection