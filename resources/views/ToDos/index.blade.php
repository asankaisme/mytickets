@extends('layouts.template')



@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">To Do's</li>
      </ol>
  </div>
@endsection

@section('content')
  <div class="col-md-12">
    @can('add ticket')
      <div class="row">
        <div class="mx-2 my-2 flex">
          <a href="{{ route('tickets.create') }}" class="btn btn-info rounded shadow text-white float-right">Add Tickets</a>
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
              <td>Severity</td>
              <td>Author</td>
              <td></td>
              <td>Assigned By</td>
              <td>Assigned On</td>
              <td>Status</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @if ($jobsToDo->count() > 0)
              @foreach ($jobsToDo as $jobToDo)
              <tr>
                <td>{{ $jobToDo->id }}</td>
                <td>{{ $jobToDo->ticket->title }}</td>
                <td>
                  <span class="float-left" style="color: gray">
                    @if ($jobToDo->ticket->status == "ASSIGNED" || $jobToDo->ticket->status == "ACCEPTED")
                        @if ($jobToDo->ticketPriority->priority_level == "ONE")
                            <i class="fas fa-star"></i>
                        @elseif ($jobToDo->ticketPriority->priority_level == "TWO")
                            @for ($i = 0; $i < 2; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($jobToDo->ticketPriority->priority_level == "THREE")
                            @for ($i = 0; $i < 3; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        @elseif ($jobToDo->ticketPriority->priority_level == "FOUR")
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
                <td>{{ $jobToDo->ticket->createdBy->name }}</td>
                <td>
                  @if ($jobToDo->ticket->img_name)
                      <span><i class="fas fa-paperclip"></i></span>
                  @else
                      -
                  @endif
                </td>
                <td>{{ $jobToDo->assignedBy->name }}</td>
                <td>{{ $jobToDo->created_at }}</td>
                <td>
                  {{ $jobToDo->ticket->status }} <span style="color: gray"><i class="fas fa-clock"></i> {{ $jobToDo->ticket->updated_at->diffForHumans() }}</span>
                </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <a href="{{ route('Todos.show', $jobToDo->ticket->id) }}" title="View"><i class="fas fa-eye"></i></a>
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