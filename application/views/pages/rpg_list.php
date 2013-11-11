<div class="jumbotron">
    <div class="container">
        <h2>Your games :</h2>
    </div>
    <style type="text/css">
        .main_wrapper {
            font-size: 17px;
        }

        #games_tab {

        }

        .situation {
            list-style: ;
        }
    </style>
    <div class="container main_wrapper">
        <?php
            if(!$games || count($games) === 0){
            ?>
                <p>Sorry, there is no game to display for you. :(</p>
                <a class="btn btn-primary btn-lg" href="<?php echo site_url("create");?>">Create my first game</a>
            <?php
            } else {
            ?>
                <div class="tabbable tabs-right" id="games_tab">
                    <ul class="nav nav-tabs" data-tabs="tabs">
            <?php
                $is_first = true;
                foreach($games as $game) {
                    $class = $is_first ? 'active' : '';
                    echo "
                        <li class='".$class."'>
                            <a href='#".((string)$game->meta->id)."' data-toggle='tab'>".((string)$game->game->title)."</a>
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
                    echo "<div class='situation tab-pane fade in  ".$class."' id='".((string)$game->meta->id)."'>";
                    foreach($game->game->situation as $situation) {
                        echo "<ul> <!-- Situation -->
                                <li>
                                    <label>Situation ".$situation['code']."</label>
                                    <table>
                                        <tr> <!-- Exposition -->
                                            <td>Exposition :</td>
                                            <td>".$situation->exposition."</td>
                                        </tr>";
                        if(isset($situation->question['label']))
                            echo "
                                        <tr> <!-- QUESTION -->
                                            <td>Question :</td>
                                            <td>".$situation->question['label']."</td>
                                        </tr>";
                        if(isset($situation->question->answerpool->answer)) {
                            echo "
                                        <tr><!-- Answers -->
                                            <td>Answers :</td>
                                            <td>
                                                <ul>";
                            foreach($situation->question->answerpool->answer as $answer) {
                                echo "              <li>
                                                        ".@$answer."
                                                    </li>";
                            }
                            echo "                  </ul>
                                            </td>
                                        </tr>";
                        }
                        echo "      </table>
                                </li>
                            </ul>";
                    }
                    echo    "</div>";
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