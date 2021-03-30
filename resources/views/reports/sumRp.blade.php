@extends('reports._RepLayout')

@section('content')
<div>
    <p>System level statistics</p>
    <div class="col-md-4">
        <table id="myTable">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>All Incidents</td>
                    <td>{{ $allSysTickets }}</td>
                </tr>
                <tr>
                    <td>Assigned Incidents</td>
                    <td>{{ $allAssignedSysTickets }}</td>
                </tr>
                <tr>
                    <td>Accepted Incidents</td>
                    <td>{{ $allAcceptedSysTickets }}</td>
                </tr>
                <tr>
                    <td>Completed Incidents</td>
                    <td>{{ $allCompletedSysTickets }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div>
    <p>Detailed view of Incidents</p>
    <table id="myTable">
        <thead>
          <tr>
            <th></th>
            <th>Noticable</th>
            <th>Minor</th>
            <th>Major</th>
            <th>Critical</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>All Incidents</td>
            <td>{{ $allNoticableTickets }}</td>
            <td>{{ $allMinorTickets }}</td>
            <td>{{ $allMajorTickets }}</td>
            <td>{{ $allCriticalTickets }}</td>
            <td>{{ $allNoticableTickets+$allMinorTickets+$allMajorTickets+$allCriticalTickets }}</td>
          </tr>
          <tr>
            <td>Assigned Incidents</td>
            <td>{{ $allNoticableAssignedTickets }}</td>
            <td>{{ $allMinorAssignedTickets }}</td>
            <td>{{ $allMajorAssignedTickets }}</td>
            <td>{{ $allCriticalAssignedTickets }}</td>
            <td>{{ $allNoticableAssignedTickets+$allMinorAssignedTickets+$allMajorAssignedTickets+$allCriticalAssignedTickets }}</td>
          </tr>
          <tr>
            <td>Accepted Incidents</td>
            <td>{{ $allNoticeAccptedTickets }}</td>
            <td>{{ $allMinorAccptedTickets }}</td>
            <td>{{ $allMajorAccptedTickets }}</td>
            <td>{{ $allCriticalAccptedTickets }}</td>
            <td>{{ $allNoticeAccptedTickets+$allMinorAccptedTickets+$allMajorAccptedTickets+$allCriticalAccptedTickets }}</td>
          </tr>
          <tr>
            <td>Completed Incidents</td>
            <td>{{ $allNoticeCompletedTickets }}</td>
            <td>{{ $allMinorCompletedTickets }}</td>
            <td>{{ $allMajorCompletedTickets }}</td>
            <td>{{ $allCriticalCompletedTickets }}</td>
            <td>{{ $allNoticeCompletedTickets+$allMinorCompletedTickets+$allMajorCompletedTickets+$allCriticalCompletedTickets }}</td>
          </tr>
        </tbody>
        </table>
</div>
@endsection