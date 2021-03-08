@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('ticketAssignments.index') }}">Ticket Assignments</a></li>
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
                    <input type="text" name="title" value="{{ $ticket->title }}" disabled class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="body">Content</label>
                    <textarea name="body" class="form-control form-control-sm" cols="30" rows="10" disabled>{{ $ticket->body }}</textarea>
                </div>

                <div>
                    @if (($ticket->img_name != null))
                       <a href="#"><p>This ticket has one attachement. <span><i class="fas fa-image"></i></span></p></a> 
                    @else
                       <p>No image attached.</p> 
                    @endif
                </div>

                <div class="form-group">
                    <div class="form-control form-control-sm">
                        <p>Author : <a href="{{ route('users.show', $ticket->createdBy->id) }}"><strong>{{ $ticket->createdBy->name }}</strong></a>  created this ticket on <strong>{{ $ticket->created_at }}</strong> <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticket->created_at->diffForHumans() }}</span> </p>
                    </div>
                </div>
                <div>
                    <a href="{{ route('ticketAssignments.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>
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
                @if ($ticket->status == 'ASSIGNED')
                    <div>
                        <div class="form-group">
                            <label for="assigned_to">Assigned To</label>
                            <input type="text" name="assigned_to" class="form-control form-control-sm" value="{{ $ticket->ticketAssignment->assignedTo->name }}" disabled>
                            <p style="color: gray">on {{ $ticket->ticketAssignment['created_at'] }} <span class="time"><i class="fas fa-clock"></i></span> <span style="color: gray">{{ $ticket->ticketAssignment['created_at']->diffForHumans() }}</span> </p>
                        </div>
                        <div class="form-group">
                            <label for="assigned_by">Assigned By</label>
                            <input type="text" name="assigned_by" class="form-control form-control-sm" value="{{ $ticket->ticketAssignment->assignedBy->name }}" disabled>
                        </div>
                    </div>
                @else
                    <p>This ticket will be assigned to a support engineer very soon.</p>
                @endif
                
            </div>
        </div>

        <div class="card card-danger card-outline">
            <div class="card-header" style="background-color: #e9e3aa">
                Assign This Ticket
            </div>
            <div class="card-body">
                @if ($ticket->status != "ASSIGNED")
                    <form action="{{ route('ticketAssignments.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
                        <div class="form-group">
                            <label for="selectSupEng">Select Support Engineer</label>
                            <select name="selectSupEng" class="form-control form-control-sm">
                                <option value="null">Select Support Engineer</option>
                                @foreach ($supEngs as $supEng)
                                    <option value="{{ $supEng->id }}">{{ $supEng->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectHeader">Select Ticket Header</label>
                            <select name="selectHeader" class="form-control form-control-sm">
                                <option value="null">Select Header</option>
                                @foreach ($headers as $header)
                                    <option value="{{ $header->id }}">{{ $header->hTitle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="selectPriority">Select Severity Level</label>
                            <select name="selectPriority" class="form-control form-control-sm">
                                <option value="null">Select Severity Level</option>
                                @foreach ($priorityLevels as $priorityLevel)
                                    <option value="{{ $priorityLevel->id }}">{{ $priorityLevel->priority_level }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Assign" class="btn btn-primary btn-sm float-right">
                            <input type="reset" value="Clear" class="btn btn-outline-dark btn-sm float-right mx-1">
                        </div>
                    </form>
                @else
                    <p>Un-assigned this ticket from : {{ $ticket->ticketAssignment->assignedTo->name }}</p>
                    <div class="form-group">
                        <a href="{{ route('detachTicket', $ticket->ticketAssignment->id) }}" class="btn btn-danger btn-sm">Detach</a>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
@endsection