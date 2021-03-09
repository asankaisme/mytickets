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
    <div class="card card-primary card-outline">
      <div class="card-header" style="background-color: #eeeeee">
        Manage - Activity Log
      </div>
      <div class="card-body">
        <table id="tiketsList" class="table table-striped table-hover table-sm">
          <thead>
            <tr>
              <td>#</td>
              <td>Log Name</td>
              <td>Description</td>
              <td>Affected Class</td>
              <td>Type</td>
              <td>Causer Type</td>
              <td>Causer ID</td>
              <td>Created At</td>
              <td>Updated On</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @if ($activities->count() > 0)
              @foreach ($activities as $activity)
                <tr>
                  <td>{{ $activity->id }}</td>
                  <td>{{ $activity->log_name }}</td>
                  <td>{{ $activity->description }}</td>
                  <td>{{ $activity->subject_type }}</td>
                  <td>{{ $activity->subject_id }}</td>
                  <td>{{ $activity->causer_type }}</td>
                  <td>{{ $activity->causer_id }}</td>
                  <td>{{ $activity->created_at }}</td>
                  <td>{{ $activity->updated_at }}</td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      {{-- <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-xs btn-primary" title="View"><i class="fas fa-eye"></i></a> --}}
                      {{-- <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a> --}}
                      {{-- <a href="#" class="btn btn-xs btn-danger"><i class="fas fa-trash" title="Delete"></i></a> --}}
                    </div>
                  </td>
                </tr>
              @endforeach
            @else
            @endif
            
          </tbody>
        </table>
      </div>
    </div>

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