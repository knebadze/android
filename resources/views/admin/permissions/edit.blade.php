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
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">ნებართვის დასახელების შეცვლა </h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <form id="quickForm" method="POST" action="{{route('admin.permissions.update',$permission)}}">
                        @csrf
                        @method('PUT')
                  <div class="card-body">
                    <div class="form-group">
                      <label for="name">ნებართვის დასახელება</label>
                      <input type="text" name="name" class="form-control" id="name" value="{{$permission->name}}">
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">განახლება</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </x-admin-layout>
