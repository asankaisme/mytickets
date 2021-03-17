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
                    @if ($ticketToDo->status == "ASSIGNED" || $ticketToDo->status == "ACCEPTED" || $ticketToDo->status == "COMPLETED")
                        @if ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "NOTICE")
                            <i class="fas fa-star"></i>
                        @elseif ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "MINOR")
                            @for ($i = 0; $i < 2; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "MAJOR")
                            @for ($i = 0; $i < 3; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($ticketToDo->ticketAssignment->ticketPriority->priority_level == "CRITICAL")
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
                @if ($ticketToDo->status == 'ASSIGNED' || $ticketToDo->status == 'ACCEPTED' || $ticketToDo->status == "COMPLETED")
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
        @if ($ticketToDo->status != "COMPLETED")
            <div class="card">
                <div class="card-header" style="background-color: #e2f0a2">
                Next Step
                </div>
                <div class="card-body">
                    <div class="form-group">
                        @if ($ticketToDo->status == "ASSIGNED")
                            <p>What should I do with this ticket?</p>
                            <a href="{{ route('acceptTicket', $ticketToDo->id) }}" class="btn btn-sm btn-success">Accept</a>
                            <a href="{{ route('raiseToL2', $ticketToDo->id) }}" class="btn btn-sm btn-outline-danger">Return</a>
                        @elseif ($ticketToDo->status == "ACCEPTED")
                            <p>I can't handle this. I want to raise this ticket to level 2 (L2) engineer.</p>
                            <form action="#" method="post">
                                @csrf
                                <div class="form-group">
                                    {{-- <label for="email">Supervisor Email</label> --}}
                                    <input type="email" name="email" class="form-control form-control-sm" placeholder="Supervisors' email here!" >
                                    <input type="submit" value="Send" class="btn btn-sm btn-outline-danger my-1 float-right">
                                </div>
                            </form>
                        @else
                        
                        @endif
                    </div>
                </div>
            </div>
        @endif
        
        @if ($ticketToDo->status == "ACCEPTED")
            <div class="card card-info">
                <div class="card-header">
                    Lab Report
                </div>
                <div class="card-body">
                    <form action="{{ route('ticketComments.store') }}" method="post">
                        @csrf
                        {{-- @method('PUT') --}}
                        <input type="hidden" name="ticketId" value="{{ $ticketToDo->id }}">
                        <div class="form-group">
                            <textarea name="diagnosis" cols="30" rows="6" placeholder="Your diagnosis.." class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <textarea name="solution" cols="30" rows="6" placeholder="Your solution.." class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Complete" class="btn btn-success btn-sm float-right mx-1">
                            <input type="reset" value="Clear" class="btn btn-outline-dark btn-sm float-right">
                        </div>
                    </form>
                </div>
            </div>
        @endif
            
        @if ($ticketToDo->status == "COMPLETED")
        <div class="card card-info">
            <div class="card-header">
                Lab Report
            </div>
            <div class="card-body">
                <form action="{{ route('ticketComments.store') }}" method="post">
                    @csrf
                    {{-- @method('PUT') --}}
                    <input type="hidden" name="ticketId" value="{{ $ticketToDo->id }}">
                    <div class="form-group">
                        <label for="diagnosis">Diagnosis</label>
                        <textarea name="diagnosis" cols="30" rows="6" class="form-control form-control-sm" disabled>{{ $ticketToDo->comments->diagnosis }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="Solution">Solution</label>
                        <textarea name="solution" cols="30" rows="6" class="form-control form-control-sm" disabled>{{ $ticketToDo->comments->solution }}</textarea>
                    </div>
                    {{-- <div class="form-group">
                        <input type="submit" value="Complete" class="btn btn-success btn-sm float-right mx-1">
                        <input type="reset" value="Clear" class="btn btn-outline-dark btn-sm float-right">
                    </div> --}}
                </form>
            </div>
        </div>
        @endif
    </div>
@endsection