@extends('reports._RepLayout')

@section('content')
    <h3>{{ $title }}</h3>
    <div class="table">
        @foreach ($tickets as $ticket)
        <table id="myTable" style="margin-top: 10px">
            <thead>
              <tr>
                <th colspan="5">Incident No</th>
                <th>#{{ $ticket->id }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="3">
                  <span style="font-style: italic">Logged at: </span>
                  <div style="margin-top: 4px">
                    {{ $ticket->created_at }}
                  </div>
                </td>
                <td colspan="3">
                  <span style="font-style: italic">Author:</span>
                  <div style="margin-top: 4px">
                    {{ $ticket->createdBy->name }}
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="6">
                  <span style="font-style: italic">Incident Title:</span>
                  <div style="margin-top: 4px">
                    {{ $ticket->title }}</td>
                  </div>
              </tr>
              <tr>
                <td colspan="5">
                  <span style="font-style: italic">Severity Level:</span>
                  <div style="margin-top: 4px">
                    @if ($ticket->ticketAssignment)
                      {{ $ticket->ticketAssignment->ticketPriority['priority_level'] }}
                    @else
                        -No Priority set-
                    @endif
                  </div>
              </td>
                <td>
                  <span style="font-style: italic">Incident Status:</span>
                  <div style="margin-top: 4px">
                    {{ $ticket->status }}</td>
                  </div>
              </tr>
              <tr>
                <td colspan="6">
                  <span style="font-style: italic">Incident Description:</span>
                  <div style="margin-top: 4px">
                    {{ $ticket->body }}</td>
                  </div>
              </tr>
              <tr>
                <td colspan="6">
                  <span style="font-style: italic">Incident Diagnosis:</span>
                  <div style="margin-top: 4px">
                    @if ($ticket->comments)
                      {{ $ticket->comments['diagnosis'] }}
                    @else
                      -No diagnosis given-
                    @endif
                  </div>
                </td>
              </tr>
              <tr>
                <td colspan="6">
                  <span style="font-style: italic">Incident Solution:</span>
                  <div style="margin-top: 4px">
                    @if ($ticket->comments)
                      {{ $ticket->comments['solution'] }}
                    @else
                      -No solution given-
                    @endif
                  </div>
              </td>
              </tr>
              <tr>
                <td colspan="2">
                  <span style="font-style: italic">Updated at:</span>
                  <div style="margin-top: 4px">
                    {{ $ticket->updated_at }}
                  </div> 
                </td>
                <td colspan="2">
                  <span style="font-style: italic">Solution given by SSE:</span>
                  <div style="margin-top: 4px">
                      @if ($ticket->ticketAssignment)
                      {{ $ticket->ticketAssignment->assignedBy->name }}
                    @else
                        -Not yet updated-
                    @endif
                  </div>
                </td>
                <td colspan="2">
                  <span style="font-style: italic">L2 transferred by SSE:</span>
                  <div style="margin-top: 4px">
                    NO
                  </div>
                </td>
              </tr>
            </tbody>
        </table>
        @endforeach
        
    </div>
@endsection