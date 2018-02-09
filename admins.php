
<?php

require_once('includes/check.inc.php');

check_member();
check_admin();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once('templates/head.part.php');?>
        <!-- Emphasize menu button -->
        <style>#profile-menu-line-settings{border-bottom:solid .125rem gray;}</style>
        <title>Admins' room</title>
    </head>
        <?php require_once('templates/nav.part.php');?>
    <body>
        <div class="wrapper">
            <?php require_once('templates/profile_menu.part.php');?>
            <!-- Intro -->
            <div class="intro">
                <h1>Admins' room</h1>
            </div>

            <div class="header2">
                <ul class="settings-ul">
                    <li>
                    	<a href="#" title="Visits">Visits</a>
                    </li>
                    <li>
                        <a href="admin_search_statistic.php" title="Search statistic">Search statistic</a>
                    </li>
                    <li>
                        <a href="admin_members_control.php" title="Members control">Members control</a>
                    </li>
                    <li>
                        <a href="admin_post_office.php" title="Post office">
                            Post office <i class="icon" <?php if ($admin_notif_unreaded !== 0) { echo 'data-badge="'.$admin_notif_unreaded.'"';}?>></i>
                        </a>
                    </li>
                </ul>

                <!-- For Admin num 1 -->
                <?php if ($_SESSION['username'] === 'admin'):?>
                <ul class="settings-ul">
                    <li>
                        <a href="admin_notifications.php" title="Notifications">Notifications</a>
                    </li>
                </ul>
                <?php endif;?>

            </div>
        </div>
        <?php require_once('templates/script_bottom.part.php');?>
    </body>
    <?php require_once('templates/footer.part.php');?>
</html>