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
                @if ($ticket->status == "ASSIGNED" || $ticket->status == "ACCEPTED" || $ticket->status == "COMPLETED")
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
            <div class="card card-info card-outline collapsed-card">
                <div class="card-header">
                    Lab Report on Ticket #{{ $ticket->id }}
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body" style="display: none;">
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
        @else
            
        @endif
        @can('add feedback')
            @if ($ticket->status == "COMPLETED")
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
            @endif
        @endcan
        
    </div>

    {{-- feedback section --}}
    @can('add feedback')
        @if ($ticket->status == "COMPLETED")
        @if ($ticket->feedback)
            
        @else
            <div class="col-md-12">
                <div class="border mb-3 py-2 px-2 text-white" style="background-color: rgba(124, 46, 10, 0.705)">
                    User Feedback <span><i class="fas fa-angle-double-right" style="color: honeydew"></i> Tell us what you feel</span>
                </div>
                <div class="border mb-3 py-2 px-2" style="background-color: rgba(252, 229, 186, 0.705)">
                    Please select the level you satisfied with the service provided by the Support Engineer?
                    <div>
                        Don't worry!! We won't tell this to anyone..
                    </div>
                    
                    <div class="border mb-3 py-2 px-2 mt-2" style="background-color: rgb(255, 254, 254)">
                        <form action="{{ route('addFeedback') }}" method="post">
                            @csrf
                            <input type="hidden" name="ticketID" value="{{ $ticket->id }}">
                            <input type="hidden" name="SupEngID" value="{{ $ticket->ticketAssignment->assignedTo->id }}">
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="radio" name="level" id="smile1" value="1">
                                        <span><i class="fas fa-sad-tear"></i></span>
                                        <label for="smile1">Dissapointed</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="radio" name="level" id="smile2" value="2">
                                        <span><i class="fas fa-frown"></i></span>
                                        <label for="smile2">Sad</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="radio" name="level" id="smile3" value="3">
                                        <span><i class="fas fa-meh"></i></span>
                                        <label for="smile3">Nutral</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="radio" name="level" id="smile4" value="4">
                                        <span><i class="fas fa-smile"></i></span>
                                        <label for="smile4">Happy</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="radio" name="level" id="smile5" value="5">
                                        <span><i class="fas fa-laugh-squint"></i></span>
                                        <label for="smile5">Very Happy</label>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="text" name="feedback" placeholder="Tell us little about it." class="form-control form-control-sm">
                                    <input type="submit" value="Rate!" class="btn btn-info btn-sm mt-2 float-right">
                                    <input type="reset" value="Clear" class="btn btn-outline-dark btn-sm mt-2 float-right mx-2">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {{-- show flash message --}}
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('message') }}
                    </div>
                @endif
                {{-- end flash message --}}
            </div>
        @endif
        
        @endif
    @endcan
    
    
@endsection