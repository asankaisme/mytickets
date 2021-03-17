@extends('layouts.template')

@section('content')
<div class="col-md-12">
  <div class="border mb-3 py-2 text-white px-2" style="background-color: rgba(7, 145, 7, 0.705)">
    User Activities
  </div>
  <div class="row">
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-list"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">All Tickets</span>
          <span class="info-box-number">
            {{ $allTickets }}
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Completed</span>
          <span class="info-box-number">{{ $allCompletedTickets }}</span>
        </div>
      </div>
    </div>
    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-angle-double-right"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Assigned</span>
          <span class="info-box-number">{{ $allAssignedTickets }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">New</span>
          <span class="info-box-number">{{ $allNewTickets }}</span>
        </div>
      </div>
  </div>
</div>
</div>
<hr>
<div class="col-md-12">
  <div class="border mb-3 py-2 text-white px-2" style="background-color: rgba(91, 120, 173, 0.705)">
    System Activities
  </div>
<div class="row">
    <div class="col-sm-3">
      <div class="position-relative p-3 bg-gray" style="height: 180px">
        <div class="ribbon-wrapper ribbon-lg">
          <div class="ribbon bg-success text-lg">
            Ribbon
          </div>
        </div>
        Ribbon Large <br> with Large Text <br>
        <small>.ribbon-wrapper.ribbon-lg .ribbon.text-lg</small>
      </div>
    </div>
  </div>
</div>
@endsection

