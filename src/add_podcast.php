<?php

require_once('includes/check.inc.php');
check_member();

if ($host_ok === false){
    header('Location: redirect.php?message=/error');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add new podcast</title>
        <?php require_once('templates/head.part.php');?>
    </head>
        <?php require_once('templates/nav.part.php');?>
    <body>
        <div class="wrapper">
            <!--Intro-->
            <div class="intro">
                <h1>Add new podcast</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis repellendus magnam exercitationem reprehenderit. Dolorem, a! Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <hr>
            </div>
            <?php
                $message = isset($_REQUEST['message']) ? $_REQUEST['message'] : null;
                switch($message) {
                    case '/there_is_an_unproved_podcast':
                        echo '<h4 class="error">There is already one unpproved podcast, you can\'t add another one.</h4>';
                        break;
                    case '/the_only_field_that_can_be_empty_is_tags':
                        echo '<h4 class="error">The only field that can be empty is "tags".</h4>';
                        break;
                    case '/subject_max_40_intro_max_207_author_max_128_charecters':
                        echo '<h4 class="error">Subject should be maximum 40 charecters, intro 207 charecters and athor 128.</h4>';
                        break;
                    case '/text_max_5000_charecters':
                        echo '<h4 class="error">Text should be maximum 5000 charecters.</h4>';
                        break;
                    case '/duration_max_8_charecters':
                        echo '<h4 class="error">Audio duration should be maximum 8 charecters.</h4>';
                        break;
                    case '/image_error':
                        echo '<h4 class="error">There is an error with the image you uploaded.</h4>';
                        break;
                    case '/audio_error':
                        echo '<h4 class="error">There is an error with the audio you uploaded.</h4>';
                        break;
                    case '/only_jpg_allowed':
                        echo '<h4 class="error">Only jpg allowed.</h4>';
                        break;
                    case '/only_mp3_allowed':
                        echo '<h4 class="error">Only mp3 allowed.</h4>';
                        break;
                    case '/image_is_to_big':
                        echo '<h4 class="error">Image is too big, 1 Mb maximum.</h4>';
                        break;
                    case '/audio_is_to_big':
                        echo '<h4 class="error">Audio file is too big, 30 Mb maximum.</h4>';
                        break;
                    case '/success':
                        echo '<h4 class="success">Thank you for adding podcast. Now go to podcast and "approve" this if you don\'t see any mistakes, or "reject" if you want to cancel posting that. Anyway, in order to make it available for all users, it needs to be approved by 2 admins or hosts.</h4>';
                        break;
                }
            ?>
            <div class="wrapper-small2">
                <form method="POST" action="includes/add_podcast.inc.php" enctype='multipart/form-data' class="form">

                    <!-- Subject -->
                    <span class="span-form">Subject</span>
                    <input type="text" name="subject" onkeyup="countCharsInTextfield(this,40,'message_title');" placeholder="Subject ..." required>
                    <div id="message_title" class="original"></div>

                    <input type="hidden" name="_token" value="<?= $_SESSION['_token'];?>">

                    <!-- Intro -->
                    <textarea name="intro" onkeyup="countCharsInTextfield(this, 207,'intro_text');" placeholder="Intro ..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required></textarea>
                    <div id="intro_text" class="original"></div>

                    <!-- Content -->
                    <textarea name="text" onkeyup="countCharsInTextfield(this, 5000,'message_status');" placeholder="Content ..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required></textarea>
                    <div id="message_status" class="original"></div>

                    <!-- Tags -->
                    <span class="span-form">Tags</span>
                    <input type="name" name="tags" onkeyup="countCharsInTextfield(this, 1000,'story_tags');" value="podcast, ">
                    <div id="story_tags" class="original"></div>

                    <!-- Author -->
                    <span class="span-form">Author</span>
                    <input type="text" name="author" onkeyup="countCharsInTextfield(this,128,'story_author');" value="Unknown" required>
                    <div id="story_author" class="original"></div>

                    <!-- Audio duration -->
                    <span class="span-form">Audio duration</span>
                    <input type="text" name="duration" value="00:00:00" required>

                    <!-- Audio -->
                    <span class="span-form">Choose mp3</span>
                    <input type='file' name='audio' id="notif-upload-img" accept=".mp3" required>

                    <!-- Image -->
                    <span class="span-form">Choose an image</span>
                    <input type='file' name='img' id="notif-upload-img" accept=".jpg" required>

                    <button type="submit" name="publish" class="button">Publish</button>
                </form>
            </div>
        </div>
        <?php require_once('templates/script_bottom.part.php');?>
    </body>
    <?php require_once('templates/footer.part.php');?>
</html>