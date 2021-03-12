@extends('layouts.template')



@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">KnowledgeBase</li>
      </ol>
  </div>
@endsection






@section('content')
  <div class="col-md-12">
    {{-- <div class="row">
      <div class="mx-2 my-2 flex">
        <a href="{{ route('tickets.create') }}" class="btn btn-info rounded shadow text-white float-right">Add Tickets</a>
      </div>
    </div> --}}
    <div class="card card-primary card-outline">
      <div class="card-header" style="background-color: #eeeeee">
        Knowledge Base
      </div>
      <div class="card-body">
        <table id="tiketsList" class="table table-bordered table-striped table-hover table-sm">
          <thead>
            <tr>
              <td>#</td>
              <td>Title</td>
              <td>Content</td>
              <td>Created On</td>
              <td>Author</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            @if ($dataset->count() > 0)
              @foreach ($dataset as $dataset)
                <tr>
                  <td>{{ $dataset->id }}</td>
                  <td>{{ $dataset->title }}</td><td>{{ $dataset->body }}</td><td>{{ $dataset->body }}</td>
                  <td>{{ $dataset->createdBy->name}}</td>
                  <td>{{ $dataset->created_at->diffForHumans() }}</td>
                  
                  <td>dataset
                    <div class="btn-group btn-group-sm">
                      {{-- <a href="{{ route('tickets.show', $ticket->id) }}" title="View"><i class="fas fa-eye"></i></a> --}}
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