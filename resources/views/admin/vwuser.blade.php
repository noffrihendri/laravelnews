

@extends('admin.navbar')

@section('content')




<body class="hold-transition sidebar-mini">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List User</h3>
              </div>

              <div class="card-header">
                <a type="button" href="{{ url('/adduser') }}" class="btn btn-primary">tambah User</a>


            </div>

 <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">



            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
             @endif


            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Akses</th>
                  <th>Created Date</th>

                  <th>Action</th>
                </tr>
                </thead>


                <tbody>

                            @foreach ($user as $value)
                                <tr>
                                    <td>{{ $value->name}}</td>
                                    <td>{{ $value->email}}</td>
                                    <td>{{ $value->role_name}}</td>
                                    <td>{{ $value->created_at}}</td>
                                    <td>
                                        <a type="button" href="{{ url('/edituser/'.$value->id) }}" class="btn btn-primary">Edit</a>
                                        <a type="button" href="{{ url('/deleteuser/'.$value->id) }}" class="btn btn-danger">Delete</a>

                                    </td>

                                </tr>

                            @endforeach

            </tbody>

            </table>
            </div>







             </div>
             <!-- /.card -->


          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
@endsection
