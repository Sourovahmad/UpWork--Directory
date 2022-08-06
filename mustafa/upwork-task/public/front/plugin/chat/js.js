$(document).ready(function () {

    // config ..
    let url_main = $("meta[name=url-base]").attr("content");
    let recorder, audio_stream;
    let blob;
    let chunks = [];
    let src_img = "";

    setInterval(function () {
        chat();
    }, 20000);

    function chat() {

        var fd = "sender=" + $("input[name=receiver]").val();

        $.ajax({
            type: "POST",
            url: url_main + "/chat/get",
            cache: true,
            data: fd,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $(".chat_area").append(data["data"]);
            },
            error: function (error) {}
        });

    }

    $('.search_friends').keyup(function () {

        var searchText = $(this).val();

        $('.list_menu_chat > .friends_li').each(function () {

            var currentLiText = $(this).find(".friends_txt").text(),
                    showCurrentLi = currentLiText.indexOf(searchText) !== -1;

            $(this).toggle(showCurrentLi);

        });
    });

    $(document).on("click", ".btn_chat_file", function () {
        $(this).parent().find("input[type=file]").trigger('click');
    });

    $(document).on("change", "input[type=file]", function () {
        var src = URL.createObjectURL(event.target.files[0]);
        src_img = src;
        $(".wrap_chat_images_process .chat_images_process").html("<img src='" + src + "' />");
        $(".wrap_chat_images_process").removeClass("d-none");
        $(".btn_chat_file , .audio_record").addClass("d-none");
        $(".chat_send").removeClass("d-none");
        $("#form_chat input[name=type]").val(2);
    });

    $(document).on("click", ".close_chat_images_process", function () {
        $(".wrap_chat_images_process .chat_images_process").html("");
        $(".wrap_chat_images_process").addClass("d-none");
        $(".btn_chat_file , .audio_record").removeClass("d-none");
        $(".chat_send").addClass("d-none");
        $(".wrap_chat_file").html('<input  type="file" name="chat_file" id="files" />');
        $("#form_chat input[name=type]").val(1);
    });

    function startRecording() {


        navigator.mediaDevices.getUserMedia({audio: true})
                .then(function (stream) {
                    audio_stream = stream;
                    recorder = new MediaRecorder(stream);
                    $(".textarea_chat").addClass("d-none");
                    $(".chat_audio_content").html('<p class="mt-2 mb-1">جاري تسجيل المقطع الصوتي ..</p>');
                    $(".btn_chat_file").addClass("d-none");
                    $(".chat_audio").removeClass("d-none");

                    // when there is data, compile into object for preview src
                    recorder.ondataavailable = function (e) {


                        chunks.push(e.data);
                        blob = e.data;
//                        console.log(blob);
                        const url = URL.createObjectURL(blob);
                        $(".chat_audio_content").html('<audio id="audio_recorded" src="' + url + '" controls ></audio>');

                        var audio_recorded = document.getElementById("audio_recorded");
//                        audio_recorded.currentTime = time_audio;
                        audio_recorded.duration;


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

        blob = new Blob(chunks, {'type': 'audio/ogg; codecs=opus'});
        chunks = [];





//console.log(chunks);   


        $(".close_audio").removeClass("d-none");
        $(".chat_send").removeClass("d-none");
        $("#form_chat input[name=type]").val(3);
    }

    function upload_audio() {
        recorder.stop();
        audio_stream.getAudioTracks()[0].stop();

        var fd = new FormData();
        fd.append('file', blob);
        $.ajax({
            type: 'POST',
            url: url_main + '/chat/audio',
            data: fd,
            processData: false,
            contentType: false
        }).done(function (data) {
            console.log(data);
        });

        var fd = new FormData();
        fd.append('file', blob);
        $.ajax({
            type: 'POST',
            url: url_main + '/chat/audio',
            data: fd,
            processData: false,
            contentType: false
        }).done(function (data) {
            console.log(data);
        });

    }

    $(document).on("click", ".audio_record", function () {
        $(this).addClass("d-none");
        $(".audio_stop").removeClass("d-none");
        startRecording();
    });

    $(document).on("click", ".audio_stop", function () {
        $(this).addClass("d-none");
//        $(".audio_record").removeClass("d-none");
        stopRecording();
    });

    $(document).on("click", ".close_audio", function () {
        $(this).addClass("d-none");
        $(".chat_send , .chat_audio").addClass("d-none");
        $(".audio_record , .btn_chat_file , .textarea_chat").removeClass("d-none");
        $(".chat_audio_content").html("");
        $("#form_chat input[name=type]").val(1);
        return false;
    });


    // check press space ..
    $(document).on("keypress", "[name='message']", function (e) {
        var v = $(this).val();
        if (v == "" && e.keyCode == 32) {
            return false
        }
    });


    $(document).on("keyup", "[name='message']", function () {
        var v = $(this).val();
        if (v.length > 0) {
            $(".audio_record").addClass("d-none");
            $(".chat_send").removeClass("d-none");
        } else {
            $(".audio_record").removeClass("d-none");
            $(".chat_send").addClass("d-none");
        }
    });

    $(document).on("click", ".chat_send", function () {

        var fd = new FormData();
        var f = $("#form_chat");
        var msg = f.find("[name='message']").val();
        var type = f.find("[name=type]").val();

//        var data = f.serialize();
        fd.append('message', msg);
        fd.append('type', type);
        $.each(f.serializeArray(), function () {
            fd.append(this.name, this.value);
        });

        if (type == 1) {
            $(".chat_area").append(' <div class="text-end"><div class="bg-green-chat pt-2 pb-2 ps-3 pe-3 rounded-pill d-inline-block mb-2 fs-7">' + msg + '</div></div>');
            f.find("[name='message']").val("");
        }



        if (type == 2) {
            var file = document.getElementById('files').files[0];
            fd.append("chat_file", file);
            var _msg = "";
            if (msg.length > 0) {
                _msg = '<div class="text-start mt-2 mb-1">' + msg + '</div>';
            }

            f.find("[name='message']").val("");
            $(".chat_area").append(' <div class="text-end"><div class="bg-green-chat p-1 rounded d-inline-block mb-2 fs-7"><img src="' + src_img + '" alt="" />' + _msg + '</div></div>');

            f.find("[name=type]").val(1);
            $(".close_audio , .chat_audio , .chat_send , .wrap_chat_images_process").addClass("d-none");
            $(".textarea_chat , .audio_record , .btn_chat_file").removeClass("d-none");
        }
        if (type == 3) {
            fd.append('file', blob);
            $(".chat_area").append(' <div class="text-end"><audio src="' + $("#audio_recorded").attr("src") + '" controls=""></audio></div>');
            f.find("[name=type]").val(1);
            $(".close_audio , .chat_audio , .chat_send").addClass("d-none");
            $(".textarea_chat , .audio_record , .btn_chat_file").removeClass("d-none");
        }

        $(".audio_record").removeClass("d-none");
        $(".chat_send").addClass("d-none");

        $.ajax({
            type: "POST",
            url: url_main + "/chat/send",
            cache: true,
            enctype: 'multipart/form-data',
            data: fd,
            processData: false,
            contentType: false,
//            dataType: "json",
//            
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

            },
            error: function (error) {}
        });

        return false;
    });

});