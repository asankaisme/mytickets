@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Ticket Management</a></li>
          <li class="breadcrumb-item active">#{{ $ticket->id }}</li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-header" style="background-color: #eeeeee">
                Details of Ticket #{{ $ticket->id }}
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.update', $ticket->id) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{ $ticket->title }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="body">Content</label>
                        <textarea name="body" class="form-control" cols="30" rows="10" >{{ $ticket->body }}</textarea>
                    </div>
    
                    <div class="form-group">
                        {{-- <label for="exampleInputFile">File input</label> --}}
                        <input type="file" name="img_name">
                        <p class="help-block">Attach a screenshot</p>
                    </div>
    
                    <div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-dark float-right mx-1">Back</a>
                        <input type="submit" value="Update" class="btn btn-primary float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection