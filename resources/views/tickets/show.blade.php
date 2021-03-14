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
                <span class="float-right">
                    @if ($ticket->status == "ASSIGNED")
                        @if ($ticket->ticketAssignment->ticketPriority->priority_level == "ONE")
                            <i class="fas fa-star"></i>
                        @elseif ($ticket->ticketAssignment->ticketPriority->priority_level == "TWO")
                            @for ($i = 0; $i < 2; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticket->ticketAssignment->ticketPriority->priority_level == "THREE")
                            @for ($i = 0; $i < 3; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticket->ticketAssignment->ticketPriority->priority_level == "FOUR")
                            @for ($i = 0; $i < 4; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @else
                            {{-- <p class="" style="color: gray">Await rating</p>     --}}
                        @endif
                    @else
                            
                    @endif
                </span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" value="{{ $ticket->title }}" disabled class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" class="form-control form-control-sm" cols="30" rows="10" disabled>{{ $ticket->body }}</textarea>
                </div>

                <div>
                    @if (($ticket->img_name != null))
                       <a href="{{ asset('/storage/screenshots/'.$ticket->img_name) }}" target="_blank" ><p>This ticket has one attachement. <span><i class="fas fa-image"></i></span></p></a> 
                    @else
                       <p>No image attached.</p> 
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-control form-control-sm">
                        <p>Author : <a href="{{ route('users.show', $ticket->createdBy->id) }}"><strong>{{ $ticket->createdBy->name }}</strong></a>  created this ticket on <strong>{{ $ticket->created_at }}</strong> <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticket->created_at->diffForHumans() }}</span> </p>
                    </div>
                </div>
                @if (($ticket->status == "NEW") || ($ticket->status == "DETACHED"))
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
                @else
                    <div>
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline collapsed-card">
            <div class="card-header">
              <h3 class="card-title">Additional Information</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: none;">
                @if ($ticket->status == "NEW")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-yellow rounded p-2">{{ $ticket->status }}</span>
                    </div>
                @elseif ($ticket->status == "ASSIGNED")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-blue rounded p-2">{{ $ticket->status }}</span>
                    </div>
                @elseif ($ticket->status == "ACCEPTED")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-purple rounded p-2">{{ $ticket->status }}</span>
                    </div>
                @elseif ($ticket->status == "COMPLETED")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-green rounded p-2">{{ $ticket->status }}</span>
                    </div>
                @else
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-gray rounded p-2">{{ $ticket->status }}</span>
                    </div>
                @endif
                <hr>
                @if ($ticket->status == "ASSIGNED" || $ticket->status == "ACCEPTED")
                    <div>
                        <div class="form-group">
                            <label for="assigned_to">Assigned To : <span style="color: gray;">Support Engineer</span></label>
                            <input type="text" name="assigned_to" class="form-control form-control-sm" value="{{ $ticket->ticketAssignment->assignedTo->name }}" disabled>
                            <p style="color: gray">on {{ $ticket->ticketAssignment['created_at'] }} <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticket->ticketAssignment['created_at']->diffForHumans() }}</span> </p>
                        </div>
                        <div class="form-group">
                            <label for="assigned_by">Assigned By :</label>
                            <input type="text" name="assigned_by" class="form-control form-control-sm" value="{{ $ticket->ticketAssignment->assignedBy->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ticketHeader">Ticket Header</label>
                            <input type="text" name="ticketHeader" class="form-control form-control-sm" value="{{ $ticket->ticketAssignment->ticketHeader->hTitle }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="Severity">Severity Level</label>
                            <input type="text" name="Severity" class="form-control form-control-sm" value="{{ $ticket->ticketAssignment->ticketPriority->priority_level }}" disabled>
                        </div>
                    </div>
                @else
                    <p style="color: gray">This ticket will be assigned to a support engineer very soon.</p>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        @if ($ticket->status == "COMPLETED")
            <div class="card card-info">
                <div class="card-header">
                    Lap Report on ticket #{{ $ticket->id }}
                </div>
                <div class="card-body">
                    <div class="callout callout-danger">
                        <h5>Diagnosis</h5>
                        <p>***</p>
                    </div>
                    <div class="callout callout-success">
                        <h5>Solution</h5>
                        <p>***</p>
                    </div>
                </div>
            </div>
        @else
            
        @endif
    </div>
@endsection