@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('Todos.index') }}">To Dos</a></li>
          <li class="breadcrumb-item active">#{{ $ticketToDo->id }}</li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-8">
        <div class="card card-info card-outline">
            <div class="card-header" style="background-color: #eeeeee">
                Details of Ticket #{{ $ticketToDo->id }}
                <span class="float-right" style="color: maroon">
                    @if ($ticketToDo->status == "ASSIGNED")
                        @if ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "ONE")
                            <i class="fas fa-star"></i>
                        @elseif ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "TWO")
                            @for ($i = 0; $i < 2; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "THREE")
                            @for ($i = 0; $i < 3; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "FOUR")
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
                    <input type="text" name="title" value="{{ $ticketToDo->title }}" disabled class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" class="form-control form-control-sm" cols="30" rows="10" disabled>{{ $ticketToDo->body }}</textarea>
                </div>

                <div>
                    @if (($ticketToDo->img_name != null))
                       <a href="{{ asset('/storage/screenshots/'.$ticketToDo->img_name) }}" target="_blank" ><p>This ticket has one attachement. <span><i class="fas fa-image"></i></span></p></a> 
                    @else
                       <p>No image attached.</p> 
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-control form-control-sm">
                        <p>Author : <a href="#"><strong>{{ $ticketToDo->createdBy->name }}</strong></a>  created this ticket on <strong>{{ $ticketToDo->created_at }}</strong> <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticketToDo->created_at->diffForHumans() }}</span> </p>
                    </div>
                </div>
                    <div>
                        <a href="{{ route('Todos.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline collapsed-card">
            <div class="card-header">
              Additional Information
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: none;">
                @if ($ticketToDo->status == "NEW")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-yellow rounded p-2">{{ $ticketToDo->status }}</span>
                    </div>
                @elseif ($ticketToDo->status == "ASSIGNED")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-blue rounded p-2">{{ $ticketToDo->status }}</span>
                    </div>
                @elseif ($ticketToDo->status == "ACCEPTED")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-purple rounded p-2">{{ $ticketToDo->status }}</span>
                    </div>
                @elseif ($ticketToDo->status == "COMPLETED")
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-green rounded p-2">{{ $ticketToDo->status }}</span>
                    </div>
                @else
                    <div class="time-label pb-2">
                        Ticket Status : <span class="bg-gray rounded p-2">{{ $ticketToDo->status }}</span>
                    </div>
                @endif
                <hr>
                @if ($ticketToDo->status == 'ASSIGNED' || $ticketToDo->status == 'ACCEPTED')
                    <div>
                        <div class="form-group">
                            <label for="assigned_to">Assigned To : <span style="color: gray">Support Engineer</span></label>
                            <input type="text" name="assigned_to" class="form-control form-control-sm" value="{{ $ticketToDo->ticketAssignment->assignedTo->name }}" disabled>
                            <p style="color: gray">on {{ $ticketToDo->ticketAssignment['created_at'] }} <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticketToDo->ticketAssignment['created_at']->diffForHumans() }}</span> </p>
                        </div>
                        <div class="form-group">
                            <label for="assigned_by">Assigned By :</label>
                            <input type="text" name="assigned_by" class="form-control form-control-sm" value="{{ $ticketToDo->ticketAssignment->assignedBy->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ticketHeader">Ticket Header</label>
                            <input type="text" name="ticketHeader" class="form-control form-control-sm" value="{{ $ticketToDo->ticketAssignment->ticketHeader->hTitle }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="Severity">Severity Level</label>
                            <input type="text" name="Severity" class="form-control form-control-sm" value="{{ $ticketToDo->ticketAssignment->ticketPriority->priority_level }}" disabled>
                        </div>
                    </div>
                @else
                    <p style="color: gray">This ticket will be assigned to a support engineer very soon.</p>
                @endif
            </div>
        </div>
        <div class="card card-info">
            <div class="card-header">
              Next Step
            </div>
            <div class="card-body">
                <div class="form-group">
                    @if ($ticketToDo->status == "ASSIGNED")
                        <p>What should I do with this ticket?</p>
                        <a href="{{ route('acceptTicket', $ticketToDo->id) }}" class="btn btn-sm btn-success">Accept</a>
                        <a href="{{ route('raiseToL2', $ticketToDo->id) }}" class="btn btn-sm btn-outline-danger">Raise to L2</a>
                    @elseif ($ticketToDo->status == "ACCEPTED")
                        <p>I can't handle this. I will send this to my supervisor.</p>
                        <a href="{{ route('raiseToL2', $ticketToDo->id) }}" class="btn btn-sm btn-outline-danger">Raise to L2</a>             
                    @else
                    
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection