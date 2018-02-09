<?php

require "../includes/check.inc.php";
check_member();

if (isset($_POST['postId']) && $_POST['type'] == "deletePod") {

    $pod_id = preg_replace('#[^a-z0-9]#i','',strtolower($_POST['postId']));
    $pod = R::findOne('pod', 'id = ?', array($pod_id));

    $message_to_admins = ucfirst($log_username).' deleted podcast "'.$pod->subject.'" created by: '.$pod->host;

    // ------------------------------
    $users_ids = explode(', ', $pod->added_to_favs);
    foreach ($users_ids as $id) {
        $user_data = R::findOne("membersdata", "user_id = ?", array($id));
        $favorite = str_replace($pod_id.', ', '', $user_data->favorite_pod);
        
        R::getAll("UPDATE membersdata
                    SET favorite_pod = ?
                    WHERE user_id = ?",
                    array($favorite, $id));
    }
    exit;
    // TODO: this stuff ---------------

    $post = R::dispense('postoffice');
    $post->type = 'attention';
    $post->important = 1;
    $post->message = $message_to_admins;
    $post->date = $date;
    R::store($post);
    R::trash($pod);
    R::getAll("ALTER TABLE pod AUTO_INCREMENT = $pod_id");

    unlink("../media/img/imgs/pod".$pod_id.".jpg");
    unlink("../media/audio/podcast".$pod_id.".mp3");

    echo '<span class="success">Podcast has been deleted</span>';
}

if (isset($_POST['postId']) && $_POST['type'] == "deleteStory") {

    $story_id = preg_replace('#[^a-z0-9]#i','',strtolower($_POST['postId']));
    $story = R::findOne('stories', 'id = ?', array($story_id));

    $message_to_admins = ucfirst($log_username).' deleted story "'.$story->subject.'" created by: '.$story->writer;

    $post = R::dispense('postoffice');
    $post->type = 'attention';
    $post->important = 1;
    $post->message = $message_to_admins;
    $post->date = $date;
    R::store($post);
    R::trash($story);
    R::getAll("ALTER TABLE stories AUTO_INCREMENT = $story_id");

    unlink("../media/img/imgs/story".$story_id.".jpg");

    echo '<span class="success">Story has been deleted</span>';
}
?>