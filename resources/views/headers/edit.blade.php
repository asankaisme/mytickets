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
    <div class="col-md-4">
        <div class="card card-info card-outline">
            <div class="card-header">
                Edit Ticket Header
            </div>
            <div class="card-body">
                <form action="{{ route('headers.update', $header->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="hTitle">Header Title</label>
                        <input type="text" name="hTitle" class="form-control" value="{{ $header->hTitle }}">
                    </div>
                    <div class="form-group">
                        <label for="hDescription">Header Title</label>
                        <textarea name="hDescription" cols="30" rows="10" class="form-control">{{ $header->hDescription }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary btn-sm float-right mx-2">
                        <a href="{{ route('headers.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>
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