@extends('reports._RepLayout')

@section('content')
    <h3>{{ $title }}</h3>
    <div class="table">
        @foreach ($tickets as $ticket)
        <table>
            <thead>
              <tr>
                <th colspan="5">Incident No</th>
                <th>{{ $ticket->id }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="3">{{ $ticket->created_at }}</td>
                <td colspan="3">{{ $ticket->createdBy->name }}</td>
              </tr>
              <tr>
                <td colspan="6">{{ $ticket->title }}</td>
              </tr>
              <tr>
                <td colspan="5">Priority</td>
                <td>{{ $ticket->status }}</td>
              </tr>
              <tr>
                <td colspan="6">{{ $ticket->body }}</td>
              </tr>
              <tr>
                <td colspan="6">{{ $ticket->comments['diagnosis'] }}</td>
              </tr>
              <tr>
                <td colspan="6">Sol</td>
              </tr>
              <tr>
                <td colspan="2">dt</td>
                <td colspan="2">by</td>
                <td colspan="2">l2</td>
              </tr>
            </tbody>
        </table>
        @endforeach
        
    </div>
@endsection