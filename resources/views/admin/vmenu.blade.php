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
                                url : "{{ url('moduledata') }}",
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
                            <form method="post" enctype="multipart/form-data" action="{{ url('/savemodule') }}">
                                @csrf
                                <input type="hidden" class="form-control" required name="menu_id"
                                    value="<?= isset($data) ? $data->menu_id : ''?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" required name="title"
                                        value="<?= isset($data) ?$data->title : ''?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Link</label>
                                    <input type="text" class="form-control" name="link"
                                        value="<?= isset($data) ?$data->link : ''?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Icon</label>
                                    <input type="text" class="form-control" name="icon"
                                        value="<?= isset($data) ?$data->icon : ''?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Parent / Submenu</label>
                                    <select class="form-control" name="parent" required>
                                        <option value="parent">PARENT</option>
                                        @foreach ($menu as $item)
                                        @php
                                        $selected="";
                                        @endphp
                                        @if (isset($data))
                                        @if ($item->menu_id == $data->parentid)
                                        @php
                                        $selected="selected";
                                        @endphp
                                        @endif
                                        @endif
                                        <option value="<?=$item->menu_id?>" {{ $selected }}><?=$item->title?></option>
                                        @endforeach

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>


                        </div>
                    </div>




                    <div class="col-6">

                        <div class="card-body">
                            <label>List Menu</label>
                            <table id="datatable" class="table table-bordered table-hover datatable">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Icon</th>
                                        <th>parent</th>

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