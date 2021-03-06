<?php

require_once('includes/check.inc.php');

$rows = R::count("searchstat");
$page_rows = 50;
$last = ceil($rows/$page_rows);

if ($last < 1) {
    $last = 1;
}

$page_num = 1;

if (isset($_GET['page'])) {
    $page_num = preg_replace('#[^0-9]#','', $_GET['page']);
}

if ($page_num < 1) {
    $page_num = 1;
} elseif ($page_num > $last) {
    $page_num = $last;
}

$limit = 'LIMIT ' .($page_num - 1) * $page_rows .',' .$page_rows;

if ($rows == 1) {
    $text_line1 = "<b>1</b> result";
} else {
    $text_line1 = "<b>{$rows}</b> results";
}

if ($last == 1) {
    $text_line2 = "";
} else {
    $text_line2 = "Page <b>{$page_num}</b> of <b>{$last}";
}

$pagination_controls = '';

// Pagination controls
if ($last != 1) {
    if ($page_num > 1) {
        $previous = $page_num - 1;
        $pagination_controls .= '<a href='.$_SERVER['PHP_SELF'].'?page='.$previous.'>
                                    <i class="fas fa-angle-left"></i>
                                </a>';
        // Links on the left of the target page number
        for ($i = $page_num-4; $i < $page_num; $i++) {
            if ($i > 0) {
                $pagination_controls .= '<a href='.$_SERVER['PHP_SELF'].'?page='.$i.'>'.$i.'</a>';
            }
        }
    }

    $pagination_controls .= '<h4>'.$page_num.'</h4>';
    for ($i = $page_num+1; $i <= $last; $i++) {
        $pagination_controls .= '<a href="'.$_SERVER['PHP_SELF'].'?page='.$i.'">'.$i.'</a>';
        if ($i >= $page_num+4) {
            break;
        }
    }

    if ($page_num != $last) {
        $next = $page_num + 1;
        $pagination_controls .= '<a href='.$_SERVER['PHP_SELF'].'?page='.$next.'>
                                    <i class="fas fa-angle-right"></i>
                                </a>';
    }
}

$list = '';
$stats = R::find('searchstat', 'ORDER BY times DESC '.$limit);

if ($stats) {
    foreach ($stats as $stat) {
        $date = date("M j, Y", strtotime($stat->last_date));

        $list .= "  <tr>
                        <td>{$stat->id}</td>
                        <td>{$stat->words}</td>
                        <td>{$stat->times}</td>
                        <td>{$date}</td>
                    </tr>";
    }
}