$(document).ready(function () {



    $(document).on("change", "select[ajax]", function () {

        var url = $('meta[name="url-base"]').attr('content') + "/ajax/select_ajax";


        var col = $(this).attr("col");
        var rel = $(this).attr("rel");
        var tbl = $(this).attr("tbl");
        var ajax = $(this).attr("ajax");

        var data = "id=" + $(this).val() + "&relation=" + rel + "&table=" + tbl + "&column=" + col;



        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $("select[name='" + ajax + "']").html(data["option"]);
            },
            error: function (error) {}
        });

    });

    $(document).on("click", ".btn_show", function () {
        $($(this).attr("rel")).fadeToggle();
    });

    $(document).on("click", ".booing_status", function () {

        var rel = $(this).attr("rel");
        var ref = $(this).attr("ref");
        var msg = "هل تريد رفض الحجز بالفعل ؟";
        var title = "تحذير";
        var type = "error";

        if (rel == "1") {
            title = "رسالة تأكيدية";
            msg = "هل تريد تأكيد الحجز بالفعل ؟";
        }

        if (rel == "3") {
            title = "رسالة تأكيدية";
            msg = "هل تم تنفيذ الحجز بالفعل ؟";
        }

        if (rel == "4") {
            //title = "تحذير";
            // msg = "هل تريد إلغاء الحجز بالفعل ؟";

            var url = $(this).attr("ref");
            $("#refusedModal form").attr("action", url);
            $("#refusedModal").modal("show");




            return false;
        }

        cuteAlert({
            img: "question.svg",
            type: "question",
            title: title,
            message: msg,
            confirmText: "نعم",
            cancelText: "لا"
        }).then((e) => {
            console.log(e)
            if (e == ("Thanks")) {
            } else {
                if (e == "confirm") {
                    window.location.href = ref;
                }
            }
        })



    });

    $(document).on("click", ".btn_details_booking", function () {
        var rel = $(this).attr("rel");
        $(".details_booking_" + rel).slideToggle()();
    })

    $(document).on("click", ".rate_stars i", function () {
        var rel = parseInt($(this).attr("rel"));

        $(".rate_stars i").removeClass("text-gold");


        for (let i = 1; i <= rel; i++) {
            $(".rate_stars i[rel='" + i + "']").addClass("text-gold");
        }

        $("#form_ratting").find("input[name=val]").val(rel);

    });


    $(document).on("click", "#form_ratting button[type=submit]", function () {
        var f = $("#form_ratting");
        var url = f.attr("action");
        var data = f.serialize();

        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data["success"] == "0") {
                    cuteAlert({
                        img: "error.svg",
                        type: "error",
                        title: "خطأ",
                        message: data["msg"],
                    })
                } else {
                    cuteAlert({
                        img: "success.svg",
                        type: "success",
                        title: "رسالة إدارية",
                        message: data["msg"]
                    })

                    $(".rate_stars i").removeClass("text-gold");
                    f.find("textarea , input[type=text]").val("");
                    $(".rate_stars i[rel='1']").addClass("text-gold");
                }

            },
            error: function (error) {}
        });

        return false;
    });

    $(document).on("click", "#form_cart button[type=submit]", function () {
        var f = $("#form_cart");
        var url = f.attr("action");
        var data = f.serialize();


        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {

                if (data["login"] == "0") {
                    $("#loginModal").modal("show");
                } else {

                    if (data["success"] == "0") {
                        cuteAlert({
                            img: "error.svg",
                            type: "error",
                            title: "خطأ",
                            message: data["msg"],
                        })
                    } else {
                        cuteAlert({
                            img: "success.svg",
                            type: "success",
                            title: "رسالة إدارية",
                            message: data["msg"],
                        })

                        f.find("textarea , input[type=text]").val("");
                        f.find("select").val("").change();
                    }
                }
            },
            error: function (error) {}
        });

        return false;
    });

    $(document).on("change", ".select_date", function () {
        var url = $('meta[name="url-base"]').attr('content') + "/ajax/time_booking";
        var data = "id=" + $(this).val();
        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $(".select_time").html(data["data"]);
            },
            error: function (error) {}
        });
    });

    $(document).on("change", ".select_service", function () {
        //container_service
        var val = $(this).val();
        var price = $(".select_service option[value='" + val + "']").attr("price");
        if (val !== "") {
            $(".container_service").removeClass("d-none");
            $(".container_service span").html(price);
        } else {
            $(".container_service").addClass("d-none");
            $(".container_service span").html("");
        }

        var url = $('meta[name="url-base"]').attr('content') + "/ajax/select_service";
        var data = "id="+val;
        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $(".select_date").html(data["data"]);
            },
            error: function (error) {}
        });

    });

    $(document).on("click", ".btn_add_input_time", function () {

        var input = $(".wrap_input_time").html();

        var code = Math.floor(Math.random() * 100000);

        $(".wrap_btn_add_input_time").after("<div class='col-md-6 input_code_" + code + "'>" + input + "</div>");
        $(".input_code_" + code).find("input").val("");
        return false;
    });

    $(document).on("click", ".btn_fav", function () {
        var rel = $(this).attr("rel");
        var ic = $(this).find("i").hasClass("far");
        if (ic) {
            $(this).find("i").removeClass("far");
            $(this).find("i").addClass("fas");
        } else {
            $(this).find("i").addClass("far");
            $(this).find("i").removeClass("fas");
        }

        var url = $('meta[name="url-base"]').attr('content') + "/ajax/fav";
        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: "id=" + rel,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                var error = data["error"];
                if (error.length > 5) {
                    $(proccess).html(data["error"]);
                } else {
//                    $(proccess).html(data["success"]);

                    if (parseInt(data["success"]) == 1) {
                        window.location.replace($('meta[name="url-base"]').attr('content'));
                    }

                    form.find("input").val("");
                    form.find("textarea").val("");
                }
            },
            error: function (error) {}
        });

    })


    $(document).on("click", ".btn_dropdown", function () {
        var rel = $(this).attr("id");
        $(".dropdown-menu[aria-labelledby=" + rel + "]").toggle();
    })





    $(document).on("click", ".btn_delete", function () {

        var url_delete = $(this).attr("rel");

        cuteAlert({
            img: "question.svg",
            type: "question",
            title: "تحذير",
            message: "هل تريد بالفعل حذف العقار ؟",
            confirmText: "نعم",
            cancelText: "لا"
        }).then((e) => {
            console.log(e)
            if (e == ("Thanks")) {
            } else {
                if (e == "confirm") {
                    window.location.href = url_delete;
                }
            }
        })
    });





    $(document).on("click", ".btn_login", function () {

        var form = $("#form_login");
        var proccess = $(".proccess_login");
        var url = form.attr("action");
        var data = form.serialize() + "&submit=1";

        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                var error = data["error"];
                if (error.length > 5) {
                    $(proccess).html(data["error"]);
                } else {
//                    $(proccess).html(data["success"]);

                    if (parseInt(data["success"]) == 1) {
                        //window.location.replace($('meta[name="url-base"]').attr('content'));
                        $(".wrap_buttons_login").html(data["username"]);
                        $(".wrap_mobile_buttons_login").html(data["username_mobile"]);
                        $('#loginModal').modal('hide');
                        $("#loginModal .modal-header [data-dismiss='modal']").trigger("click");
                    }

                    form.find("input").val("");
                    form.find("textarea").val("");
                }
            },
            error: function (error) {}
        });

    });



    $(document).on("click", ".btn_register", function () {

        var form = $("#form_register");
        var proccess = $(".proccess_register");
        var url = form.attr("action");
        var data = form.serialize() + "&submit=1";

        $.ajax({
            type: "post",
            url: url,
            cache: true,
            data: data,
            dataType: "json",
            //  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                var error = data["error"];
                if (error.length > 5) {
                    $(proccess).html(data["error"]);
                } else {
//                    $(proccess).html(data["success"]);

                    if (parseInt(data["success"]) == 1) {
                        //window.location.replace($('meta[name="url-base"]').attr('content'));
                        $(".wrap_buttons_login").html(data["username"]);
                        $(".wrap_mobile_buttons_login").html(data["username_mobile"]);
                        $('#register').modal('hide');
                        $("#register .modal-header [data-dismiss='modal']").trigger("click");
                    }

                    form.find("input").val("");
                    form.find("textarea").val("");
                }
            },
            error: function (error) {}
        });

    });


    $(document).on("click", "[ajax]", function () {


        var form = $($(this).attr("form"));
        var proccess = $(this).attr("ajax");
        var url = form.attr("action");
        var data = form.serialize() + "&submit=1";


        $.ajax({
            type: "post",
            url: url,
            cache: false,
            data: data,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                var error = data["error"];
                if (error.length > 5) {
                    $(proccess).html(data["error"]);
                } else {
                    $(proccess).html(data["success"]);
                    form.find("input").val("");
                    form.find("textarea").val("");
                }
            },
            error: function (error) {}
        });


    });




});