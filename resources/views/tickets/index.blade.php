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
  <div class="col-md-7">
    <div class="card">
        <div class="card-header" style="background-color: #cacbcc">Manage - Tickets</div>
        <div class="card-body">
            @livewire('tickets')
        </div>
    </div>
  </div>
  <div class="col-md-5">

  </div>
    
@endsection