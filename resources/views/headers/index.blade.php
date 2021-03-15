@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">Headers Management</li>
      </ol>
  </div>
@endsection

@section('content')
  <div class="col-md-8">
      <div class="card card-outline card-primary">
          <div class="card-header" style="background-color: #eeeeee">
            Manage - Ticket Header Titles
          </div>
          <div class="card-body">
            <table id="headerTable" class="table table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Description</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($headers as $header)
                        <tr>
                            <td>{{ $header->id }}</td>
                            <td>{{ $header->hTitle }}</td>
                            <td>{{ $header->hDescription }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('headers.edit', $header->id) }}" title="Edit" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('headers.destroy', $header->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                
                            </td>
                        </tr>    
                    @endforeach
                </tbody>
            </table>
          </div>
      </div>
      @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('message') }}
      </div>
    @endif
  </div>
    <div class="col-md-4">
        <div class="card card-info card-outline">
            <div class="card-header">
                Add New Ticket Header
            </div>
            <div class="card-body">
                <form action="{{ route('headers.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="hTitle">Header Title</label>
                        <input type="text" name="hTitle" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="hDescription">Description</label>
                        <textarea name="hDescription" cols="30" rows="10" class="form-control form-control-sm"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Add Header" class="btn btn-primary btn-sm float-right mx-2">
                        <input type="reset" value="Clear" class="btn btn-outline-dark btn-sm float-right">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @section('tblScripts')
        <script>
          $(function () {
            $("#headerTable").DataTable({
              "responsive": true,
              "autoWidth": false,
            });
          });
        </script>
    @endsection

@endsection