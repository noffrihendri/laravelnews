<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="style.css"> --}}

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
    <title>Document</title>
</head>


<style>
    .hidden {
        display: none;
    }

    .highlight {
        background-color: #eee;
        font-size: 1.2em;
        margin: 0 0 30px 0;
        padding: 0.2em 1.5em;
    }

    .warning {
        color: red;
        font-weight: 400;
    }

    @media screen and (min-width: 1000px) {

        /* hack! to detect non-touch devices */
        div#links a {
            line-height: 0.8em;
        }
    }

    audio {
        max-width: 100%;
    }

    body {
        font-family: 'Roboto', sans-serif;
        font-weight: 300;
        margin: 0;
        padding: 1em;
        word-break: break-word;
    }

    button {
        min-width: 120px;
        background-color: #d84a38;
        border: none;
        border-radius: 2px;
        color: white;
        font-family: 'Roboto', sans-serif;
        font-size: 0.8em;
        margin: 0 0 1em 0;
        padding: 0.5em 0.7em 0.6em 0.7em;
    }

    button:active {
        background-color: #cf402f;
    }

    button:hover {
        background-color: #cf402f;
    }

    button[disabled] {
        color: #ccc;
    }

    button[disabled]:hover {
        background-color: #d84a38;
    }

    canvas {
        background-color: #ccc;
        max-width: 100%;
        width: 100%;
    }

    code {
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
    }

    div#container {
        margin: 0 auto 0 auto;
        max-width: 60em;
        padding: 1em 1.5em 1.3em 1.5em;
    }

    div#links {
        padding: 0.5em 0 0 0;
    }

    h1 {
        border-bottom: 1px solid #ccc;
        font-family: 'Roboto', sans-serif;
        font-weight: 500;
        margin: 0 0 0.8em 0;
        padding: 0 0 0.2em 0;
    }

    h2 {
        color: #444;
        font-weight: 500;
    }

    h3 {
        border-top: 1px solid #eee;
        color: #666;
        font-weight: 500;
        margin: 10px 0 10px 0;
        white-space: nowrap;
    }

    li {
        margin: 0 0 0.4em 0;
    }

    html {
        /* avoid annoying page width change
    when moving from the home page */
        overflow-y: scroll;
    }

    img {
        border: none;
        max-width: 100%;
    }

    input[type=radio] {
        position: relative;
        top: -1px;
    }

    p {
        color: #444;
        font-weight: 300;
    }

    p#data {
        border-top: 1px dotted #666;
        font-family: Courier New, monospace;
        line-height: 1.3em;
        max-height: 1000px;
        overflow-y: auto;
        padding: 1em 0 0 0;
    }

    p.borderBelow {
        border-bottom: 1px solid #aaa;
        padding: 0 0 20px 0;
    }

    section p:last-of-type {
        margin: 0;
    }

    section {
        border-bottom: 1px solid #eee;
        margin: 0 0 30px 0;
        padding: 0 0 20px 0;
    }

    section:last-of-type {
        border-bottom: none;
        padding: 0 0 1em 0;
    }

    select {
        margin: 0 1em 1em 0;
        position: relative;
        top: -1px;
    }

    h1 span {
        white-space: nowrap;
    }

    a {
        color: #1D6EEE;
        font-weight: 300;
        text-decoration: none;
    }

    h1 a {
        font-weight: 300;
        margin: 0 10px 0 0;
        white-space: nowrap;
    }

    a:hover {
        color: #3d85c6;
        text-decoration: underline;
    }

    a#viewSource {
        display: block;
        margin: 1.3em 0 0 0;
        border-top: 1px solid #999;
        padding: 1em 0 0 0;
    }

    div#errorMsg p {
        color: #F00;
    }

    div#links a {
        display: block;
        line-height: 1.3em;
        margin: 0 0 1.5em 0;
    }

    div.outputSelector {
        margin: -1.3em 0 2em 0;
    }

    p.description {
        margin: 0 0 0.5em 0;
    }

    strong {
        font-weight: 500;
    }

    textarea {
        resize: none;
        font-family: 'Roboto', sans-serif;
    }

    video {
        background: #222;
        margin: 0 0 20px 0;
        --width: 100%;
        width: var(--width);
        /* height: calc(var(--width) * 0.75); */
        height: calc(var(--width) * 4.75);
    }

    ul {
        margin: 0 0 0.5em 0;
    }

    @media screen and (max-width: 650px) {
        .highlight {
            font-size: 1em;
            margin: 0 0 20px 0;
            padding: 0.2em 1em;
        }

        h1 {
            font-size: 24px;
        }
    }

    @media screen and (max-width: 550px) {
        button:active {
            background-color: darkRed;
        }

        h1 {
            font-size: 22px;
        }
    }

    @media screen and (max-width: 450px) {
        h1 {
            font-size: 20px;
        }
    }
</style>

<body>
    <div class="display-cover">
        <div class="video-options" hidden>
            <select name="" id="" class="custom-select">
                <option value="">Select camera</option>
            </select>
        </div>
        <video autoplay></video>
        <canvas class="d-none"></canvas>



        <img class="screenshot-image d-none" alt="">

        <div class="controls">
            <button class="btn btn-danger play d-none" title="Play"><i data-feather="play-circle"></i></button>
            <button class="btn btn-info pause d-none" title="Pause"><i data-feather="pause"></i></button>
            <button class="btn btn-info screenshot " title="ScreenShot" id="ScreenShot"><span
                    class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                    id="spinerreguler"></span></i> Ambil
                Gambar</button>

            <div class="row">
                <div class="col-6">
                    <button class="btn btn-info repicture d-none" title="repicture" id="repicture"><span
                            class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                            id="spinerreguler2"></span></i> Foto
                        Ulang</button>
                </div>
                <div class="col-6">

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-info oke d-none" title="oke" id="oke"><span
                                class="spinner-border spinner-border-sm" role="status" aria-hidden="true"
                                id="spineroke"></span></i>
                            Oke</button>
                    </div>

                </div>


            </div>

        </div>


    </div>

    <script src="https://unpkg.com/feather-icons"></script>
    {{-- <script src="script.js"></script> --}}
</body>

</html>

<script>
    $(function() {
        $('#spinerreguler').hide();
        $('#spineroke').hide();
        $('#spinerreguler2').hide();

        $('canvas').hide();
        $('#repicture').hide();
      
        play.click();
        
        });

    ///https://www.digitalocean.com/community/tutorials/front-and-rear-camera-access-with-javascripts-getusermedia-id
    feather.replace();
    
    const controls = document.querySelector('.controls');
    const cameraOptions = document.querySelector('.video-options>select');
    const video = window.canvas = document.querySelector('video');
    const canvas = document.querySelector('canvas');
    const screenshotImage = document.querySelector('img');
    const buttons = [...controls.querySelectorAll('button')];
    const ulangifoto = document.getElementById('repicture');
    let streamStarted = false;
    
    const [play, pause, screenshot, repicture, oke] = buttons;

    let frontcamera = true;
    
    const constraints = {
        audio: false,
    video: {
        //facingMode: 'environment',
        // width: {
        // min: 1280,
        // ideal: 1920,
        // max: 2560,
        // },
        // height: {
        //    // min:1440,
        //     min: 720,
        //     ideal: 1080,
        //     max: 1440
        //  },

        // width: { min: 540, max: 540 },
        // height: { min: 960, max: 960},
         
         width: { min: 270, max: 270 },
         height: { min: 320, max: 320},
         //facingMode: { exact: "environment" }
        //  facingMode: 'user'
         facingMode: (frontcamera? "user" : "environment")
        }
    };
  
    // const stopStream = (stream) => {
    //     console.log("halo");
     
    //         stream.getTracks().forEach( (track) => {
    //         track.stop();
    //      });
    //     console.log(video)
    // };
    
    const getCameraSelection = async () => {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices.filter(device => device.kind === 'videoinput');
        const options = videoDevices.map(videoDevice => {
        return `<option value="${videoDevice.deviceId}">${videoDevice.label}</option>`;
    });
    cameraOptions.innerHTML = options.join('');
    };
    
    play.onclick = () => {
        if (streamStarted) {
            video.play();
            //play.classList.add('d-none');
          //  pause.classList.remove('d-none');
             return;
         }
        if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
            const updatedConstraints = {
            ...constraints,
            deviceId: {
            exact: cameraOptions.value
        }
        };
        startStream(updatedConstraints);
        }
    };
   
    const startStream = async (constraints) => {
        //const stream = await navigator.mediaDevices.getUserMedia(constraints);

        await navigator.mediaDevices.getUserMedia(constraints).then(
            handleStream
        ).catch(
        //handleError
        );
        // handleStream(stream);
    };
    
    const handleStream = (stream) => {
        window.stream = stream;
        video.srcObject = stream;
    //    play.classList.add('d-none');
  //      pause.classList.remove('d-none');
        // screenshot.classList.remove('d-none');
        streamStarted = true;
    };
    
    getCameraSelection();

    cameraOptions.onchange = () => {
        const updatedConstraints = {
        ...constraints,
        deviceId: {
             exact: cameraOptions.value
        }
        };
        startStream(updatedConstraints);
    };
    
    const pauseStream = () => {
            video.pause();
           // play.classList.remove('d-none');
         //   pause.classList.add('d-none');
    };
    
    const doScreenshot = () => {


        $('#spinerreguler').show();
     
       setTimeout(function(){
           $('#spinerreguler').hide();
           $('#ScreenShot').hide();
           $('#repicture').show();
           $('video').hide();
           $('canvas').show();
           ulangifoto.classList.remove('d-none');
           canvas.classList.remove('d-none');
           oke.classList.remove('d-none');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            // screenshotImage.src = canvas.toDataURL('image/webp');
            screenshotImage.classList.remove('d-none');
           
        }, 2000);



    };

    const stopstream = () => {
        stream.getTracks().forEach( (track) => {
        track.stop();
        //console.log(track);
        });

        $('#spineroke').show();
        $("#oke").attr("disabled", true);


        var data = canvas.toDataURL('image/png');

       // console.log(data);

        let dataarray = {
            'img' : data
        };
        
        fetch("{{ url('wrt') }}",{
            method : 'POST',
            headers : {
            'Content-type' : 'application/json'
            },
             body : JSON.stringify(dataarray)
        }
        )
        .then(res => res.json())
        .then(function(data) {
            //console.log("responese",response)
            if(data.valid){
                $('#spineroke').hide();
                alert("berhasil disimpan");
            }
        })
        .catch(err => console.log(err));
        $("#oke").attr("disabled", false);
     
    };

    
    const takeulang = () => {
        $('#spinerreguler2').show();
       
        setTimeout(function(){
            ulangifoto.classList.add('d-none');
            oke.classList.add('d-none');
            $('#ScreenShot').show();
            $('#spinerreguler2').hide();
            canvas.classList.add('d-none');
            $('video').show();
            play.click();
            screenshotImage.classList.add('d-none');
            
        }, 2000);
        
    };


 
    
    pause.onclick = pauseStream;
    screenshot.onclick = doScreenshot;
    repicture.onclick = takeulang;
    oke.onclick = stopstream;




</script>