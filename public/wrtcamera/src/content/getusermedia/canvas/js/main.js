/*
 *  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a BSD-style license
 *  that can be found in the LICENSE file in the root of the source
 *  tree.
 */

'use strict';

// Put variables in global scope to make them available to the browser console.
const video = document.querySelector('video');
const canvas = window.canvas = document.querySelector('canvas');
canvas.width = 480;
canvas.height = 360;

const button = document.querySelector('button');
button.onclick = function() {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;

  canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);



   var context = canvas.getContext('2d'); 
   canvas.width = width;
    canvas.height = height;
    context.drawImage(video, 0, 0, width, height);

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
      console.log("coba");
  console.log(data);

};

const constraints = {
  audio: false,
  video: true
};

function handleSuccess(stream) {
  console.log('error',stream);
  window.stream = stream; // make stream available to browser console
  video.srcObject = stream;
}

function handleError(error) {
  console.log('navigator.MediaDevices.getUserMedia error: ', error.message, error.name);
}

navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);

// navigator.mediaDevices.getUserMedia(constraints)
// .then(function(stream) {
//   /* use the stream */
//   handleSuccess
// })
// .catch(function(err) {
//   console.log('error',err);
// })
