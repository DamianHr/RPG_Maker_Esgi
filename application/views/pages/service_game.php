<?php

echo "<?xml version=\"1.0\"?>";
echo "<game userid='$user_id'>";
echo $game->asXML();
echo "</game>";