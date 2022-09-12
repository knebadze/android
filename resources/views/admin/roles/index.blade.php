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
        @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}!
          </div>
        @endif


      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">როლების ცხრილი</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <div class="input-group-append">
                      {{-- <a  class=" p-3 bg-success bg-gradient rounded text-white">
                          <i class="fas fa-plus mr-1"></i> დაამატება
                      </a> --}}
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success rounded" data-toggle="modal" data-target="#modal-default">
                        <i class="fas fa-plus mr-1"></i> დაამატება
                      </button>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
              <table class="table table-head-fixed text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                            <div class="flex flex-d">
                            <a href="{{route('admin.roles.edit', $role->id)}}" class="edit p-1 text-white bg-success rounded"> <i class="nav-icon fas fa-pen"></i>Edit</a>
                            <form class="ml-1" method="POST" action="{{route('admin.roles.destroy', $role->id)}}"
                                onsubmit="return confirm('ნამდვილად გსურთ წაშლა');">
                                @csrf
                                @method('DELETE')
                                <button class="p-1 text-white bg-danger rounded" type="submit"><i class="nav-icon fas fa-trash"></i> წაშლა</button>
                            </form>
                        </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

</x-admin-layout>
