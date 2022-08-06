<?php

namespace App\Http\Controllers\front;

use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Json extends Controller {

    public function index() {
        
    }

    public function e() {

        Mail::send('emails.reminder', [], function ($m) {
            $m->from('info@hilul.net', 'Your Application');

            $m->to("rocsel.eg@gmail.com", "ahmed")->subject('Your Reminder!');
        });

        DIE;
        $to = "rocsel.eg@gmail.com";
        $subject = "Email Subject";

        $message = 'Dear <br>';
        $message .= "We welcome you to be part of family<br><br>";
        $message .= "Regards,<br>";

// Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <info@hilul.net>' . "\r\n";
        $headers .= 'Cc: info@hilul.net' . "\r\n";

        echo mail($to, $subject, $message, $headers);

        /*
          //        $user = 1;
          Mail::send('emails.reminder', [], function ($m){
          $m->from('hello@app.com', 'Your Application');

          $m->to("rocsel.sa@gmail.com", "ahmed")->subject('Your Reminder!');
          });
         * 
         */

        $to = "rocsel.eg@gmail.com";

        /*
          $subject = "Email Subject";

          $message = 'Dear <br>';
          $message .= "We welcome you to be part of family<br><br>";
          $message .= "Regards,<br>";

          // Always set content-type when sending HTML email
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          // More headers
          $headers .= 'From: <info@rocsel.com>' . "\r\n";
          $headers .= 'Cc: myboss@example.com' . "\r\n";

          echo mail($to, $subject, $message, $headers);
         * 
         */
        /*
          $to      = 'nobody@example.com';
          $subject = 'the subject';
          $message = 'hello';
          $headers = 'From: webmaster@example.com'       . "\r\n" .
          'Reply-To: webmaster@example.com' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();

          mail($to, $subject, $message, $headers);
         * 
         */
    }

    private function value() {

        $post = request()->post("post");
        $posts = json_decode($post, TRUE);
        $value = array();
        foreach ($posts as $key => $val):
            if ($key == "password") {
                $value[$key] = sha1($val);
            } else {
                $value[$key] = $val;
            }
        endforeach;

        return $value;
    }

    public function test() {



        //       echo json_encode([array("id" => "id_1", "con" => 200 , "status"=>"asdas" ,"test"=>"xxx" )]);



        $test[] = array(
            "title" => "heelo",
            "content" => "this is conten",
        );

        $test[] = array(
            "title" => "cccccc",
            "content" => "this is conten",
        );

        echo json_encode([array("id" => "544", "name" => "sssss", "status" => "a:", "test" => "zdasd", "con" => "cccc"), array("id" => "544", "name" => "xxx", "status" => "a:", "test" => "zdasd", "con" => "cccc")]);
    }

    public function pages() {
        $lang = request()->post("lang");
        if (!$lang):
            $lang = "ar";
        endif;

        $x = 0;
        $data = array();
        $q = DB::table("tb_feature")->where("feature", 2)->get();
        foreach ($q as $r):
            $data[$x]["id"] = $r->id;
            $data[$x]["title"] = RC_trans($r->title, $lang);
            $data[$x]["content"] = RC_trans($r->content, $lang);
            $data[$x]["date_insert"] = $r->date_insert;
            $data[$x]["image"] = "https://pointapp.sa/files/19-%D8%A8%D8%A7%D9%86%D8%B1.png";
            $x++;
        endforeach;

        echo json_encode($data);
    }

    public function social() {
        $lang = request()->post("lang");
        if (!$lang):
            $lang = "ar";
        endif;

        $x = 0;
        $data = array();
        $q = DB::table("tb_feature")->where("feature", 3)->get();
        foreach ($q as $r):
            $data[$x]["id"] = $r->id;
            $data[$x]["title"] = RC_trans($r->title, $lang);
            $data[$x]["content"] = RC_trans($r->content, $lang);
            $data[$x]["date_insert"] = $r->date_insert;
            $x++;
        endforeach;

        echo json_encode($data);
    }

    public function contact() {

        $lang = request()->post("lang");
        $data = array();
        $data["id"] = "asdasdasdas";

        $value = array();
        $value['name'] = request()->post("name");
        $value['email'] = request()->post("email");
        $value['mobile'] = request()->post("mobile");
        $value['content'] = request()->post("content");
        $value['view'] = 0;
        $value['date_insert'] = RC_dateTime();
        DB::table("tb_contact")->insert($value);

        $data = array();
        $data["success"] = 1;
        $data["id"] = "1";
        $data["data"] = "1";
        $data["msg"] = "تم إرسال رسالتكم بنجاح إلى الإداره وسيتم الرد عليكم عما قريب";
        echo json_encode([$data]);
    }

    public function register() {

        $code = random_int(1000, 100000);
        $lang = request()->post("lang");
        $type = request()->post("type");

        $post = request()->post("post");
        $posts = json_decode($post, TRUE);

        $value = array();
        $value = $this->value();
        $value['code'] = $code;
        $value['active'] = 0;
        $value['date_insert'] = RC_dateTime();
        $db = db_insert("rc_users", $value);

        $message = h1("تفعيل حسابك");
        $message .= p(" مرحبا ، {$posts["username"]} ");
        $message .= p("تم تسجيل عضويتك بنجاح يتبقى لك خطوة لإستخدام حساب و هي تفعيل حسابك ");
        $message .= p("كود تفعيل حسابك هو : ");
        $message .= p($code);
        rc_email($posts["email"], "تفعيل حسابك", $message);

        $data = array();
        $data["success"] = 1;
        $data["id"] = $db;
        $data["data"] = 1;
        $data["msg"] = "تم تسجيل عضويتك بنجاح";
        echo json_encode([$data]);
    }

    public function activation() {

        $success = 0;
        $lang = request()->post("lang");
        $msg = "كود التفعيل المدخل غير صحيح";

        $post = request()->post("post");
        $posts = json_decode($post, TRUE);
        $code = $posts['code'];

        $r = DB::table("rc_users")->where("code", $code)->first();
        if ($r) {
            $value = array();
            $value["active"] = 1;
            db_update(["id" => $r->id], "rc_users", $value);
            $success = 1;
            $msg = "تم تفعيل حسابك بنجاح يمكنك الآن تسجيل الدخول لحسابك";
        }


        $data = array();
        $data["success"] = $success;
        $data["data"] = 1;
        $data["msg"] = $msg;
        echo json_encode([$data]);
    }

    public function login() {

        $id = 0;
        $data = 0;
        $success = 0;
        $lang = request()->post("lang");
        $msg = "خطأ في البريد الإلكتروني او كلمة المرور";

        $post = request()->post("post");
        $posts = json_decode($post, TRUE);
        $email = $posts['email'];
        $password = sha1($posts['password']);

        $r = DB::table("rc_users")->where("email", $email)->where("password", $password)->first();
        if ($r) {

            /*
              $value = array();
              $value["active"] = 1;
              db_update(["id" => $r->id], "rc_users", $value);
             */

            if ($r->active == 1) {
                $id = $r->id;
                $success = 1;
                $msg = "تم تسجيل الدخول بنجاح .";
            }

            if ($r->active == 0) {
                $success = 0;
                $data = 1;
                $msg = "حسابك غير مفعل ، يجب تفعيل حسابك من خلال كود التفعيل المرسل علي الإيميل";
            }

            if ($r->active == 2) {
                $success = 0;
                $msg = "تم حظر حسابك من قبل الإداره";
            }
        }


        $_data = array();
        $_data["success"] = $success;
        $_data["data"] = $data;
        $_data["msg"] = $msg;
        $_data["id"] = $id;
        echo json_encode([$_data]);
    }

    public function select() {

        $lang = request()->post("lang");
        $feature = request()->post("feature");

        if (!$lang):
            $lang = "ar";
        endif;

        $x = 0;
        $data = array();
        $q = DB::table("tb_feature")->where("feature", $feature)->get();
        foreach ($q as $r):
            $data[$x]["id"] = $r->id;
            $data[$x]["title"] = RC_trans($r->title, $lang);
            $x++;
        endforeach;

        echo json_encode($data);
    }

    public function form() {

        $lang = request()->post("lang");
//        $post = request()->post("post");
//        $posts = json_decode($post, TRUE);

        $data = array();
        $data["id"] = "asdasdasdas";

        $value = array();
        $value = $this->value();

//        foreach ($posts as $key => $val):
//            $value[$key] = $val;
//        endforeach;
        // $my_array_data = json_decode($posts, TRUE);
//        $json_string   = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
//        $json_string   = '{"rfid":"122312","CCCC":"YYYY"}';
//        $value['email'] = "ddd";
//        $value['mobile'] = 123123;
//        $value['content'] = implode("##", $my_array_data); 
//        $value['view'] = "0";   
        $value['date_insert'] = RC_dateTime();
        DB::table("tb_contact")->insert($value);

        $data = array();
        $data["success"] = 1;
        $data["msg"] = "تم إرسال رسالتكم بنجاح إلى الإداره وسيتم الرد عليكم عما قريب";
        echo json_encode([$data]);
    }

    public function password() {

        // config ..
        $id = 0;
        $data = 0;
        $success = 0;
        $lang = request()->post("lang");
        $post = request()->post("post");
        $posts = json_decode($post, TRUE);

        // posts ..
        $user = $posts['user'];
        $password_old = sha1($posts['password_old']);
        $password = sha1($posts['password']);

        $r = DB::table("rc_users")->where("id", $user)->where("password", $password_old)->first();
        if ($r) {

            $value = array();
            $value["password"] = $password;
            db_update(["id" => $r->id], "rc_users", $value);

            $id = $r->id;
            $success = 1;
            $msg = "تم تعديل كلمة المرور بنجاح";
        } else {
            $success = 0;
            $msg = "كلمة المرور المدخلة غير صحيحة";
        }


        $_data = array();
        $_data["success"] = $success;
        $_data["data"] = $data;
        $_data["msg"] = $msg;
        $_data["id"] = $id;
        echo json_encode([$_data]);
    }

    public function get() {

        // config ..
        $id = 0;
        $data = "eeee";
        $success = 0;
        $msg = "";
        $lang = request()->post("lang");
//        $post = request()->post("post");
//        $posts = json_decode($post, TRUE);
        // posts ..
//        $user = $posts['user'];
//        $password_old = sha1($posts['password_old']);
//        $password = sha1($posts['password']);

        $r = DB::table("rc_users")->where("id", 158)->first();
        if ($r) {
            $v = array();
            $v["username"] = $r->username;
            $v["email"] = $r->email;
            $v["mobile"] = $r->mobile;
            $data = json_encode($v);
            $success = 1;
        } else {
            $success = 0;
            $msg = "حدث خطأ ما يرجل المحاولة فيما بعد";
        }


        $_data = array();
        $_data["success"] = $success;
        $_data["data"] = $data;
        $_data["msg"] = $msg;
        $_data["id"] = $id;
        echo json_encode([$_data]);
    }

    public function home() {

        // config ..
        $id = 0;
        $data = "eeee";
        $success = 0;
        $msg = "";
        $lang = request()->post("lang");
//        $post = request()->post("post");
//        $posts = json_decode($post, TRUE);
        // posts ..
//        $user = $posts['user'];






        $_data = array();
        $_data["success"] = $success;
        $_data["data"] = $data;
        $_data["msg"] = $msg;
        $_data["id"] = $id;
        echo json_encode([$_data]);
    }

    public function upload() {

        $fileName = $_FILES['sendimage']['name'];
        $tempPath = $_FILES['sendimage']['tmp_name'];
        $fileSize = $_FILES['sendimage']['size'];
        $upload_path =  'public/files/'; // set upload folder path 


        move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 

        $_data = array();
        $_data["title"] = $fileName;
        $_data["data"] = 1;
        $_data["msg"] = 1;
        $_data["id"] = 1;
        echo json_encode([$_data]);
    }

}
