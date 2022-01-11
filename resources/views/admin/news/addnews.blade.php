@extends('admin.navbar')

@section('content')

<?php 

use App\libraries\imageloader;
$imageloader = new imageloader();

// dd($data);
?>

<head>

    <script type="text/javascript">
        var availableTags;

        // Shorthand for $( document ).ready()
        $(function() {
             $('#demo3').tagit({tagSource:availableTags, triggerKeys:['enter', 'comma', 'tab']});

             $('#demo3GetTags').click(function () {
                showTags()
                });
            $("#images").change(function(){
                readURL("imgItem", this);
            });

            function elFinderBrowser (callback, value, meta) {
            //console.log('tes');
                    tinymce.activeEditor.windowManager.open({
                    file: '{{ url ('news/imagemanager') }}',
                    title: 'Image Manager',
                    width: 700,
                    height: 400,
                    resizable: 'no'
                    }, {
                    oninsert: function (file) {
                    var url, reg, info;
                    console.log('tes');
                    // URL normalization
                    url = file.url;
                    reg = /\/[^/]+?\/\.\.\//;
                    while(url.match(reg)) {
                    url = url.replace(reg, '/');
                    }
            
            // Make file info
            info = file.name;
            
            // Provide image and alt text for the image dialog
            if (meta.filetype == 'image') {
            callback(url, {alt: info});
            }
            
            
            }
            });
            //tinymce.activeEditor.execCommand('mceImage');
            return false;
            }

            tinymce.init({
            selector: ".mceEditor",
            min_height: 300,
            relative_urls: false,
            remove_script_host: false,
            plugins: [
            "importcss advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
            ],
            
            toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
            toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
            toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl |  spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
            
            menubar: false,
            toolbar_items_size: 'small',
            
            style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ],
            file_picker_callback : elFinderBrowser,
            file_picker_types: 'image',
      
            
            templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
            ]
            
            
            
            });

        });

        function fSubmit(){
          // alert("masuj");
            with (document.formDetail){
                //nicEditors.findEditor('area1').saveContent();
                objTags = $('#demo3').tagit('tags');
                string = "";
                for (var i in objTags){
                    string += objTags[i].label + ";";
                }
                console.log(string);
               // alert(string);
                $('#tagit').val(string);
                    submit();
                }
            }
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

                            @if (isset($data->news_id))
                            <h3 class="card-title">Edit news</h3>
                            @else
                            <h3 class="card-title">Add news</h3>
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


                            {{-- jika user baru --}}
                            <form class="form" action="{{ url('/addnews') }}" method="post" name="formDetail"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="news_id" value="{{ isset($data) ? $data->news_id:''}}">
                                <input type="hidden" id="tagit" name="tagit" value="" />
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News Type</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="status" name="news_type">

                                            <?php
                                            $arrdata = [
                                                'News' => 'News',
                                                'Blog' => 'Blog'
                                            ];

                                            $selected="";

                                            foreach ($arrdata as $key => $item) {
                                                if (isset($data)){
                                                    $selected=($data->news_level==$key) ? 'selected' :'';
                                                }
                                                ?>
                                            <option value={{$key}} {{$selected}}>{{$item}}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News category</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="news_category" name="news_category">

                                            @php
                                            $selected="";
                                            @endphp
                                            @foreach ($newscategory as $category )
                                            <?php
                                                if (isset($data)){
                                                    $selected=($data->news_category_id==$category->category_id) ? 'selected' :'';
                                                }
                                            ?>
                                            <option value={{$category->category_id}} {{$selected}}>
                                                {{$category->category}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News Level</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="status" name="news_level">

                                            <?php
                                            $arrdata = [
                                                '0' => 'OFF',
                                                '1' => '1',
                                                '2' => '2'
                                            ];

                                            $selected="";

                                            foreach ($arrdata as $key => $item) {
                                                if (isset($data)){
                                                    $selected=($data->news_level==$key) ? 'selected' :'';
                                                }
                                                ?>
                                            <option value="<?=$key?>" <?=$selected?> > <?=$item?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="title" class="form-control" id="title"
                                            value="{{ isset($data) ? $data->news_title:''}}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-2">

                                    </div>
                                    <div class="col-sm-8">
                                        <img src="{{$imageloader->fCheckImage(isset($data->news_img) ? $data->news_img:'') }}"
                                            alt="..." class="img-thumbnail fa fa-user" style="height:200px;"
                                            id="imgItem">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Images</label>
                                    <div class="col-sm-6">
                                        <input type="file" name="image" class="form-control" id="images">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News Tag</label>
                                    <div class="col-sm-6">
                                        <ul id="demo3">
                                            <li>Tags News 1</li>
                                            <li>Tags News 2</li>
                                            <li>Tags News 3</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News Synopsys</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="synopsys"
                                            rows="3">{{ isset($data) ? $data->news_synopsys:''}}</textarea>
                                    </div>
                                </div>
                                <div class=" form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Title</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ isset($data) ? $data->news_title:''}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Meta Description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="news_metadescription"
                                            rows="3">{{ isset($data) ? $data->news_description:''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News Content</label>
                                    <div class="col-sm-8">
                                        <textarea class="mceEditor" name="news_content"
                                            rows="3">{{ isset($data) ? $data->news_content:''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">News Status</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" id="status" name="status">
                                            <?php
                                            $arrdata = [
                                                '1' => 'Publish',
                                                '0' => 'Draft'
                                            ];

                                            $selected="";

                                            foreach ($arrdata as $key => $item) {
                                                if (isset($data)){
                                                    $selected=($data->is_active==$key) ? 'selected' :'';
                                                }
                                                ?>
                                            <option value={{$key}} {{$selected}}>{{$item}}</option>
                                            <?php } ?>


                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Publish Date</label>
                                    <div class="col-sm-3">
                                    <input type="date" name="publish_date" class="form-control"
                                            value="{{ isset($data) ? date('Y-m-d',strtotime($data->publish_date)):''}}">
                                    </div>
                                </div>




                                <div class="form-group">


                                    <button type="submit" class="btn btn-md btn-primary"
                                        onClick="fSubmit();">Submit</button>


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

    <script>


    </script>