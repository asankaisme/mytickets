<div>
    <div class="row">
        <div class="my-4 flex">
            <input type="text" name="searchTicket" class="rounded border shadow-sm p-2 mr-2" placeholder="Search Tickets">
            <button class="btn btn-primary rounded shadow text-white float-right" data-toggle="modal" data-target="#myModal">Add New</button>
        </div>
    </div>
    
    <div class="my-4 flex pt-5">
        @foreach ($tickets as $ticket)
          <div class="px-2 mt-3 rounded border border-1 shadow">
            <div class="flex justify-start my-2">
              <p class="font-bold text-lg">asanka</p>
            </div>
            <div class="flex justify-start my-2">
              {{ $ticket['title'] }}
            </div>
            <div class="my-2">
              <p style="font-weight: bold">{{ $ticket['created_by']->user['name'] }}</p>
            </div>
          </div>
        @endforeach
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
            <h5 class="modal-title" id="myModalLabel">Add New Ticket</h5>
            </div>
            <form action="">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Ticket Title">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control pt-2" rows="6" placeholder="Please describe the issue you got.."></textarea>
                    </div>
                    <div class="form-group">
                        {{-- <label for="exampleInputFile">File input</label> --}}
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Attach a screenshot</p>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            
        </div>
        </div>
    </div>
    {{-- end modal --}}
</div>
