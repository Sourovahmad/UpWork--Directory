<?php if ($chat->type == 1): ?>
    <?php if ($chat->sender == $user->id): ?>
        <div class="text-end">
            <div class="bg-green-chat pt-2 pb-2 ps-3 pe-3 rounded-pill d-inline-block mb-2 fs-7">
                <?= $chat->message ?>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-gray-chat pt-2 pb-2 ps-3 pe-3 rounded-pill d-table fs-7 mb-2">
            <?= $chat->message ?>
        </div>
    <?php endif; ?>
<?php endif; ?>


<?php if ($chat->type == 2): ?>
    <?php if ($chat->sender == $user->id): ?>
        <div class="text-end">
            <div class="bg-green-chat p-1 rounded d-inline-block mb-2 fs-7"><img src="<?= image_origin($chat->audio) ?>" alt="" />
                <?php if ($chat->message): ?>
                    <div class="text-start mb-1 mt-1"><?= $chat->message ?></div>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="bg-gray-chat p-1 rounded d-inline-block mb-2 fs-7"><img src="<?= image_origin($chat->audio) ?>" alt="" />
            <?php if ($chat->message): ?>
                <div class="text-start mb-1 mt-1"><?= $chat->message ?></div>
            <?php endif; ?>
        </div>
<div></div>
    <?php endif; ?>
<?php endif; ?>

<?php if ($chat->type == 3): ?>
    <?php if ($chat->sender == $user->id): ?>
        <div class="text-end">
            <div class="playback">
                <audio src="<?= image_origin($chat->audio) ?>" controls id="audio-playback" class="hidden"></audio>
            </div>
        </div>
    <?php else: ?>
        <div class="playback">
            <audio src="<?= image_origin($chat->audio) ?>" controls id="audio-playback" class="hidden"></audio>
        </div>
    <?php endif; ?>
<?php endif; ?>
