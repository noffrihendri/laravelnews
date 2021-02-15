
@extends('admin.themeadmin')


<head>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        // Shorthand for $( document ).ready()
        $(function() {

            $("#example2").DataTable();
        });
    </script>

    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="_token" content="{{csrf_token()}}" />

</head>

<script type="text/javascript">
$(document).ready( function () {




} );

</script>



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
                <h3 class="card-title">List brand product</h3>
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



                            <button type="button" class="btn btn-primary" id="tambahbrand">Tambah Sub brand</button>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>

                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="modalsbrand">
                                        <input type="text" class="form-control" id="id_subbrand" hidden>
                                        <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Sub Brand Product:</label>
                                        <select id="brand" class="form-control" name="brand">

                                            @foreach ($brand as $record)

                                            <option value="{{ $record->id_brand }}">{{ $record->brand_name }}</option>

                                            @endforeach

                                        </select>
                                </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Brand Product:</label>
                                        <input type="text" class="form-control" id="subbrand" name="subbrand">
                                    </div>


                                </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">save</button>
                                    </div>
                                </div>

                            </form>
                            </div>
                            </div>
                        </div>
              <table id="datatable" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
                  <th>Brand_name</th>
                  <th>Sub Brand</th>
                  <th>Created_at</th>
                  <th>Action</th>
                </tr>
                </thead>


                <tbody>


            </tbody>

            </table>


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


<script>
    $(function(){
        var table = $('#datatable').DataTable( {
            "serverSide": true,
            "processing": true,
            "ajax": {
                    url : "{{ url('listdatasubbrand') }}",
                    type:"GET"

                  //  "type": "POST",
                //    "data":{ _token: "{{csrf_token()}}"}
            }
        } );


        $('#modalsbrand').submit(function(e){
            e.preventDefault();

           // ajax request header setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            var id = $("#id_subbrand").val();
            var subbrand = $("#subbrand").val();
            var brand = $("#brand").val();
            console.log(id);
            console.log(subbrand);
            console.log(brand);


            $.ajax({
                type: "POST",
                url: "{{ url('savesubbrand') }}",
                dataType:"JSON",
                data: { subbrand:subbrand, brand:brand, id:id},
                success: function(data){

                    if(data.valid){
                        alert(data.message);
                        table.ajax.reload();
                        $("#exampleModal").modal('toggle');
                    }

                 }

        });

        });

        $("#tambahbrand").click(function(){
            $('#id_brand').val("");
            $('#brand').val("");
            $("#exampleModal").modal('toggle');
        });



    });


    function editbrand(id){

        $.ajax({
            type: "GET",
            url: "{{ url('updatesubsbrand') }}",
            dataType:"JSON",
            data: {id:id},
            success: function(data){
                if(data.valid){
                    $("#id_subbrand").val(data.message.id_subsbrand);
                    $("#brand").val(data.message.id_brand).trigger('change');
                 //   $('#brand').val(data.message.brand_name);
                    $('#subbrand').val(data.message.subsbrand_name);
                    $("#exampleModal").modal('toggle');
                }

            }

        });
    };



</script>
