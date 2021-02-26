@extends('layouts.template')

@section('breadcrumb')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active">User Management</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="col-md-12">

        <div class="row">
            <div class="mx-2 my-2 flex">
              <button class="btn btn-info rounded shadow text-white float-right" data-toggle="modal" data-target="#myModal">Add User</button>
            </div>
          </div>

        <div class="card">
            <div class="card-header p-2">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#userlist" data-toggle="tab">User List</a></li>
                <li class="nav-item"><a class="nav-link" href="#assignroles" data-toggle="tab">Assign Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="#assignpermissions" data-toggle="tab">Assign Permissions</a></li>
            </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                  <div class="active tab-pane" id="userlist">
                      <table id="userList" class="table table-bordered table-striped table-hover table-sm">
                          <thead>
                            <tr>
                              <td>#</td>
                              <td>Name</td>
                              <td>Role</td>
                              <td>Email</td>
                              <td>Created On</td>
                              <td>Updated On</td>
                              <td>isActive</td>
                              <td></td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->roles->pluck('name') }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                                    <td>{{ $user->isActive }}</td>
                                    <td>
                                      <div class="btn-group btn-group-sm">
                                          <a href="{{ route('users.show', $user->id) }}" class="btn btn-xs btn-primary" title="View"><i class="fas fa-eye"></i></a>
                                          {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a> --}}
                                          {{-- <a href="#" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a> --}}
                                          {{-- <a href="#" class="btn btn-xs btn-success"><i class="fas fa-arrow-alt-circle-right"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                  </div>

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="assignroles">
                    <div class="col-md-5">
                      <p>Available user roles in this system :
                        @foreach ($roletypes as $roletype)
                            <span>{{ $roletype->name }} |</span>
                        @endforeach
                      </p>

                      <div class="card card-info">
                        <div class="card-header">Assign Roles to Users</div>
                        <div class="card-body">
                          <form action="{{ route('assignRole') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="userId">Select User</label>
                                <select name="userId" class="form-control">
                                  <option value="null">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                              <label for="roleId">Select Role</label>
                              <select name="roleId" class="form-control">
                                <option value="null">Select Role</option>
                                  @foreach ($roletypes as $roletype)
                                      <option value="{{ $roletype->id }}">{{ $roletype->name }}</option>
                                  @endforeach
                              </select>
                            </div>

                            <input type="submit" value="Assign Role" class="btn btn-primary float-right">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="assignpermissions">
                    Available user roles in this system :
                    <ul>
                      @foreach ($sysPermissions as $sysPermission)
                          <li>{{ $sysPermission->name }}</li>
                      @endforeach
                    </ul>
                      
                  </div>
                  <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->

            

        </div>
    </div>

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ session('message') }}
            </div>
        @endif

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #b5b5b5">
            {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> --}}
            <h5 class="modal-title" id="myModalLabel">Add New User</h5>
            </div>
            <form action="{{ route('users.store') }}" method="POST">
              @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name" autocomplete="off">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address" autocomplete="off">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </div>
                    
                <div class="modal-footer">
                    <button type="cancel" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
            
        </div>
        </div>
    </div>
    {{-- end modal --}}

    @section('tblScripts')
    <script>
      $(function () {
        $("#userList").DataTable({
          "responsive": true,
          "autoWidth": false,
        });
      });
    </script>
  @endsection

@endsection