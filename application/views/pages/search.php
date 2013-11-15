<div class="jumbotron">
    <div class="container">
        <h2>Search Information</h2>
    </div>

    <style type="text/css">

        #list_users {
            border: 1px solid silver;
            margin-top: 3%;
        }
        .main_wrapper {
            font-size: 17px;
        }
        #list_users ul {
            list-style-type: none;
        }

        hr {
            border-top: 1px solid #c0c0c0;
            margin-right: 10%;
            margin-left: 9%;
        }

        .author {
            font-weight: bold;
            font-size: 22px;
            font-variant: small-caps;
            margin-left: 3%;
        }

        .game {
            font-style: italic;
            font-size: 20px;
            text-decoration: underline;
            font-weight: bold;
            margin-left: 5%;
        }

        .all_games {
            background-color: #d8d8d8;
            border-left: 5px solid #000000;
            margin-right: 5%;
            margin-left: 5%;
        }

        .summary {
            margin-left: 7%;
            font-style: oblique;
        }
    </style>
    <div class="container main_wrapper">

        <form method="post" autocomplete="off" id="search" action="<?php echo site_url("search") ?>">

            <label for="author_input" style="display: inline">Veuillez entrer le nom d'un auteur pour voir ses
                livres</label>
            <input type="text" name="author" id="author_input" maxlength="60" required="This field is required"
                   class="form-control" style="width: 37%;"/>
            <label for="summary" style="display: inline">Voir les résumés ?</label>
            <input id="summary" type="checkbox" name="summary" value="1"/>
            <input type="submit" value="Search" class="btn btn-success" style="margin-left: 1%"/>
        </form>
        <?php
        if (!$list_infos_users || count($list_infos_users) === 0) {
            ?>
            <p>Aucun résultat à afficher.</p>
        <?php
        } else {
            ?>
            <div id="list_users">
                <ul>
                    <?php
                    foreach ($list_infos_users as $nickname => $infos_user) {
                        ?>
                        <li class="author"><?php echo $nickname; ?></li>
                        <?php if ($infos_user !== false) { ?>
                            <ul class="all_games">
                                <?php foreach ($infos_user as $user_game) { ?>
                                    <li class="game"> <?php echo $user_game->game->title; ?></li>
                                    <?php if (isset($summary)) { ?>
                                        <div
                                            class="summary"><?php if (isset($user_game->meta->summary) && !empty($user_game->meta->summary)) {
                                                echo "&raquo;" . $user_game->meta->summary;
                                            } else {
                                                echo "Pas de résumé disponible";
                                            } ?></div>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            Aucun jeu pour cet auteur !
                        <?php } ?>
                        <hr/>
                    <?php } ?>
                </ul>
            </div>
        <?php
        }
        ?>
    </div>
</div>