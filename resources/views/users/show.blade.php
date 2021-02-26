@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User Management</a></li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-header" style="background-color: #eeeeee">
                Details of User #{{ $user->id }}
            </div>
            <div class="card-body">
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" disabled class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="{{ $user->email }}" disabled class="form-control">
                </div>
                <div class="form-group">
                    <label for="created_at">Created At</label>
                    <input type="text" name="created_at" value="{{ $user->created_at }}" disabled class="form-control">
                    <p>{{ $user->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-dark float-right">Back</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger float-right mx-1">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection