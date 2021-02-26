@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('tickets.index') }}">Ticket Management</a></li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-header" style="background-color: #eeeeee">
                Create New Ticket
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.store') }}" method="POST">
                    @csrf
                      <div class="modal-body">
                          <div class="form-group">
                              <input type="text" class="form-control" name="title" placeholder="Ticket Title" value="{{ old('title') }}">
                              @error('title')
                                  <p style="color: red">{{ $message }}</p>
                              @enderror
                          </div>
                          <div class="form-group">
                              <textarea class="form-control pt-2" name="body" rows="6" value="{{ old('body') }}" placeholder="Please describe the issue you got.."></textarea>
                                @error('body')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
                          </div>
                          <div class="form-group">
                              {{-- <label for="exampleInputFile">File input</label> --}}
                              <input type="file" name="img_name">
                              <p class="help-block">Attach a screenshot</p>
                          </div>
                      </div>
                      <div class="modal-footer">
                           <a href="{{ route('tickets.index') }}" class="btn btn-outline-dark">Back</a>
                          <button type="reset" class="btn btn-default" data-dismiss="modal">Clear</button>
                          <button type="submit" class="btn btn-primary">Add New</button>
                      </div>
                  </form>
            </div>
        </div>
    </div>
    
@endsection