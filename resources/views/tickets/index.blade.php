@extends('layouts.template')



@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">Ticket Management</li>
      </ol>
  </div>
@endsection

@section('content')
  <div class="col-md-12">
    @can('add ticket')
      <div class="row">
        <div class="mx-2 my-2 flex">
          <a href="{{ route('tickets.create') }}" class="btn btn-primary rounded shadow float-right">Add Tickets</a>
        </div>
      </div>
    @endcan
    
    <div class="card card-primary card-outline">
      <div class="card-header" style="background-color: #eeeeee">
        Manage - Tickets
      </div>
      <div class="card-body">
        <table id="tiketsList" class="table table-striped table-hover table-sm">
          <thead>
            <tr>
              <td>#</td>
              <td>Title</td>
              <td>Author</td>
              <td>Created On</td>
              <td></td>
              <td></td>
              <td>Assigned To</td>
              <td>Status</td>
              <td>Fb</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @if ($tickets->count() > 0)
              @foreach ($tickets as $ticket)
                <tr>
                  <td>{{ $ticket->id }}</td>
                  <td>{{ $ticket->title }}</td>
                  <td>{{ $ticket->createdBy->name}}</td>
                  <td>{{ $ticket->created_at }} <span style="color: gray"> <i class="fas fa-clock"></i> {{ $ticket->created_at->diffForHumans() }}</span></td>
                  <td>
                    <span style="color: gray">
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
                  </td>
                  <td>
                    @if ($ticket->img_name)
                        <span><i class="fas fa-paperclip"></i></span>
                    @else
                        -
                    @endif
                  </td>
                  <td>
                    @if ($ticket->status == "ASSIGNED" || $ticket->status == "ACCEPTED" || $ticket->status == "COMPLETED")
                        {{ $ticket->ticketAssignment->assignedTo->name }}
                    @endif
                  </td>
                  <td>{{ $ticket->status }}</td>
                  <td>
                    @if($ticket->feedback)
                      <span><i class="fas fa-check-circle"></i></span>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('tickets.show', $ticket->id) }}" title="View"><i class="fas fa-eye"></i></a>
                      {{-- <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a> --}}
                      {{-- <a href="#" class="btn btn-xs btn-danger"><i class="fas fa-trash" title="Delete"></i></a> --}}
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
               {{-- <p>No tickets yet!!</p>  --}}
            @endif
            
          </tbody>
        </table>
      </div>
    </div>

    {{-- for flash mesages --}}

    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('message') }}
      </div>
    @endif
    {{-- end flash messages --}}

    <!-- Modal -->
    
  {{-- end modal --}}

  </div>
  
      @section('tblScripts')
        <script>
          $(function () {
            $("#tiketsList").DataTable({
              "responsive": true,
              "autoWidth": false,
            });
            $('#example2').DataTable({
              "paging": true,
              "lengthChange": false,
              "searching": false,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
            });
          });
        </script>
      @endsection
    
@endsection