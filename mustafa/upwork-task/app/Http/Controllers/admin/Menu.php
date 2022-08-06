<?php

namespace App\Http\Controllers\admin;

use App\RC;
use App\RC\Form;
use App\RC\Input;
use App\RC\Tbl;
use App\RC\Block;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Menu extends ControllerAmin {

    public $table;

    public function __construct() {
        
    }

    private function data() {
        $inputs = array();
        $index = array();

        // title ..
        $input = Input::creat(RC_IN_TEXT, "title", false);
        $input = $input->check(1)->col(6, true);
        $inputs[] = $input->get();
        $index[] = $input->tbl(1)->arr();

        // url ..
        $input = Input::creat(RC_IN_TEXT, "url", false);
        $input = $input->check(4)->col(6, true);
        $inputs[] = $input->get();
        $index[] = $input->arr();

      
        // parent ..
        $input = Input::creat(RC_IN_select, "parent", false);
        $input = $input->check(null)->col(6, true);
        $input = $input->db(["parent" => 0], "rc_menu");
        $inputs[] = $input->get();

        // icon ..
        $input = Input::creat(RC_IN_select, "icon", false);
        $input = $input->col(6, true);
        $option = array();
        $option["fab fa-apple"] = array("ابل", 'fab fa-apple');
        $option["far fa-bell"] = array("اشعار فارغ", 'far fa-bell');
        $option["fas fa-bell"] = array("اشعار ", 'fas fa-bell');
        $option["fas fa-bell-slash"] = array("اشعار ", 'fas fa-bell-slash');
        $option["far fa-bell-slash"] = array("اشعار ", 'far fa-bell-slash');
        $option["fas fa-bed"] = array("سرير", 'fas fa-bed');
        $option["fas fa-bath"] = array("حمام", 'fas fa-bath');
        $option["fas fa-battery-three-quarters"] = array("بطارية", 'fas fa-battery-three-quarters');
        $option["fas fa-balance-scale-left"] = array("ميزان", 'fas fa-balance-scale-left');
        $option["fas fa-balance-scale"] = array("ميزان", 'fas fa-balance-scale');
        $option["fas fa-baby-carriage"] = array("عربة طفل", 'fas fa-baby-carriage');
        $option["fas fa-baby"] = array("طفل", 'fas fa-baby');
        $option["fas fa-award"] = array("ميدالية", 'fas fa-award');
        $option["fas fa-baseball-ball"] = array("كرة", 'fas fa-baseball-ball');
        $option["fas fa-basketball-ball"] = array("كرة", 'fas fa-basketball-ball');
        $option["fas fa-ban"] = array("حظر", 'fas fa-ban');
        $option["fas fa-biking"] = array("عجلة", 'fas fa-biking');
        $option["fas fa-bicycle"] = array("عجلة", 'fas fa-bicycle');
        $option["fas fa-bolt"] = array("كهربا", 'fas fa-bolt');
        $option["fas fa-book-reader"] = array("كتاب", 'fas fa-book-reader');
        $option["fas fa-book-open"] = array("كتاب", 'fas fa-book-open');
        $option["fas fa-book"] = array("كتاب", 'fas fa-book');
        $option["fas fa-box-open"] = array("بوكس", 'fas fa-box-open');
        $option["fas fa-box"] = array("بوكس", 'fas fa-box');
        $option["fab fa-buffer"] = array("طبقات", 'fab fa-buffer');
        $option["fas fa-broom"] = array("ريشة", 'fas fa-broom');
        $option["fas fa-feather"] = array("ريشة", 'fas fa-feather');
        $option["fas fa-feather-alt"] = array("ريشة", 'fas fa-feather-alt');
        $option["fas fa-female"] = array("مرأة مستخدم", 'fas fa-female');
        $option["fas fa-briefcase"] = array("شنطة", 'fas fa-briefcase');
        $option["fas fa-business-time"] = array("شنطة", 'fas fa-business-time');
        $option["fas fa-building"] = array("عمارة", 'fas fa-building');
        $option["far fa-building"] = array("عمارة", 'far fa-building');
        $option["fas fa-bullhorn"] = array("مزياع", 'fas fa-bullhorn');
        $option["fas fa-bullseye"] = array("دائرة", 'fas fa-bullseye');
        $option["fas fa-bus"] = array("اتويس", 'fas fa-bus');
        $option["fas fa-bus-alt"] = array("اتويس", 'fas fa-bus-alt');
        $option["fas fa-car"] = array("سيارة", 'fas fa-car');
        $option["fas fa-car-alt"] = array("سيارة", 'fas fa-car-alt');
        $option["fas fa-car-side"] = array("سيارة", 'fas fa-car-side');
        $option["fas fa-train"] = array("قطر", 'fas fa-train');
        $option["fas fa-cart-plus"] = array("مشتريات", 'fas fa-cart-plus');
        $option["fas fa-cart-arrow-down"] = array("مشتريات", 'fas fa-cart-arrow-down');
        $option["fas fa-cash-register"] = array("مشتريات", 'fas fa-cash-register');
        $option["fas fa-cat"] = array("قطة", 'fas fa-cat');
        $option["far fa-chart-bar"] = array("إحصائيات", 'far fa-chart-bar');
        $option["fas fa-chart-bar"] = array("إحصائيات", 'fas fa-chart-bar');
        $option["fas fa-check"] = array("صح", 'fas fa-check');
        $option["far fa-check-circle"] = array("صح", 'far fa-check-circle');
        $option["fas fa-check-circle"] = array("صح", 'fas fa-check-circle');
        $option["fas fa-check-square"] = array("صح", 'fas fa-check-square');
        $option["far fa-check-square"] = array("صح", 'far fa-check-square');
        $option["fas fa-check-double"] = array("صح", 'fas fa-check-double');
        $option["fas fa-circle"] = array("صح", 'fas fa-circle');
        $option["far fa-circle"] = array("صح", 'far fa-circle');
        $option["fas fa-child"] = array("طفل ولد مستخدم", 'fas fa-child');
        $option["fas fa-clipboard-list"] = array("ليستة", 'fas fa-clipboard-list');
        $option["fas fa-clipboard-check"] = array("ليستة", 'fas fa-clipboard-check');
        $option["fas fa-clipboard"] = array("ليستة", 'fas fa-clipboard');
        $option["fas fa-list-ul"] = array("ليستة", 'fas fa-list-ul');
        $option["far fa-clone"] = array("مربع", 'far fa-clone');
        $option["fab fa-codepen"] = array("مربع", 'fab fa-codepen');
        $option["fas fa-expand"] = array("مربع", 'fas fa-expand');
        $option["fab fa-envira"] = array("ورقة شجر", 'fab fa-envira');
        $option["fas fa-spa"] = array("ورقة شجر", 'fas fa-spa');
        $option["far fa-comment"] = array("رسالة", 'far fa-comment');
        $option["far fa-comments"] = array("رسالة", 'far fa-comments');
        $option["far fa-envelope"] = array("رسالة", 'far fa-envelope');
        $option["fas fa-envelope-open-text"] = array("رسالة", 'fas fa-envelope-open-text');
        $option["fas fa-envelope"] = array("رسالة", 'fas fa-envelope');
        $option["far fa-envelope"] = array("رسالة", 'far fa-envelope');
        $option["far fa-comment-dots"] = array("رسالة", 'far fa-comment-dots');
        $option["far fa-copy"] = array("ملف", 'far fa-copy');
        $option["fas fa-coffee"] = array("فنجان", 'fas fa-coffee');
        $option["fas fa-coins"] = array("قاعدة بيانات", 'fas fa-coins');
        $option["fas fa-coins"] = array("fas fa-database", 'fas fa-database');
        $option["fas fa-burn"] = array("شعلة", 'fas fa-burn');
        $option["fas fa-fire"] = array("شعلة", 'fas fa-fire');
        $option["fab fa-gripfire"] = array("شعلة", 'fab fa-gripfire');
        $option["fab fa-free-code-camp"] = array("شعلة", 'fab fa-free-code-camp');
        $option["fas fa-fire-alt"] = array("شعلة", 'fas fa-fire-alt');
        $option["fas fa-fingerprint"] = array("بصمة", 'fas fa-fingerprint');
        $option["fas fa-filter"] = array("فلتر", 'fas fa-filter');
        $option["fas fa-fish"] = array("سمكة", 'fas fa-fish');
        $option["far fa-folder"] = array("فولدر", 'far fa-folder');
        $option["fas fa-folder"] = array("فولدر", 'fas fa-folder');
        $option["fas fa-bookmark"] = array("علامة", 'fas fa-bookmark');
        $option["far fa-bookmark"] = array("علامة", 'far fa-bookmark');
        $option["far fa-calendar-alt"] = array("نتيجة", 'far fa-calendar-alt');
        $option["fas fa-calendar-alt"] = array("نتيجة", 'fas fa-calendar-alt');
        $option["fas fa-calendar-check"] = array("نتيجة", 'fas fa-calendar-check');
        $option["fas fa-calculator"] = array("نتيجة", 'fas fa-calculator');
        $option["far fa-calendar-plus"] = array("نتيجة", 'far fa-calendar-plus');
        $option["fas fa-camera"] = array("صور", 'fas fa-camera');
        $option["fas fa-camera-retro"] = array("صور", 'fas fa-camera-retro');
        $option["fas fa-concierge-bell"] = array("طعام", 'fas fa-concierge-bell');
        $option["fab fa-creative-commons-by"] = array("رجل مستخدم", 'fab fa-creative-commons-by');
        $option["fas fa-cut"] = array("مقص", 'fas fa-cut');
        $option["fas fa-cubes"] = array("صندوق", 'fas fa-cubes');
        $option["fas fa-cube"] = array("صندوق", 'fas fa-cube');
        $option["fas fa-dice-d6"] = array("صندوق", 'fas fa-dice-d6');
        $option["fas fa-dollar-sign"] = array("مشتريات مبيعات دولار", 'fas fa-dollar-sign');
        $option["fas fa-dolly"] = array("مشتريات مبيعات", 'fas fa-dolly');
        $option["fas fa-dolly-flatbed"] = array("مشتريات مبيعات", 'fas fa-dolly-flatbed');
        $option["fas fa-desktop"] = array("شاشة", 'fas fa-desktop');
        $option["fas fa-laptop"] = array("شاشة", 'fas fa-laptop');
        $option["fas fa-fax"] = array("فاكس", 'fas fa-fax');
        $option["fas fa-file-alt"] = array("ملف", 'fas fa-file-alt');
        $option["far fa-file-alt"] = array("ملف", 'far fa-file-alt');
        $option["far fa-file"] = array("ملف", 'far fa-file');
        $option["fas fa-file"] = array("ملف", 'fas fa-file');
        $option["far fa-file-video"] = array("ملف فيديو", 'far fa-file-video');
        $option["fas fa-file-video"] = array("ملف فيديو", 'fas fa-file-video');
        $option["fas fa-file-invoice"] = array("ملف فاتورة مبيعات", 'fas fa-file-invoice');
        $option["fas fa-file-invoice-dollar"] = array("ملف فاتورة مبيعات", 'fas fa-file-invoice-dollar');
        $option["fas fa-file-medical-alt"] = array("ملف  ", 'fas fa-file-medical-alt');
        $option["fas fa-file-download"] = array("ملف تحميل ", 'fas fa-file-download');
        $option["fas fa-file-contract"] = array("ملف  ", 'fas fa-file-contract');
        $option["far fa-file-pdf"] = array("ملف pdf ", 'far fa-file-pdf');
        $option["fas fa-flag"] = array("علم", 'fas fa-flag');
        $option["far fa-flag"] = array("علم", 'far fa-flag');
        $option["far fa-gem"] = array("جوهرة", 'far fa-gem');
        $option["fas fa-gem"] = array("جوهرة", 'fas fa-gem');
        $option["fab fa-sketch"] = array("جوهرة", 'fab fa-sketch');
        $option["fas fa-gavel"] = array("شاكوش", 'fas fa-gavel');
        $option["fas fa-globe"] = array("كرة ارضية", 'fas fa-globe');
        $option["fas fa-globe-africa"] = array("كرة ارضية", 'fas fa-globe-africa');
        $option["fas fa-graduation-cap"] = array("شهادة", 'fas fa-graduation-cap');
        $option["fab fa-google-wallet"] = array("خطوط", 'fab fa-google-wallet');
        $option["fas fa-grip-lines"] = array("خطوط", 'fas fa-grip-lines');
        $option["fas fa-align-justify"] = array("خطوط", 'fas fa-align-justify');
        $option["fas fa-align-center"] = array("خطوط", 'fas fa-align-center');
        $option["fas fa-align-left"] = array("خطوط", 'fas fa-align-left');
        $option["fas fa-align-right"] = array("خطوط", 'fas fa-align-right');
        $option["far fa-heart"] = array("قلب", 'far fa-heart');
        $option["fas fa-heart"] = array("قلب", 'fas fa-heart');
        $option["fas fa-map-marker-alt"] = array("موقع عنوان خريطة", 'fas fa-map-marker-alt');
        $option["fas fa-street-view"] = array("موقع عنوان خريطة رجل مستخدم", 'fas fa-street-view');
        $option["fab fa-periscope"] = array("موقع عنوان خريطة رجل مستخدم", 'fab fa-periscope');
        $option["far fa-newspaper"] = array("جريدة", 'far fa-newspaper');
        $option["fas fa-palette"] = array("الوان", 'fas fa-palette');
        $option["fas fa-paint-brush"] = array("الوان", 'fas fa-paint-brush');
        $option["fas fa-phone-alt"] = array("تليفون", 'fas fa-phone-alt');
        $option["far fa-play-circle"] = array("فيديو", 'far fa-play-circle');
        $option["fas fa-restroom"] = array("رجل و مراة مستخدم", 'fas fa-restroom');
        $option["fas fa-university"] = array("بنك", 'fas fa-university');
        $option["fas fa-user"] = array("مستخدم", 'fas fa-user');
        $option["far fa-user"] = array("مستخدم", 'far fa-user');
        $option["fas fa-user-alt"] = array("مستخدم", 'fas fa-user-alt');
        $option["fas fa-user-alt-slash"] = array("مستخدم", 'fas fa-user-alt-slash');
        $option["fas fa-user-graduate"] = array("مستخدم", 'fas fa-user-graduate');
        $option["fas fa-user-friends"] = array("مستخدم", 'fas fa-user-friends');
        $option["fas fa-user-shield"] = array("مستخدم", 'fas fa-user-shield');
        $option["fas fa-users"] = array("مستخدم", 'fas fa-users');
        $option["fas fa-user-tie"] = array("مستخدم", 'fas fa-user-tie');
        $option["fas fa-user-tag"] = array("مستخدم", 'fas fa-user-tag');
        $option["fas fa-user-slash"] = array("مستخدم", 'fas fa-user-slash');
        $option["fas fa-walking"] = array("مستخدم", 'fas fa-walking');
        $option["far fa-address-card"] = array("مستخدم", 'far fa-address-card');
        $option["fas fa-address-card"] = array("مستخدم", 'fas fa-address-card');
        $option["far fa-address-book"] = array("مستخدم", 'far fa-address-book');
        $option["fas fa-address-book"] = array("مستخدم", 'fas fa-address-book');
        $option["fas fa-wrench"] = array("مفتاح صيانة", 'fas fa-wrench');
        $option["fab fa-youtube"] = array(" فيديو يوتيوب", 'fab fa-youtube');
        $option["far fa-window-restore"] = array("مربع", 'far fa-window-restore');
        $option["fas fa-wifi"] = array("واي فاي", 'fas fa-wifi');
        $option["fas fa-wallet"] = array("محفظة", 'fas fa-wallet');
        $option["fas fa-trophy"] = array("كاس", 'fas fa-trophy');
        $option["fas fa-tint"] = array("نقطة", 'fas fa-tint');
        $option["fas fa-thumbs-up"] = array("اوك", 'fas fa-thumbs-up');
        $option["far fa-thumbs-up"] = array("اوك", 'far fa-thumbs-up');
        $option["fas fa-tag"] = array("اوفرت خصم", 'fas fa-tag');
        $option["fas fa-tags"] = array("اوفرت خصم", 'fas fa-tags');
        $option["fas fa-scroll"] = array("ورقة", 'fas fa-scroll');
        $option["fas fa-plane"] = array("طائرة", 'fas fa-plane');
        $option["fas fa-photo-video"] = array("صور و فيديو", 'fas fa-photo-video');
        $option["far fa-image"] = array("صور", 'far fa-image');
        $option["fas fa-images"] = array("صور", 'fas fa-images');
        $option["far fa-images"] = array("صور", 'far fa-images');
        $option["fas fa-image"] = array("صور", 'fas fa-image');
        $option["fas fa-video"] = array("فيديو", 'fas fa-video');
        $option["fas fa-video-slash"] = array("فيديو", 'fas fa-video-slash');
        $option["fab fa-viadeo"] = array("فيديو", 'fab fa-viadeo');
        $option["fas fa-microphone-alt"] = array("ميك", 'fas fa-microphone-alt');
        $option["fas fa-microphone"] = array("ميك", 'fas fa-microphone');
        $option["far fa-hdd"] = array("ديسك", 'far fa-hdd');
        $option["fas fa-hdd"] = array("ديسك", 'fas fa-hdd');
        $option["fas fa-mobile-alt"] = array("موبيل", 'fas fa-mobile-alt');
        $option["far fa-lightbulb"] = array("لمبة", 'far fa-lightbulb');
        $option["fas fa-lightbulb"] = array("لمبة", 'fas fa-lightbulb');
        $option["fab fa-java"] = array("جافا", 'fab fa-java');
        $option["fas fa-info-circle"] = array("معلومات", 'fas fa-info-circle');
        $input = $input->option($option);
        $inputs[] = $input->get();

        // view",  ..
        $input = Input::creat(RC_IN_CHECKBOOX, "view", false);
        $input = $input->check(null)->col(4, true)->value(1);
        $inputs[] = $input->get();

        // permission ..
        $input = Input::creat(RC_IN_CHECKBOOX, "permission", false);
        $input = $input->check(null)->col(4, true)->value(1);
        $inputs[] = $input->get();

        // feature ..
        $input = Input::creat(RC_IN_CHECKBOOX, "feature", false);
        $input = $input->check(null)->col(4, true)->value(1);
        $inputs[] = $input->get();
        $inputs[] = RC_div("<hr />", "col-md-12");

        // insert ..
        $input = Input::creat(RC_IN_CHECKBOOX, "insert", false);
        $input = $input->check(null)->col(3, true)->value(1);
        $inputs[] = $input->get();

        // home ..
        $input = Input::creat(RC_IN_CHECKBOOX, "home", false);
        $input = $input->check(null)->col(3, true)->value(1);
        $inputs[] = $input->get();

        // update ..
        $input = Input::creat(RC_IN_CHECKBOOX, "update", false);
        $input = $input->check(null)->col(3, true)->value(1);
        $inputs[] = $input->get();

        // delete ..
        $input = Input::creat(RC_IN_CHECKBOOX, "delete", false);
        $input = $input->check(null)->col(3, true)->value(1);
        $inputs[] = $input->get();

//        // content ..
//        $input = Input::creat(RC_IN_MAP, "map", false);
//        $input = $input->check(1);
//        $inputs[] = $input->get();
        // oredr for table ..
        $oredrs_btn = function ($r) {
            $btn = RC_link('<i class="far fa-edit"></i>', RC_url(RC_uri(1) . "/form/update/{$r->id}"), "btn btn-dark");
            return $btn;
        };
        $input = Input::creat(RC_IN_CONTENT, "order_btn", false)->value($oredrs_btn);
        $index[] = $input->tbl(1)->arr();

        $arr = array("form" => $inputs, "index" => $index);
        $obj = (object) $arr;
        return $obj;
    }

    public function index() {
        RC_access();

        /*
          $myfile = fopen("app/RC/control.php", "r") or die("Unable to open file!");
          $read =  fread($myfile, filesize("app/RC/control.php"));
          fclose($myfile);

          $read_out =  str_replace("RC_CLASS_NAME", "Test2", $read);;
          echo $read_out;


          $file = "app/Http/Controllers/admin/Test2.php";
          $myfile = fopen($file, "w") or die("Unable to open file!");
          $txt = "John Doe\n";
          fwrite($myfile, $read_out);
          $txt = "Jane Doe\n";
          fwrite($myfile, $txt);
          fclose($myfile);
          chmod($file, 0777);
         */



        $container = "";

        $block = Block::creat(false);
        $content = Tbl::creat($this->data()->index)->get();
        $block->inject($content);

        $block->span(RC_link("إضافة جديد", RC_url(RC_uri(1) . "/form/insert")));
        $container = $block->get();

        // layout ..
        echo view('admin/layout/layout', ["container" => $container]);
    }

    public function form() {
        RC_access();
        $out = "";

        /*


          //  echo env('DB_DATABASE', 'forge');
          $x = db_column("tb_feature");

          //        $y = $x["id"];
          //     echo $y->COLUMN_NAME;
          print_r($x);
          die;
         * 
         */


        $form = Form::creat(); // from creat

        $block = Block::creat(false); // block creat
        $block->inject($this->data()->form);
        $container = $block->get(); // block end ..
        // form end
        $form->inject($container);

        $fun = function ($r) {
            $title = request()->post("title");
            $parent = request()->post("parent");
            $url = request()->post("url");
            if ($parent == 2) {
                $url = "settings/" . $url;
            }

            if (request()->post("insert") == 1) {
                $value = array();
                $value["parent"] = $r;
                $value["url"] = $url . "/form/insert";
                $value["title"] = "إضافة " . $title;
                $value["view"] = 1;
                $value["permission"] = 1;
                //  DB::table("rc_menu")->insert($value);
                db_insert("rc_menu", $value, false);
            }
            if (request()->post("update") == 1) {
                $value = array();
                $value["parent"] = $r;
                $value["url"] = $url . "/form/update";
                $value["title"] = "تعديل " . $title;
                $value["view"] = 0;
                $value["permission"] = 1;
                // DB::table("rc_menu")->insert($value);
                db_insert("rc_menu", $value, false);
            }
            if (request()->post("delete") == 1) {
                $value = array();
                $value["parent"] = $r;
                $value["url"] = $url . "/form/delete";
                $value["title"] = "حذف " . $title;
                $value["view"] = 0;
                $value["permission"] = 1;
                //  DB::table("rc_menu")->insert($value);
                db_insert("rc_menu", $value, false);
            }
            if (request()->post("home") == 1) {
                $value = array();
                $value["parent"] = $r;
                $value["url"] = $url;
                $value["title"] = "عرض " . $title;
                $value["view"] = 1;
                $value["permission"] = 1;
                db_insert("rc_menu", $value, false);
                //  DB::table("rc_menu")->insert($value);
            }
            if (request()->post("feature") == 1) {

                $r = DB::table("tb_feature_type")->where("name", request()->post("url"))->first();

                if (empty($r)) {
                    $value = array();
                    $value["value"] = request()->post("title");
                    $value["name"] = request()->post("url");
                    db_insert("tb_feature_type", $value, false);
                }

                //  DB::table("rc_menu")->insert($value);
            }
        };

        $out = $form->fun($fun)->get();

        // layout ..
        echo view(RC_urlLayout("layout"), ["container" => $out]);
    }

    public function delete() {
        RC_access();
        RC_dbDelete();
        RC_redirect(RC_uri(1));
    }

}

//      $x = "test  =  2 AND id = 3 OR X = 9 AND z      = 4 AND E = 1 OR c = 0 AND r = 9";
        //       $parts = preg_split('/\s+/', $x );