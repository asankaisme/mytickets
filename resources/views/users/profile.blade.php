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
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('template/dist/img/user2-160x160.jpg') }}" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $user->name }}</h3>

            <p class="text-muted text-center">Software Engineer</p>

            <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Tickets Raised</b> <a class="float-right">22</a>
            </li>
            </ul>

        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">About Me</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
        </div>
        <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-9">
        <div class="card card-info">
            <div class="card-header">
                Change Profile Info
            </div>
            <div class="card-body">
                <div>
                    <p>Change Password Credentials</p>
                    <form action="#" method="post">
                        @csrf
                        <div class="form-group col-md-5">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="password_confirmed">Confirm Password</label>
                            <input type="password" name="password_confirmed" class="form-control">
                        </div>
                        <div class="form-group col-md-5">
                            <input type="reset" value="Clear" class="btn btn-default">
                            <input type="submit" value="Update" class="btn btn-info">
                        </div>
                    </form>
                </div>
                <hr>
                <p>Upload New User Photo</p>
                <div class="col-md-5">
                    <form action="#" method="post">
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <input type="submit" value="Update" class="btn btn-info input-group-text">
                            </div>
                          </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
