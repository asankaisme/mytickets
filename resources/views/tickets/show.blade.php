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
                
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ $ticket->title }}" disabled class="form-control">
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" class="form-control" cols="30" rows="10" disabled>{{ $ticket->body }}</textarea>
                </div>

                <div>
                    @if (($ticket->img_name != null))
                       <a href="#"><p>This ticket has one attachement. <span><i class="fas fa-image"></i></span></p></a> 
                    @else
                       <p>No image attached.</p> 
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-control">
                        <p>Author : <a href="{{ route('users.show', $ticket->createdBy->id) }}"><strong>{{ $ticket->createdBy->name }}</strong></a>  created this ticket on <strong>{{ $ticket->created_at }}</strong> <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticket->created_at->diffForHumans() }}</span> </p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>

                    @can('delete ticket')
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger btn-sm float-right mx-1">
                        </form>
                    @endcan
                    
                    @can('edit ticket')
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary btn-sm float-right">Edit</a>
                    @endcan
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header" style="background-color: #eeeeee">
                Additional Infomation
            </div>
            <div class="card-body">
                <div class="time-label pb-2">
                    Ticket Status : <span class="bg-green rounded p-2">{{ $ticket->status }}</span>
                </div>
            </div>
        </div>

        <div class="card card-danger card-outline">
            <div class="card-header" style="background-color: #eeeeee">
                Assign This Ticket
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="selectSupEng">Select Support Engineer</label>
                        <select name="selectSupEng" class="form-control">
                            <option value="null">Select Support Engineer</option>
                            @foreach ($supEngs as $supEng)
                                <option value="{{ $supEng->id }}">{{ $supEng->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Assign" class="btn btn-primary btn-sm float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection