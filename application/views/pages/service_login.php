<?php

echo "<?xml version=\"1.0\"?>";
if (!empty($xml_list)) {
    echo "<games userid='$user_id'>";
    foreach ($xml_list as $game) {
        echo "<game id='" . ((string)$game->meta->id) . "'>" . ((string)$game->game->title) . "</game>";
    }
    echo "</games>";
} else {
    echo "<error />";
}