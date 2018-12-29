<?php

require_once('includes/check.inc.php');
check_member();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Settings</title>
        <?php require_once('templates/head.part.php');?>

        <!-- Emphasize menu button -->
        <style>#profile-menu-line-settings{border-bottom:solid .125rem gray;}</style>
    </head>
        <?php require_once('templates/nav.part.php');?>
    <body>
        <div class="wrapper">
            <?php require_once('templates/profile_menu.part.php');?>

            <!-- Intro -->
            <div class="intro">
                <h1>Settings</h1>
            </div>

            <!-- Content -->
            <div class="header2">
                <?php
                    if (empty($errors) === false) {
                        foreach($errors as $error) {
                            echo $error, '<br />';
                        }
                    }
                ?>
                <ul class="settings-ul">
                    <li>
                        <a href="settings_general.php" title="General info">General</a>
                    </li>
                    <li>
                        <a href="settings_photo.php" title="Change photo">Profile photo</a>
                    </li>
                    <li>
                        <a href="settings_password.php" title="Change password">Password</a>
                    </li>
                    <li>
                        <a href="settings_deactivate.php" title="Deactivation">Deactivate account</a>
                    </li>
                </ul>
                
                <ul class="settings-ul">

                    <!--Only for Admin-->
                    <?php if ($admin_ok == true):?>
                        <li>
                            <a href="admins.php" title="Admins">
                                Admins' room <i class="icon" <?php if ($admin_notif_unreaded !== 0) { echo 'data-badge="'.$admin_notif_unreaded.'"';}?>></i>
                            </a>
                        </li>
                    <?php endif;?>

                    <li>
                        <form action="includes/logout.inc.php" method="POST">
                            <button type="submit" name="submit" title="Log out">
                            	Log out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <?php require_once('templates/script_bottom.part.php');?>
    </body>
    <?php require_once('templates/footer.part.php');?>
</html>