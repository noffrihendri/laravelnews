<!DOCTYPE html>
<!--
 *  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a BSD-style license
 *  that can be found in the LICENSE file in the root of the source
 *  tree.
-->
<html>

<head>

    <meta charset="utf-8">
    <meta name="description" content="WebRTC code samples">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1">
    <meta itemprop="description" content="Client-side WebRTC code samples">

    <meta itemprop="name" content="WebRTC code samples">
    <meta name="mobile-web-app-capable" content="yes">
    <meta id="theme-color" name="theme-color" content="#ffffff">

    <base target="_blank">

    <title>getUserMedia to canvas</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{asset('admin-lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">

    <link rel="stylesheet" href="{{asset('admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-lte/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin-lte/plugins/summernote/summernote-bs4.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="{{asset('jquery/jquery-3.5.1.min.js')}}"></script>


    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('wrtcamera/src/css/main.css') }}">

</head>

<body>

    <div id="container">


        <video playsinline autoplay></video>
        <button id="takepicture"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Take
            snapshot</button>
        <canvas></canvas>

        <button id="clear"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Take
            Ulang</button>




    </div>

    <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script>
    {{-- <script src="{{ asset('wrtcamera/src/content/getusermedia/canvas/js/main.js') }} " async></script> --}}
    <script src="{{ asset('wrtcamera/src/js/lib/ga.js') }}"></script>

</body>

</html>

<script>
    'use strict';
    
    // Put variables in global scope to make them available to the browser console.
    const video = document.querySelector('video');
    const canvas = window.canvas = document.querySelector('canvas');
    canvas.width = 480;
    canvas.height = 360;
    
    const button = document.getElementById('takepicture');
    button.onclick = function() {
        console.log("halo");
        $('.spinner-border').show();

        setTimeout(function(){ 
          takepicture()
            stream.getTracks().forEach( (track) => {
                track.stop();
                });

         }, 2000);
          
    };


    const constraints = {
    audio: false,
    video: true
    };
    
    function handleSuccess(stream) {
    window.stream = stream; // make stream available to browser console
    video.srcObject = stream;
    }
    
    function handleError(error) {
    console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
    }
    
    navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);


    $(function() {
        $('.spinner-border').hide();
        $('canvas').hide();
        $('#clear').hide();
    
    
    });
    $( "#clear" ).click(function(e) {
        e.preventDefault();
        $('canvas').hide();
        $('video').show();
    });


    function takepicture(stream){
        // stream.getTracks().forEach(function(track) {
        // if (track.readyState == 'live' && track.kind === 'video') {
        // track.stop();
        // }
        // });
        
        $('video').hide();
        $('canvas').show();
        $('#takepicture').hide();
        $('.spinner-border').hide();
        $('#clear').show();
        
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

   
    }


</script>