@extends('admin.navbar')

@section('content')

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
    // Shorthand for $( document ).ready()
        $(function() {

        //    $("#datatable").DataTable();

            
                   $('#datatable').DataTable( {
                        "serverSide": true,
                        "processing": true,
                        "ajax": {
                                url : "{{ url('newscategory/listdata') }}",
                                type:"GET"

                            //  "type": "POST",
                            //    "data":{ _token: "{{csrf_token()}}"}
                        }
                    } );

             
        });
</script>


<body class="hold-transition sidebar-mini">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="row">



                    <div class="col-6">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data"
                                action="{{ url('newscategory/created') }}">
                                @csrf
                                <input type="hidden" class="form-control" required name="category_id"
                                    value="<?= isset($data) ? $data->category_id : ''?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">News Category</label>
                                    <input type="text" class="form-control" required name="category"
                                        value="<?= isset($data) ?$data->category : ''?>">
                                </div>

                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>


                        </div>
                    </div>




                    <div class="col-6">

                        <div class="card-body">
                            <label>List Menu</label>
                            <table id="datatable" class="data display datatable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>kategory berita</th>
                                        <th>created by</th>
                                        <th>created at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>


                                </tbody>

                            </table>
                        </div>
                    </div>




                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    @endsection