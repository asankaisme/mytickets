@extends('layouts.template')

@section('content')
@role('Client')
<div class="col-md-11">
  <div class="border mb-3 py-2 text-white px-2" style="background-color: rgba(7, 145, 7, 0.705)">
    User Activities
  </div>
</div>
<div class="col-md-12">
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
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-2">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">New</span>
          <span class="info-box-number">{{ $allNewTickets }}</span>
        </div>
      </div>
    </div>
    <div class="clearfix hidden-md-up"></div>
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-angle-double-right"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Assigned</span>
          <span class="info-box-number">{{ $allAssignedTickets }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon elevation-1" style="background-color: steelblue"><i class="fas fa-user-check" style="color: white"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Accepted</span>
          <span class="info-box-number">{{ $allAcceptedTickets }}</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-2">
      <div class="info-box mb-3">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Completed</span>
          <span class="info-box-number">{{ $allCompletedTickets }}</span>
        </div>
      </div>
    </div>
  </div>
</div>
@endrole

<div class="col-md-11">
  <div class="border mb-3 py-2 text-white px-2" style="background-color: rgba(91, 120, 173, 0.705)">
    System Activities
  </div>
</div>
<div class="col-md-12">
<div class="row">
    <div class="col-sm-3">
      <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-info">
          <p class="text-center">All Tickets</p>
        </div>
        <div class="card-footer p-0">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Total <span class="float-right badge bg-info">{{ $allSysTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                New <span class="float-right badge bg-warning">{{ $allNewSysTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Assigned <span class="float-right badge bg-info">{{ $allAssignedSysTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Accepted <span class="float-right badge text-white" style="background-color: steelblue">{{ $allAcceptedSysTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Completed <span class="float-right badge bg-success">{{ $allCompletedSysTickets }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        
        <div class="widget-user-header" style="background-color: rgb(252, 231, 221)">
          <p class="text-center">Noticable</p>
        </div>
        <div class="card-footer p-0">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Total <span class="float-right badge bg-info">{{ $allNoticableTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Assigned <span class="float-right badge bg-primary">{{ $allNoticableAssignedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Accepted <span class="float-right badge text-white" style="background-color: steelblue">{{ $allNoticeAccptedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Completed <span class="float-right badge bg-success">{{ $allNoticeCompletedTickets }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header" style="background-color: rgb(253, 213, 194)">
          <p class="text-center">Minor Level</p>
        </div>
        <div class="card-footer p-0">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Total <span class="float-right badge bg-info">{{ $allMinorTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Assigned <span class="float-right badge bg-primary">{{ $allMinorAssignedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Accepted <span class="float-right badge text-white" style="background-color: steelblue">{{ $allMinorAccptedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Completed <span class="float-right badge bg-success">{{ $allMinorCompletedTickets }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header" style="background-color: rgb(253, 193, 165)">
          <p class="text-center">Major Level</p>
        </div>
        <div class="card-footer p-0">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Total <span class="float-right badge bg-info">{{ $allMajorTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Assigned <span class="float-right badge bg-primary">{{ $allMajorAssignedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Accepted <span class="float-right badge text-white" style="background-color: steelblue">{{ $allMajorAccptedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Completed <span class="float-right badge bg-success">{{ $allMajorCompletedTickets }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header" style="background-color: rgb(253, 160, 116)">
          <p class="text-center">Critical Level</p>
        </div>
        <div class="card-footer p-0">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                Total <span class="float-right badge bg-info">{{ $allCriticalTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Assigned <span class="float-right badge bg-primary">{{ $allCriticalAssignedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Accepted <span class="float-right badge text-white" style="background-color: steelblue">{{ $allCriticalAccptedTickets }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                Completed <span class="float-right badge bg-success">{{ $allCriticalCompletedTickets }}</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

