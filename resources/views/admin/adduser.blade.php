

@extends('admin.navbar')

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        // Shorthand for $( document ).ready()
        $(function() {

            $("#example2").DataTable();


                $("#images").change(function(){

                    readURL("imgItem", this);
            });

        });
    </script>
</head>


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

                @if (isset($user->id))
                <h3 class="card-title">Edit user</h3>
                @else
                 <h3 class="card-title">Add user</h3>
                @endif


              </div>
              <div class="card-header">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ ($message) }}</strong>
                </div>
            @endif

                @if (isset($user->id))
                    {{-- jika update user  --}}
                    <form class="form" action="{{ url('/edituser/'.$user->id) }}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                @else
                        {{-- jika user baru --}}
                     <form class="form" action="{{ url('/adduser') }}" method="post" enctype="multipart/form-data">
                @endif

                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-2">

                    </div>
                    <div class="col-sm-8">
                        <img src="{{ ( isset($user->image) && ($user->image !== "")) ? url($user->image) : url ('/image/noimage.jpg') }}" alt="..." class="img-thumbnail fa fa-user"
                        style="height:200px;" id="imgItem">
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">Profile</label>
                    <div class="col-sm-6">
                      <input type="file" name="image" class="form-control"  id="images" 
                      value="{{ isset($user->image) ? $user->image :'' }}"
                      >
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">username</label>
                    <div class="col-sm-6">
                      <input type="name" name="name" class="form-control" id="colFormLabel" required
                      value="{{ isset($user->name) ? $user->name :'' }}"
                      >
                    </div>
                  </div>
                <div class="form-group row">
                  <label for="colFormLabel" class="col-sm-2 col-form-label">email</label>
                  <div class="col-sm-6">
                    <input type="email" name="email" class="form-control" id="colFormLabel" required
                    value="{{ isset($user->email) ? $user->email :'' }}" >
                  </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">password</label>
                    <div class="col-sm-6">
                      <input type="password" name="password" class="form-control" id="colFormLabel" required >
                      <span class="help-block">{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">ulangi password</label>
                    <div class="col-sm-6">
                      <input type="password" name="password_confirmation" class="form-control" id="colFormLabel" required >
                      <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabel" class="col-sm-2 col-form-label">role</label>
                    <div class="col-sm-6">
                    <select id="role" class="form-control" name="role" required>
                      <option>Choose...</option>
                      
                      @foreach ($role as $item)
                        @php
                            $selected="";
                         @endphp
                         @if (isset($user->role))
                                    @if ($item->role_id == $user->role)
                                        @php
                                        $selected="selected";
                                        @endphp
                                    @endif
                         @endif

                         <option value="{{ $item->role_id }}" {{ $selected }}>{{$item->role_name}}</option>
                      @endforeach


                    </select>
                    </div>
                  </div>


                    <div class="form-group">

                        @if (isset($user->id))
                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                        @else
                             <button type="submit" class="btn btn-md btn-primary">Submit</button>
                        @endif


                        <button type="reset" class="btn btn-md btn-danger">Cancel</button>
                    </div>


              </form>


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
