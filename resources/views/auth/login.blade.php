@extends('layouts.app')
@section('content')
    <div class="account-content">
        <div class="login-wrapper login-new">
            <div class="row w-100">
                <div class="col-lg-5 mx-auto">
                    <div class="login-content user-login">
                        <div class="login-logo">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="img" />
                            <a href="javascript:void(0)" class="login-logo logo-white">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Img" />
                            </a>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="login-userheading">
                                        <h3>Sign In</h3>
                                        <h4>Access the Attendance Dashboard using your email and passcode.</h4>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                placeholder="Email" required autofocus class="form-control border-end-0" />
                                            <span class="input-group-text border-start-0">
                                                <i class="ti ti-mail"></i>
                                            </span>
                                        </div>
                                        @error('email')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Password
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="pass-group">
                                            <input type="password" id="password" name="password" placeholder="Password"
                                                class="pass-input form-control" />
                                            <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                        </div>

                                        @error('password')
                                            <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-login">
                                        <button type="submit" class="btn btn-login w-100">Sign In</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
