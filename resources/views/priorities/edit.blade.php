@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">Priority Management</li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-4">
        <div class="card card-info card-outline">
            <div class="card-header">
                Edit Ticket Priority Level
            </div>
            <div class="card-body">
                <form action="{{ route('priorities.update', $priority->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="hTitle">Header Title</label>
                        <input type="text" name="hTitle" class="form-control" value="{{ $priority->priority_level }}">
                    </div>
                    <div class="form-group">
                        <label for="hDescription">Header Title</label>
                        <textarea name="hDescription" cols="30" rows="10" class="form-control">{{ $priority->priority_Description }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary btn-sm float-right mx-2">
                        <a href="{{ route('priorities.index') }}" class="btn btn-outline-dark btn-sm float-right">Back</a>
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