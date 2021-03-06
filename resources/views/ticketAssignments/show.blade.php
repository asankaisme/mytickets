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
                <span class="float-right" style="color: maroon">
                    @if ($ticket->status == "ASSIGNED" || $ticket->status == "ACCEPTED" || $ticket->status == "COMPLETED")
                        @if ($ticket->ticketAssignment->ticketPriority->priority_level == "NOTICE")
                            <i class="fas fa-star"></i>
                        @elseif ($ticket->ticketAssignment->ticketPriority->priority_level == "MINOR")
                            @for ($i = 0; $i < 2; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticket->ticketAssignment->ticketPriority->priority_level == "MAJOR")
                            @for ($i = 0; $i < 3; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticket->ticketAssignment->ticketPriority->priority_level == "CRITICAL")
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
                <div>
                    <a href="{{ route('ticketAssignments.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>
                </div>
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
                @if ($ticket->status == 'ASSIGNED' || $ticket->status == 'ACCEPTED' || $ticket->status == "COMPLETED")
                    <div>
                        <div class="form-group">
                            <label for="assigned_to">Assigned To : Support Engineer</label>
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

        @if ($ticket->status != "COMPLETED" || $ticket->status != "ASSIGNED" || $ticket->status != "ACCEPTED")

        @else
            <div class="card card-danger card-outline">
                <div class="card-header" style="background-color: #e9e3aa">
                    Assign This Ticket
                </div>
                <div class="card-body">
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
                </div>
            </div>
        @endif

        @if ($ticket->status == "NEW" || $ticket->status == "DETACHED")
        <div class="card card-danger card-outline">
            <div class="card-header" style="background-color: #e9e3aa">
                Assign This Ticket
            </div>
            <div class="card-body">
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
            </div>
        </div>
        @endif

        @if ($ticket->status == "ASSIGNED")
        <div class="card card-danger card-outline">
            <div class="card-header" style="background-color: #e9e3aa">
                Assign This Ticket
            </div>
            <div class="card-body">
                <p>Un-assigned this ticket from : {{ $ticket->ticketAssignment->assignedTo->name }}</p>
                    <div class="form-group">
                        <a href="{{ route('detachTicket', $ticket->ticketAssignment->id) }}" class="btn btn-danger btn-sm">Detach</a>
                    </div>
            </div>
        @endif

            
            @if ($ticket->status == "COMPLETED")
                <div class="card card-info card-outline collapsed-card">
                    <div class="card-header">
                        Lab Report on Ticket #{{ $ticket->id }}
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body" style="display: none">
                        <form action="{{ route('ticketComments.store') }}" method="post">
                            @csrf
                            {{-- @method('PUT') --}}
                            <input type="hidden" name="ticketId" value="{{ $ticket->id }}">
                            <div class="form-group">
                                <label for="diagnosis">Diagnosis</label>
                                <textarea name="diagnosis" cols="30" rows="6" class="form-control form-control-sm" disabled>{{ $ticket->comments->diagnosis }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Solution">Solution</label>
                                <textarea name="solution" cols="30" rows="6" class="form-control form-control-sm" disabled>{{ $ticket->comments->solution }}</textarea>
                            </div>
                            {{-- <div class="form-group">
                                <input type="submit" value="Complete" class="btn btn-success btn-sm float-right mx-1">
                                <input type="reset" value="Clear" class="btn btn-outline-dark btn-sm float-right">
                            </div> --}}
                        </form>
                    </div>
                </div>
            @endif
            @can('add feedback')
                @if ($ticket->feedback)
                    <div class="card card-warning card-outline collapsed-card">
                        <div class="card-header">
                            Feedback on Ticket #{{ $ticket->id }}
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <div class="form-group">
                                <label for="">Rating</label>
                                <div>
                                    <span>
                                        @for ($i = 0; $i < $ticket->feedback->level; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="feedback">Feedback</label>
                                <div>
                                    <input type="text" name="feedback" disabled value="{{ $ticket->feedback->feedback }}" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="SupEngName">Given to: <span style="color: gray">Support Engineer</span></label>
                                <div>
                                    <input type="text" name="feedback" disabled value="{{ $ticket->feedback->givenTo->name }}" class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif 
            @endcan
           
    </div>
@endsection