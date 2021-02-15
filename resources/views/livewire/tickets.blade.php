<div>
    <div class="my-4 flex">
        @foreach ($tickets as $ticket)
          <div class="px-2 mt-3 rounded border border-1 shadow">
            <div class="flex justify-start my-2">
              <h4 style="color: gray">#{{ $ticket->id }} | {{ $ticket->title }}</h4>
            </div>
            <div class="flex justify-start my-2">
              {{-- {{ $ticket->body }} --}}
            </div>
            <div class="my-2">
              <p style="font-weight: bold">{{ $ticket->user->name }}</p>
            </div>
          </div>
        @endforeach
      </div>
</div>
