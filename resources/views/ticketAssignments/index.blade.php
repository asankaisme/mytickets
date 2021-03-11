@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">Ticket Assignments</li>
      </ol>
  </div>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <div class="card-header" style="background-color: #eeeeee">
        Manage - Ticket Assignments
      </div>
      <div class="card-body">
        <table id="tiketsList" class="table table-striped table-hover table-sm">
          <thead>
            <tr>
              <td>#</td>
              <td>Title</td>
              <td>Author</td>
              <td>Created On</td>
              <td>Assigned By</td>
              <td>Status</td>
              <td>Assigned To</td>
              <td>Attachment</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @if ($ticketAssignments->count() > 0)
              @foreach ($ticketAssignments as $ticketAssignment)
                <tr>
                  <td>{{ $ticketAssignment->id }}</td>
                  <td>{{ $ticketAssignment->title }}</td>
                  <td>{{ $ticketAssignment->createdBy->name}}</td>
                  <td>{{ $ticketAssignment->created_at->diffForHumans() }}</td>
                  <td>
                    @if ($ticketAssignment->status == "ASSIGNED")
                        {{ $ticketAssignment->ticketAssignment->assignedBy->name }}
                    @endif
                  </td>
                  <td>{{ $ticketAssignment->status }}</td>
                  <td>
                    @if ($ticketAssignment->status == "ASSIGNED")
                        {{ $ticketAssignment->ticketAssignment->assignedTo->name }}
                    @endif
                  </td>
                  <td>
                    @if ($ticketAssignment->img_name != null)
                        <span><i class="fas fa-paperclip"></i></span>
                    @else
                        -    
                    @endif
                  </td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('ticketAssignments.show', $ticketAssignment->id) }}" class="btn btn-xs btn-primary" title="View"><i class="fas fa-eye"></i></a>
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