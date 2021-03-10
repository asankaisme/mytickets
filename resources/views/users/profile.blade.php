@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">User Profile</li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                @if (Auth::user()->usr_image == null)
                    <img src="{{ asset('template/docs/assets/img/noImage.jpg') }}" class="profile-user-img img-fluid img-circle" alt="User Image">
                @else
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('/storage/usr_images/'.Auth::user()->usr_image) }}" alt="User profile picture">
                @endif
            </div>
            <h3 class="profile-username text-center">{{ $user->name }}</h3>
            <p class="text-muted text-center">{{ Auth::user()->roles->pluck('name') }}</p>
            <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                @if (count(Auth::user()->ticket) != 0)
                <b>Tickets Raised</b> <a class="float-right">{{ count(Auth::user()->ticket) }}</a>
                @else
                    
                @endif
                
            </li>
            </ul>
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        {{-- <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">About Me</h3>
        </div> --}}
        <!-- /.card-header -->
        {{-- <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>

            <p class="text-muted">
            B.S. in Computer Science from the University of Tennessee at Knoxville
            </p>

            <hr>

            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

            <p class="text-muted">Malibu, California</p>

            <hr>

            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

            <p class="text-muted">
            <span class="tag tag-danger">UI Design</span>
            <span class="tag tag-success">Coding</span>
            <span class="tag tag-info">Javascript</span>
            <span class="tag tag-warning">PHP</span>
            <span class="tag tag-primary">Node.js</span>
            </p>

            <hr>

            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
        </div> --}}
        <!-- /.card-body -->
        {{-- </div> --}}
        <!-- /.card -->
    </div>

    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                Change Profile Info
            </div>
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <p>Change my password</p>
                        <a href="{{ route('password.request') }}" class="btn btn-sm btn-outline-info">Change</a>
                    </div>
                    
                    {{-- <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form> --}}
                </div>
                <hr>
                <p>Upload New User Photo</p>
                <div class="col-md-5">
                    <form action="{{ route('uploadUsrImage') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group my-2">
                            <input type="file" name="usr_image" >
                            <input type="submit" value="Upload" class="btn btn-sm btn-info">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
