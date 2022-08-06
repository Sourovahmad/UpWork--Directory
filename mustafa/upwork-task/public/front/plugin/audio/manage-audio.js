$(document).ready(function () {

    // config ..
    let url_main = $("meta[name=url-base]").attr("content");
    let recorder, audio_stream;
    let blob;

    function startRecording() {
        navigator.mediaDevices.getUserMedia({audio: true})
                .then(function (stream) {
                    audio_stream = stream;
                    recorder = new MediaRecorder(stream);

                    // when there is data, compile into object for preview src
                    recorder.ondataavailable = function (e) {
                        blob = e.data;
                        const url = URL.createObjectURL(e.data);
//                        preview.src = url;
//                        
//                        

                        $("#audio-playback").attr("src", url);
                        // set link href as blob url, replaced instantly if re-recorded
                      //  downloadAudio.href = url;
                    };
                    recorder.start();

                    timeout_status = setTimeout(function () {
                        console.log("5 min timeout");
                        stopRecording();
                    }, 300000);
                });
    }



    function stopRecording() {
        recorder.stop();
        audio_stream.getAudioTracks()[0].stop();
  var fd = new FormData();
   fd.append('file', blob); 
  $.ajax({
         type: 'POST',
         url: url_main+'/chat/audio',
         data: fd,
         processData: false,
         contentType: false
         }).done(function (data) {
         console.log(data);
         });

/*
        var filename = new Date().toISOString();
        var xhr = new XMLHttpRequest();
        xhr.onload = function (e) {
            if (this.readyState === 4) {
                console.log("Server returned: ", e.target.responseText);
            }
        };
        var fd = new FormData();
        fd.append("file", blob);
        xhr.open("POST", url_main+"/chat/audio", true);
        xhr.send(fd);
        */

        /*
         recorder.exportWAV(function (audio) {
         var fd = new FormData();
         fd.append('filename', 'test.wav');
         fd.append('file', audio); 
         $.ajax({
         type: 'POST',
         url: url_main+'/chat/audio',
         data: fd,
         processData: false,
         contentType: false
         }).done(function (data) {
         console.log(data);
         });
         });
         * 
         */
    }

    function upload() {

    }

    $(document).on("click", ".audio_record", function () {
        $(this).addClass("d-none");
        $(".audio_stop").removeClass("d-none");
        startRecording()
    }
    );

    $(document).on("click", ".audio_stop", function () {
        $(this).addClass("d-none");
        $(".audio_record").removeClass("d-none");
        stopRecording()
    });

});