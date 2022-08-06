<?php

namespace App\Http\Controllers\front;

use App\RC;
use App\RC\Form;
use App\RC\Input;
use App\RC\Tbl;
use App\RC\Block;
use Lang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Chat extends Controller {

    public $table;

    public function index() {
        RC_access();
        $user = user();
        $container = "";

        $block = Block::creat(false, " ");
        $content = view(RC_urlView("view/chat/container"));
        $block->inject($content);

        $container = $block->get(RC_urlForm("block_lists")); // block end ..
        // layout ..
        echo view('front/layout/layout', ["container" => $container]);
    }

    public function audio() {
        $destinationPath = 'public/files';
        if (isset($_FILES['file']) and!$_FILES['file']['error']) {
            $audio = 1111 . ".wav";
            move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath . "/" . $audio);
        }
    }

    public function send() {

        $user = user();

        $message = request()->post("message");
        $type = request()->post("type");
        $receiver = request()->post("receiver");
        $sender = $user->id;
        $audio = "";

        if ($type == 3) {
            $destinationPath = 'public/files';
            if (isset($_FILES['file']) and!$_FILES['file']['error']) {
                $audio = Str::random(13) . ".wav";
                move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath . "/" . $audio);
            }
        }

        if ($type == 2) {
            $destinationPath = 'public/files';
            if (isset($_FILES['chat_file']) and!$_FILES['chat_file']['error']) {
                $audio = Str::random(13) . ".jpg";
                move_uploaded_file($_FILES['chat_file']['tmp_name'], $destinationPath . "/" . $audio);
            }
        }


        $check_friends = DB::table("tb_friends")->where([['user_1', $sender], ['user_2', $receiver]])->orWhere([['user_2', $sender], ['user_1', $receiver]])->first();
        if (empty($check_friends)):
            $values = array();
            $values["user_1"] = $sender;
            $values["user_2"] = $receiver;
            $values["date_insert"] = RC_dateTime();
            DB::table("tb_friends")->insert($values);
        endif;

        $values = array();
        $values["message"] = $message;
        $values["audio"] = $audio;
        $values["type"] = $type;
        $values["receiver"] = $receiver;
        $values["sender"] = $sender;
        $values["read"] = 0;
        $values["date_insert"] = RC_dateTime();
        DB::table("tb_message")->insert($values);

        $data = array();
        $data["success"] = 1;
        echo json_encode($data);
    }

    public function get() {

        $user = user();
        $sender = request()->post("sender");
        $data = "";

        $q = DB::table("tb_message")->where("sender", $sender)->where("receiver", $user->id)->where("read", 0)->get();
        foreach ($q as $r):
            $data .= view(RC_urlView("view/chat/block"), ["chat" => $r, "user" => $user]);

            $values = array();
            $values["read"] = 1;
            DB::table("tb_message")->where("id", $r->id)->where("receiver", $user->id)->update($values);
        endforeach;

        echo json_encode(["data" => $data]);
    }

}
