<script src="{{asset("admin/plugin/coreui-pro/coreui.bundle.min.js")}}"></script>
<!--[if IE]><!-->
<script src="vendors/@coreui/icons/js/svgxuse.min.js"></script>
<!--<![endif]-->
<script src="{{asset("admin/plugin/chart/coreui-chartjs.bundle.js")}}"></script>
<script src="{{asset("admin/plugin/utils/coreui-utils.js")}}"></script>
<script src="{{asset("admin/js/main.js")}}"></script>
<script>
document.addEventListener("DOMContentLoaded", function (event) {
    setTimeout(function () {
        document.body.classList.remove('c-no-layout-transition')
    }, 2000);
});</script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="{{asset("admin/plugin/toastr/toastr.js")}}"></script>

<script src="{{asset("admin/js/rocsel.js?v=1.0.0")}}"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
<script src="{{asset('admin/plugin/select2/js.js')}}"></script>
<script>

function iformat(icon) {
    var originalOption = icon.element;
    return $('<span><i class=" ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
}
$(".select2").select2({
    dir: "rtl",
    allowClear: true,
    templateSelection: iformat,
    templateResult: iformat,
    allowHtml: true
});</script>


<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.js"></script>
<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/mode/xml/xml.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.2.7/purify.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/froala_editor.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/align.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/char_counter.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/code_beautifier.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/code_view.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/colors.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/draggable.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/emoticons.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/entities.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/file.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/font_size.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/font_family.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/fullscreen.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/image.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/image_manager.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/line_breaker.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/inline_style.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/link.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/lists.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/paragraph_format.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/paragraph_style.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/quick_insert.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/quote.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/table.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/save.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/url.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/video.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/help.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/print.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/third_party/spell_checker.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/special_characters.min.js"></script>
<script type="text/javascript" src="{{asset('admin/plugin/editor')}}/js/plugins/word_paste.min.js"></script>

<script>
(function () {
    new FroalaEditor("textarea.editor", {
        direction: 'rtl',
        height: 250,

        // Set the image upload parameter.
        imageUploadParam: 'file',

        // Set the image upload URL.
        imageUploadURL: 'https://localhost/frame/admin/upload/editor',
//{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // Additional upload params.
        imageUploadParams: {"_token": $('meta[name="csrf-token"]').attr('content')},

        // Set request type.
        imageUploadMethod: 'POST',

        // Set max image size to 5MB.
        imageMaxSize: 5 * 1024 * 1024,

        // Allow to upload PNG and JPG.
        imageAllowedTypes: ['jpeg', 'jpg', 'png'],

        events: {
            'image.beforeUpload': function (images) {
                // Return false if you want to stop the image upload.
            },
            'image.uploaded': function (response) {
                // Image was uploaded to the server.
            },
            'image.inserted': function ($img, response) {
                // Image was inserted in the editor.
            },
            'image.replaced': function ($img, response) {
                // Image was replaced in the editor.
            },
            'image.error': function (error, response) {
                // Bad link.
                if (error.code == 1) {
                }

                // No link in upload response.
                else if (error.code == 2) {
                }

                // Error during image upload.
                else if (error.code == 3) {
                }

                // Parsing response failed.
                else if (error.code == 4) {
                }

                // Image too text-large.
                else if (error.code == 5) {
                }

                // Invalid image type.
                else if (error.code == 6) {
                }

                // Image can be uploaded only to same domain in IE 8 and IE 9.
                else if (error.code == 7) {
                }

                // Response contains the original server response to the request if available.
            }
        }

    })
})()
</script>




<!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
<script src="{{asset('admin/plugin/date')}}/js/bootstrap-hijri-datetimepicker.js?v2"></script>



<script type="text/javascript">


$(function () {

    initHijrDatePicker();
    initHijrDatePickerDefault();
    $('.disable-date').hijriDatePicker({
        minDate: "2020-01-01",
        maxDate: "2021-01-01",
        viewMode: "years",
        hijri: true,
        debug: true
    });
});
function initHijrDatePicker() {

    $(".hijri-date-input").hijriDatePicker({
        locale: "ar-sa",
        format: "DD-MM-YYYY",
        hijriFormat: "iYYYY-iMM-iDD",
        dayViewHeaderFormat: "MMMM YYYY",
        hijriDayViewHeaderFormat: "iMMMM iYYYY",
        showSwitcher: true,
        allowInputToggle: true,
        showTodayButton: true,
        useCurrent: false,
        isRTL: true,
        viewMode: 'days',
        keepOpen: false,
        hijri: false,
        debug: true,
        showClear: true,
        showTodayButton: true,
        showClose: true
    });
}

function initHijrDatePickerDefault() {

    $(".hijri-date-default").hijriDatePicker();
}
</script>



<script src="{{asset('admin/plugin/upload/dropzone.js')}}"></script>
<script>
var url_base = $("meta[name='url-base']").attr('content');
var url_main = $("meta[name='url-main']").attr('content');
Dropzone.autoDiscover = false;
$(".dropzone").each(function () {
    var that = $(this);
    var num = that.attr("num");
    var allow = that.attr("allow");
    var mark = that.attr("mark");
//    var myDropzone = new Dropzone("div#myId", {
    var myDropzone = $(this).dropzone({
        url: url_main + "/upload",
        addRemoveLinks: true,
        dictDefaultMessage: "إسحب وأفلت الملف أو أنقر لتحديد لملف",
        dictRemoveFile: "حذف",
        dictCancelUpload: "إلغاء",
        dictResponseError: "حدث خطأ ما يجي المحاولة مره اخرى ",
        dictMaxFilesExceeded: "لقد تجاوزت الحد الأقصي .",
        maxFiles: num,
        acceptedFiles: allow,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success: function (file, response) {
            var r = JSON.parse(response);
            $(file.previewElement).attr("rel", r.name);
            var out_val = "";
            var val = that.find("input").val();
            if (val) {
                out_val = val + "," + r.name;
            } else {
                out_val = r.name;
            }
            that.find("input").val(out_val);
            // console.log(out_val);
        },
        init: function () {

            var val = that.find("input").val();
            var val_arr = val.split(',');
            var _this = this;
            if (val.length > 1) {
                $.each(val_arr, function (index, value) {
                    var mockFile = {
                        name: value,
//                    size: '1000', 
//                    type: 'image/jpeg', 
                        accepted: true            // required if using 'MaxFiles' option
                    };
                    _this.files.push(mockFile);    // add to files array
                    _this.emit("addedfile", mockFile);
                    _this.emit("thumbnail", mockFile, url_base+'files/micro/' + value);
                    _this.emit("complete", mockFile);

                    $("img[alt='" + value + "']").parent().parent().attr("rel", value);
                });
            }






            this.on("sending", function (file, xhr, formData) {
                formData.append("mark", mark);
            });

            this.on("removedfile", function (file) {
                var rel = $(file.previewElement).attr("rel");

                var val = that.find("input").val();
                var val_arr = val.split(',');

                const index = val_arr.indexOf(rel);
                if (index > -1) {
                    val_arr.splice(index, 1);
                }

                that.find("input").val(val_arr.toString());

                // var url_main = $("meta[name='url-main']").attr('content');
                $.ajax({
                    type: "post",
//                    url: url_main + "/upload/delete",
                    url: url_main + "/upload/delete",
                    cache: false,
                    data: "name=" + rel,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (html) {},
                    error: function (error) {
                    }
                });
            });
        }
    });
});

/*
 $(document).ready(function () {
 $(document).on("click", ".dz-remove", function () {
 //        var rel = $(this).parent().attr("rel");
 alert(1);
 });
 
 
 });
 * 
 */




</script>