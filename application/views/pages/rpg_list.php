<div class="jumbotron">
    <div class="container">
        <h2>Your games :</h2>
    </div>

    <style type="text/css">
        .main_wrapper {
            font-size: 17px;
        }

        .situation label {
            width: 100%;
            text-align: center;
            background: linear-gradient(to bottom, #cfcfcf 0%, #d0d0d0 100%) repeat-x;
            border: 1px solid #c0c0c0;
        }

        .situation li {
            list-style: none;
            background-color: #e6eaff;
        }

        .content {
            padding-left: 3%;
        }

        .nav.nav-tabs a {
            font-weight: bold;
            font-variant: small-caps;
        }

    </style>
    <div class="container main_wrapper">
        <?php
        if (!$games || count($games) === 0) {
            ?>
            <p>Sorry, there is no game to display for you. :(</p>
            <a class="btn btn-primary btn-lg" href="<?php echo site_url("create"); ?>">Create my first game</a>
        <?php
        } else {
            ?>
            <div class="tabbable tabs-right" id="games_tab">
                <ul class="nav nav-tabs" data-tabs="tabs">
                    <?php
                    $is_first = true;
                    foreach ($games as $game) {
                        $class = $is_first ? 'active' : '';
                        echo "
                        <li class='" . $class . "'>
                            <a href='#" . ((string)$game->meta->id) . "' data-toggle='tab'>" . ((string)$game->game->title) . "</a>
                        </li>";
                        $is_first = false;
                    }
                    ?>
                </ul>
                <div class="tab-content">
                    <?php
                    $is_first = true;
                    foreach ($games as $game) {
                        $class = $is_first ? 'active' : '';
                        echo "<div class='situation tab-pane fade in  " . $class . "' id='" . ((string)$game->meta->id) . "'>";
                        foreach ($game->game->situation as $situation) {
                            echo "<ul> <!-- Situation -->
                                <li>
                                    <label class='situation'>Situation " . $situation['code'] . "</label>
                                    <div class='content'>
                                    <table >
                                        <tr> <!-- Exposition -->
                                            <td>&raquo; Exposition :</td>
                                            <td>" . $situation->exposition . "</td>
                                        </tr>";
                            if (isset($situation->question['label']))
                                echo "
                                        <tr> <!-- QUESTION -->
                                            <td>Question :</td>
                                            <td>" . $situation->question['label'] . "</td>
                                        </tr>";
                            if (isset($situation->question->answerpool->answer)) {
                                echo "
                                        <tr><!-- Answers -->
                                            <td>Answers :</td>
                                            <td>
                                                <ul>";
                                foreach ($situation->question->answerpool->answer as $answer) {
                                    echo "              <li>
                                                        " . @$answer . "
                                                    </li>";
                                }
                                echo "                  </ul>
                                            </td>
                                        </tr>";
                            }
                            echo "      </table>
                                    </div>
                                </li>
                            </ul>";
                        }
                        echo "</div>";
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