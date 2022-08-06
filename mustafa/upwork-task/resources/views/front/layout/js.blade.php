<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script src="<?= Rc_url("front") ?>/js/java.js?v=0.0.4"></script>
<script src="<?= Rc_url("front") ?>/js/bootstrap.min.js"></script>
<script src="<?= Rc_url("front") ?>/plugin/prettyPhoto/js.js"></script>

<script type="text/javascript" charset="utf-8">

    $(document).ready(function() {
   $('.dropdown-toggles').click(function(){
       $(this).parent().find(".dropdown-menu").toggle();
   })
});

</script>


<?php if (uri(1) == "chat"): ?>
    <script src="<?= Rc_url("front") ?>/plugin/chat/js.js"></script>
<?php endif; ?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $("a[rel^='prettyPhoto']").prettyPhoto();
    });
</script>


<script src="{{asset('front/plugin/select2/js.js')}}"></script>
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

<script src="{{asset('front/plugin/alert/cute-alert.js')}}"></script>
<script src="{{asset('front/plugin/upload/dropzone.js')}}"></script>
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
            url: url_base + "/upload",
            timeout: 1000000000000000000,
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
                        var [pluginName, fileExtension] = value.split(/\.(?=[^\.]+$)/);

                        var mockFile = {
                            name: value,
//                    size: '1000', 
//                    type: 'image/jpeg', 
                            accepted: true            // required if using 'MaxFiles' option
                        };
                        _this.files.push(mockFile);    // add to files array
                        _this.emit("addedfile", mockFile);

                        if (fileExtension == "jpg" || fileExtension == "jpeg" || fileExtension == "png" || fileExtension == "gif") {
                            _this.emit("thumbnail", mockFile, url_base + '/files/micro/' + value);
//                            $("img[alt='" + value + "']").parent().parent().attr("rel", value);
                        }else{


                        }
                        
                        
                        _this.emit("complete", mockFile);
$(that).find(".dz-complete").eq(index).attr("rel", value);

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
                        url: url_base + "/upload/delete",
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

<?php if (request()->get("login") == "force"): ?>
    <script type="text/javascript">
    cuteAlert({
        img: "info.svg",
        type: "info",
        title: "رسالة إدارية",
        message: "يجب عليك تسجيل الدخول أولا ",
    })
    </script>
<?php endif; ?>

<script type="text/javascript">

    function darken_screen(yesno) {
        if (yesno == true) {
            document.querySelector('.screen-darken').classList.add('active');
        } else if (yesno == false) {
            document.querySelector('.screen-darken').classList.remove('active');
        }
    }

    function close_offcanvas() {
        darken_screen(false);
        document.querySelector('.mobile-offcanvas.show').classList.remove('show');
        document.body.classList.remove('offcanvas-active');
    }

    function show_offcanvas(offcanvas_id) {
        darken_screen(true);
        document.getElementById(offcanvas_id).classList.add('show');
        document.body.classList.add('offcanvas-active');
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('[data-trigger]').forEach(function (everyelement) {

            let offcanvas_id = everyelement.getAttribute('data-trigger');

            everyelement.addEventListener('click', function (e) {
                e.preventDefault();
                show_offcanvas(offcanvas_id);

            });
        });

        document.querySelectorAll('.btn-close').forEach(function (everybutton) {

            everybutton.addEventListener('click', function (e) {
                e.preventDefault();
                close_offcanvas();
            });
        });

        document.querySelector('.screen-darken').addEventListener('click', function (event) {
            close_offcanvas();
        });
    });
    // DOMContentLoaded  end
</script>



<script src="<?= Rc_url("front") ?>/plugin/carousel/owl.carousel.js"></script>
<script>
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            rtl: true,
            margin: 10,
            nav: true,
            loop: false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
    })
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
