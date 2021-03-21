@extends('layouts.template')

@section('breadcrumb')
  <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home">Home</a></li>
          <li class="breadcrumb-item active">FAQs</li>
      </ol>
  </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="border mb-3 py-2 px-2 rounded-top" style="background-color: rgba(125, 233, 134, 0.705)">
            <h5>FAQs</h5>
        </div>
        <div class="callout callout-danger">
            <h5>I cannot login to TMS!</h5>
            <p>Make sure you enter your TMS user name correctly with ALL CAPS. And make sure the caps lock is not pressed when you enter your password.</p>
        </div>
        <div class="callout callout-info">
            <h5>Deals cannot be captured!</h5>
            <p>First you check the position server icon turned green of the lower right corner of deal capturing screen. If it is red speck to the system administrator.</p>
        </div>
        <div class="callout callout-warning">
            <h5>I cannot see certain deals to settle!</h5>
            <p>Check with system admin whether you are authorised to settle these types of deals.</p>
        </div>
        <div class="callout callout-dark">
            <h5>Deal dockets/Letters not printed!</h5>
            <p>Check whether the network printer is connected to your PC. Then the issue is with mail merge interface. Speak to JIT helpdesk.</p>
        </div>
        <div class="callout callout-success">
            <h5>Auto deals not captured !</h5>
            <p>Check whether the TMS auto capturing interface is running in ABC terminal.</p>
        </div>
    </div>
@endsection