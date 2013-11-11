<div class="jumbotron">
    <div class="container">
        <h2>Your games :</h2>
    </div>

    <div class="container">
        <?php
            $games = array(
                'G1' => array('code' => 'G1', 'name' => 'My Super Game', 'content' => 'XML Bitch !'),
                'G2' => array('code' => 'G2', 'name' => 'My Super Game 2', 'content' => 'XML Bitch 2 !')
            );

            if(!isset($games) || count($games) === 0){
            ?>
                <p>Sorry, there is no game to display for you :(</p>
                <a class="btn btn-primary btn-lg" href="<?php echo site_url("create");?>">Create my first game</a>
            <?php
            } else {
            ?>
                <div class="tabbable tabs-right">
                    <ul class="nav nav-tabs" data-tabs="tabs">
            <?php
                $is_first = true;
                foreach($games as $game) {
                    $class = $is_first ? 'active' : '';
                    echo "
                        <li class='".$class."'>
                            <a href='#".$game['code']."' data-toggle='tab'>".$game['name']."</a>
                        </li>";
                    $is_first = false;
                }
            ?>
                    </ul>
                    <div class="tab-content">
            <?php
                $is_first = true;
                foreach($games as $game) {
                    $class = $is_first ? 'active' : '';
                    echo "
                        <div class='tab-pane fade in  ".$class."' id='".$game['code']."'>
                            <!-- content -->
                            <p>".$game['content']."</p>
                        </div>";
                    $is_first = false;
                }
            ?>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>