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
    <div class="col-md-4">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
            <div class="widget-user-image">
                @if (Auth::user()->usr_image == null)
                    <img class="img-circle elevation-2" src="{{ asset('template/docs/assets/img/noImage.jpg') }}" alt="User Avatar">
                @else
                    <img class="img-circle elevation-2" src="{{ asset('/storage/usr_images/'.Auth::user()->usr_image) }}" alt="User Avatar">
                @endif
            
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
            <h5 class="widget-user-desc">{{ Auth::user()->roles->pluck('name')->implode('') }} user</h5>
        </div>
        <div class="card-footer p-0">
            <ul class="nav flex-column">
            <li class="nav-item">
                @if (count(Auth::user()->ticket) != 0)
                    <a href="#" class="nav-link">
                    Tickets raised <span class="float-right badge bg-primary">{{ count(Auth::user()->ticket) }}</span>
                    </a>
                @endif
            </li>
            <li class="nav-item">
                @if (count(Auth::user()->ticketsAssignedByMe) != 0)
                    <a href="#" class="nav-link">
                    Tickets Assigned <span class="float-right badge bg-primary">{{ count(Auth::user()->ticketsAssignedByMe) }}</span>
                    </a>
                @endif
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                Completed Projects <span class="float-right badge bg-success">12</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                Followers <span class="float-right badge bg-danger">842</span>
                </a>
            </li>
            </ul>
        </div>
        </div>
        <!-- /.widget-user -->
    </div>

    <div class="col-md-7">
        <div class="card card-default">
            <div class="card-header" style="background-color: #eeeeee">
                Change Profile Info
            </div>
            <div class="card-body">
                <div>
                    <div class="form-group">
                        <p>Change my password</p>
                        <a href="{{ route('password.request') }}" class="btn btn-sm btn-outline-info">Change</a>
                    </div>
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

@section('row')
    <div class="row">
        
    </div>
@endsection
