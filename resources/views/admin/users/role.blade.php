<x-admin-layout>

    <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Simple Tables</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
        </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

         <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div>იუზერის სახელი: {{$user->name}}</div>
                <div>იუზერის ემაილ: {{$user->email}}</div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-12">
                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('message')}}!
                  </div>
                @endif
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">ნებართვის მინიჭება</h3>
                  </div>
                  <div class="mt-4 ml-3 flex flex-d">
                    @if ($role->permissions)
                        @foreach ($role->permissions as $role_permission)
                            <form class="ml-1" method="POST" action="{{route('admin.roles.permissions.revoke', [$role->id, $role_permission->id])}}"
                                onsubmit="return confirm('ნამდვილად გსურთ წაშლა');">
                                @csrf
                                @method('DELETE')
                                <button class="p-2 bg-info text-white ml-2 rounded" type="submit"><i class="nav-icon fas fa-trash"></i> {{$role_permission->name}}</button>
                            </form>
                        @endforeach

                    @endif
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                      <form id="quickForm" method="POST" action="{{route('admin.roles.permissions',$role)}}">
                          @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">ნებართვა</label>
                        <select class="form-control" name="permission" id="">
                            <option value="">აირჩიე ნებართვა</option>
                            @foreach ($permissions as $permission)
                            <option value="{{$permission->name}}">{{$permission->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">შენახვა</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
            </div>
              <!--/.col (left) -->

            <div class="col-md-12">
                @if (Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('message')}}!
                </div>
                @endif
                <!-- jquery validation -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">როლის მინიჭება</h3>
                  </div>
                  <div class="mt-4 ml-3 flex flex-d">
                    @if ($permission->roles)
                        @foreach ($permission->roles as $permission_role)
                            <form class="ml-1" method="POST" action="{{route('admin.permissions.roles.remove', [$permission->id, $permission_role->id])}}"
                                onsubmit="return confirm('ნამდვილად გსურთ წაშლა');">
                                @csrf
                                @method('DELETE')
                                <button class="p-2 bg-info text-white ml-2 rounded" type="submit"><i class="nav-icon fas fa-trash"></i> {{$permission_role->name}}</button>
                            </form>
                        @endforeach

                    @endif
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                      <form id="quickForm" method="POST" action="{{route('admin.permissions.role',$permission->id)}}">
                          @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label for="name">როლები</label>
                        <select class="form-control" name="role" id="">
                            <option value="">აირჩიე როლი</option>
                            @foreach ($roles as $role)
                            <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">შენახვა</button>
                    </div>
                  </form>
                </div>
                <!-- /.card -->
            </div>

            </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
      <!-- /.content -->

</x-admin-layout>
