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
                            <h3 class="card-title">List news</h3>
                        </div>

                        <div class="card-header">
                            <a type="button" href="{{ url('/addnews') }}" class="btn btn-primary">addnews</a>


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
                                <table id="datatable" class="table table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>news title</th>
                                            <th>news synopsys</th>
                                            <th>news img</th>
                                            <th>Created Date</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>



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
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        $(function(){
        var table = $('#datatable').DataTable( {
                "serverSide": true,
                "processing": true,
                "ajax": {
                url : "{{ url('newsdata') }}",
                type:"GET"
                
                // "type": "POST",
                // "data":{ _token: "{{csrf_token()}}"}
                }
                } );

        });


    </script>