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
    <div class="row">
      <div class="mx-2 my-2 flex">
        <button class="btn btn-info rounded shadow text-white float-right" data-toggle="modal" data-target="#myModal">Add New</button>
      </div>
    </div>
    <div class="card">
      <div class="card-header" style="background-color: #b5b5b5">
        Manage - Tickets
      </div>
      <div class="card-body">
        <table id="tiketsList" class="table table-bordered table-striped table-hover table-sm">
          <thead>
            <tr>
              <td>#</td>
              <td>Title</td>
              <td>Author</td>
              <td>Created On</td>
              <td>Status</td>
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
                  <td>{{ $ticket->created_at->diffForHumans() }}</td>
                  <td>{{ $ticket->status }}</td>
                  <td>
                    <div class="btn-group btn-group-sm">
                      <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
                      <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                      <a href="#" class="btn btn-xs btn-success"><i class="fas fa-arrow-alt-circle-right"></i></a>
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
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header" style="background-color: #b5b5b5">
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
          <h5 class="modal-title" id="myModalLabel">Add New Ticket</h5>
          </div>
          <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
              <div class="modal-body">
                  <div class="form-group">
                      <input type="text" class="form-control" name="title" placeholder="Ticket Title">
                      @error('name')
                          {{ $message }}
                      @enderror
                  </div>
                  <div class="form-group">
                      <textarea class="form-control pt-2" name="body" rows="6" placeholder="Please describe the issue you got.."></textarea>@error('name')
                      {{ $message }}
                  @enderror
                  </div>
                  <div class="form-group">
                      {{-- <label for="exampleInputFile">File input</label> --}}
                      <input type="file" name="img_name">
                      <p class="help-block">Attach a screenshot</p>
                    </div>
              </div>
              <div class="modal-footer">
                  <button type="cancel" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Add New</button>
              </div>
          </form>
          
      </div>
      </div>
  </div>
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