@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">KPI</li>
      </ol>
  </div>
@endsection

@section('content')
  <div class="col-md-12">
    <div class="card card-primary card-outline">
      <div class="card-header" style="background-color: #eeeeee">
        Key Performance Indicators
      </div>
      <div class="card-body">
        <table id="tiketsList" class="table table-striped table-hover table-sm">
          <thead>
            <tr>
              <td>#</td>
              <td>Ticket No:</td>
              <td>Assigned To:</td>
              <td>Accepted On:</td>
              <td>Finished On:</td>
              <td>Duration</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($ticketsAssigned as $ticketAssigned)
                <tr>
                  <td>{{ $ticketAssigned->id }}</td>
                  <td>{{ $ticketAssigned->ticket_id }}</td>
                  <td>{{ $ticketAssigned->assignedTo->name }}</td>
                  <td>{{ $ticketAssigned->created_at }}</td>
                  <td>{{ $ticketAssigned->updated_at }}</td>
                  <td>
                    {{ \Carbon\Carbon::parse($ticketAssigned->updated_at)->diffForHumans( \Carbon\Carbon::parse($ticketAssigned->created_at) )  }}
                  </td>
                </tr>
            @endforeach
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