@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">Reports</li>
      </ol>
  </div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="border mb-3 pt-1 px-2 text-white rounded-top" style="background-color: rgba(11, 143, 22, 0.705)">
        <p>Print relavent report</p>
    </div>

    <a href="{{ route('printStatus') }}" class="btn btn-dark" target="_blank">Status</a>
</div>
    
@endsection