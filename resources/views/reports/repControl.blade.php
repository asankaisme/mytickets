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
    <div class="row">
        <div class="col-sm-2">
            Current Status Report :
        </div>
        <div class="col-sm-2">
            <a href="{{ route('printStatus') }}" class="btn btn-outline-info btn-sm" target="_blank">Print</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-2">
            Current Summary Report :
        </div>
        <div class="col-sm-2">
            <a href="#" class="btn btn-outline-info btn-sm" target="_blank">Print</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-2">
            Incidents reolved by SSEs (monthly) Report :
        </div>
        <div class="col-sm-2">
            <a href="#" class="btn btn-outline-info btn-sm" target="_blank">Print</a>
        </div>
    </div>
</div>
    
@endsection