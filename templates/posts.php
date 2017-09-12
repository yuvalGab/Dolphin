<?php

    //get relevant post from database
    $sth = $db->prepare("SELECT * FROM posts WHERE contentID = '$contentID' ORDER BY postID DESC");
    $sth->execute();
    $posts = $sth->fetchAll();

?>
<div class="posts">
    <div class="new-post">
        <p>הוסף תגובה:</p>
        <input id="nickname" type="text" placeholder="כינוי">
        <textarea id="comment" rows="4" placeholder="תוכן התגובה"></textarea>
        <input id="content-id" type="text" style="display: none;" value="<?= $contentID; ?>">
        <button id="send-post" class="button">שלח</button>
    </div>
    <p id="send-error"></p>
    <hr />
    <p>תגובות:</p>
    <div class="posts-list">
        <?php if(!empty($posts)) : ?>
            <?php foreach($posts as $row) : ?>
                <div class="comment-box">
                    <p class="post-date"><?= $row['post_date']; ?></p>
                    <p class="nickname">כינוי: <strong><?= $row['nickname']; ?></strong></p>
                    <p class="main-comment"><?= $row['comment']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p id="show-error">אין תגובות</p>
        <?php endif; ?>
    </div>
</div>