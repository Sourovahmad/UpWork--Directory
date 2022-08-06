
$(document).ready(function () {
//    $("body").addClass(localStorage["body_class"]);

    $(document).on("click", ".dark_mood", function () {
        if ($("body").hasClass("c-dark-theme")) {
            $("body").removeClass("c-dark-theme");
            localStorage["body_class"] = "";
        } else {
            $("body").addClass("c-dark-theme");
            localStorage["body_class"] = "c-dark-theme";
        }
    });

    $(".btn_form_lang").click(function () {
        $(".btn_form_lang").removeClass("btn-info text-white");
        $(this).addClass("btn-info text-white");
        var lang = $(this).attr("lang");
        $(".form_lang_group").hide();
        $(".form_lang_" + lang).fadeIn();
        $(".form_lang_" + lang).removeClass("d-none");
    });

    $(".wrap_tbl_search input").keyup(function () {

        var url = $("meta[name='url-current']").attr("content");
        var search = "";
        $('.wrap_tbl_search input').each(function (i, obj) {
            var n = $(this).attr("name") + "|REGEXP";
            var v = $(this).val();
            search += "&" + n + "=" + v;
        });

        $.ajax({
            type: "get",
            url: url,
            cache: false,
            data: "search=1&ajax=1" + search,
            dataType: "html",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                $(".container_tbl").html(data);
            },
            error: function (error) {}
        });

    });


    // checkbox
    $(".check_all").on("change", function () {
        $(".check_child_" + $(this).attr("rel")).prop("checked", $(this).is(':checked'));

        if ($(".check_parent").is(':checked')) {
            $(".check_child_" + $(this).attr("rel")).parent().parent().find("span").addClass("checked");
        } else {
            $(".check_child_" + $(this).attr("rel")).parent().parent().find("span").removeClass("checked");
        }
    });



    $(document).on("click", ".RC_table_delete_rows", function () {
        var f = $(this).parent().parent().parent().find("table").find(".check_child_");
        var id = "";
        $(f).each(function () {
            var val = (this.checked ? $(this).val() : "");
            if (val && val > 0) {
                if (id !== "") {
                    id += "," + val;
                } else {
                    id += val;
                }
            }

        });

        if (id == "") {
            $.toast({
                textAlign: 'right',
                heading: '<br /> خطأ',
                text: 'قم بتحديد الصف الذي تريد حذفه أولا .',
                showHideTransition: 'fade',
                position: 'bottom-center',
                icon: 'error'
            });
        } else {
            $('#dangerModal').modal('show');
            $("#dangerModal input[name='id']").val(id);
        }
        return false;
    });

});