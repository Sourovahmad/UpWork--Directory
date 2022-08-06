<?php
$u = request()->get("u");

$R_u = DB::table("rc_users")->where('id', $u)->first();

$user = user();
$friends = DB::table("tb_friends")->where('user_1', $user->id)->orWhere('user_2', $user->id)->get();
$check_u = DB::table("tb_friends")->where([['user_1', $u], ['user_2', $user->id]])->orWhere([['user_2', $u], ['user_1', $user->id]])->first();
?>
<?php if (count($friends) == 0 && (!$u || empty($R_u))): ?>
    <div class="col-md-12 text-center mt-5 pt-5">
        <img class="mt-4" src="<?= url_image("chat.png") ?>" />
        <div class="mt-5">
            <p>
                لا توجد لديك محادثات حاليا 
            </p>
            <p>
                يمكنك إجراء محادثة جديدة من خلال الحجوزات التي تمت .
            </p>
        </div>

    </div>

<?php else: ?>


    <div class="col-md-4">
        <div class="bg-gray-chat rounded-top p-2">
            <input class="form-control search_friends" placeholder="إبحث عن عضو .." type="search" />
        </div>
        <div class="bg-white" >
            <div style="height: 560px; overflow: auto" class="list-group rounded-0 rounded-bottom list_menu_chat">
                <?php if (empty($check_u) && $u): ?>
                    <?php $_friend_name = @user($u)->username; ?>
                    <div class="list-group-item bg-primary list-group-item-action  pt-2 pb-2 " aria-current="true">
                        <a class="text-white" href="<?= base_url("chat?u=$u") ?>">
                            <?= $_friend_name ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php foreach ($friends as $friend): ?>
                    <?php
                    $friend_id = $friend->user_1;
                    if ($friend_id == $user->id) {
                        $friend_id = $friend->user_2;
                    }
                    $friend_name = @user($friend_id)->username;
                    ?>
                    <div class="list-group-item list-group-item-action friends_li <?= ($friend_id == request()->get("u")) ? "bg-primary" : "" ?>    pt-2 pb-2 " aria-current="true">
                        <a class="<?= ($friend_id == request()->get("u")) ? "text-white" : "text-primary" ?>  " href="<?= base_url("chat?u=$friend_id") ?>">
                            <item class="friends_txt">
                                <?= $friend_name ?>
                            </item>
                            <?php
                            $UnRead = DB::table("tb_message")->where("read", 0)->where("receiver", $user->id)->where("sender", $friend_id)->get();
                            ?>
                            <?php if (count($UnRead) > 0): ?>
                                <span  class="bg-danger text-white"><?= count($UnRead) ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>

    <?php if ($u): ?>
        <div class="col-md-8">
            <div class="bg-gray-chat p-2 rounded-top">
                <img src="<?= base_url("front/img/user.png") ?>">
                <span class="d-inline-block ms-1">
                    <?= @user($u)->username; ?>
                </span>
            </div>

            <div class="position-relative">
                <div style="height: 500px; overflow: auto" class="bg-white p-4 chat_area">

                    <?php
                    $chats = DB::table("tb_message")->where([['sender', $u], ['receiver', $user->id]])->orWhere([['receiver', $u], ['sender', $user->id]])->get();
                    ?>
                    <?php foreach ($chats as $chat): ?>
                        <?= view(RC_urlView("view/chat/block"), ["chat" => $chat, "user" => $user]) ?>
                        <?php
                        $values = array();
                        $values["read"] = 1;
                        DB::table("tb_message")->where("id", $chat->id)->where("receiver", $user->id)->update($values);
                        ?>
                    <?php endforeach; ?>
                </div>
                <div class="position-absolute w-100 h-100 top-0 border-white d-none wrap_chat_images_process" >
                    <a class="d-inline-block m-4 close_chat_images_process" href="javascript:void(0)"><img class="w-50" src="<?= url_image("close.png") ?>"></a>
                    <div class="chat_images_process text-center w-75 m-auto  mt-4"></div>
                </div>
            </div>

            <div class="chat_footer bg-gray-chat  pt-1 pb-1">
                <form action="javascript:void(0)" id="form_chat" method="post"  enctype="multipart/form-data">
                    <input type="hidden" value="1" name="type" />
                    <input type="hidden" value="<?= request()->get("u") ?>" name="receiver" />
                    <div class="row">
                        <div class="col-1 p-0 text-center"> 
                            <a class="text-secondary d-inline-block ms-3 mt-1 fs-4 btn_chat_file" href="javascript:void(0)"><i class="fas fa-file-upload"></i></a>
                            <div class="d-none wrap_chat_file"><input  type="file" name="chat_file" id="files" accept="image/*" /></div>
                        </div>
                        <div class="p-0 col-9">
                            <textarea style="height: 40px;" placeholder="رسالتك .." name="message" class="form-control rounded-pill textarea_chat"></textarea>
                            <div class="text-end chat_audio d-none">
                                <a class="d-inline-block me-3 fs-4 text-danger close_audio d-none" href=""><i class="far fa-trash-alt"></i></a>
                                <div class="chat_audio_content d-inline-block"></div>
                            </div>
                        </div>

                        <div class="col-2 p-0 text-center">
                            <a  class="text-secondary d-inline-block mt-1 me-2 ms-1 fs-4 audio_record" href="javascript:void(0)"><i class="fas fa-microphone-alt"></i></a>
                            <a  class="text-secondary d-inline-block mt-1 me- ms-1 fs-4 inactive text-danger audio_stop d-none" href="javascript:void(0)"><i class="far fa-stop-circle"></i></a>
                            <button type="submit" value="1" name="submit" class="text-secondary d-inline-block fs-4 chat_send mt-1 btn pt-0 pb-0 ps-2 pe-2 align-top d-none" ><i class="far fa-arrow-alt-circle-left"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <?php else: ?>
        <div class="col-md-8 text-center mt-5 pt-5">
            <img class="mt-4" src="<?= url_image("chat.png") ?>" />
            <div class="mt-5">
                <p>
                    يمكنك إجراء محادثة جديدة من خلال الحجوزات التي تمت .
                </p>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>