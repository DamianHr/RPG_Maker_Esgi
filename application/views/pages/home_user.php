

<div class="jumbotron">
    <div class="container">
        <h1>Hello, <?php echo $nickname ?>!</h1>

        <div
            style="background: #f5e79e; border-radius: 5px; padding: 20px; font-size: 15px; border:1px solid #d58512;margin:50px 50px 0">
            <p>
                We're currently in Beta !
            </p>

            <p>
                Encounter a problem ? Don't go crazy and tell us about it ! <br/>
                We'll do our best fixing things as quickly as we can and finalize the darn thing soon ;).
            </p>

            <p> The RPG Maker crew.</p>
        </div>
    </div>
</div>
<div class="container">
<!--    Use only if we want to disable and not hide the buttons-->
    <style type="text/css">
        .inactive {
            pointer-events: none;
            background-color: #444444;
            cursor: default;
            /*pointer-elements : none;*/
        }
    </style>

    <img height="250px" width="1200px" id="imageContainer" src="../img/banner.jpg"
         style="box-shadow: 0 0 10px 0 #656565; "/>
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row" >

        <?php if ($create) { ?>
        <div class="col-lg-4">
            <h2>Create</h2>

            <p>Where all thing begin, let's create YOUR game !
            </p>
                <p><a class="btn btn-primary btn-lg" href="<?php  echo site_url("create"); ?>" >Create &raquo;</a></p>
        </div>
        <?php } ?>
        <?php if ($list) { ?>
            <div class="col-lg-4">
            <h2>Manage</h2>

            <p>See and manage the games that you have created !</p>
            <p><a class="btn btn-primary btn-lg" href="<?php echo site_url("list");  ?>">Manage &raquo;</a></p>
        </div>
        <?php } ?>
        <?php if ($home_user) { ?>
            <div class="col-lg-4">
            <h2>Play</h2>

            <p>Wanna play a little game ? Let's see what the community has for you !</p>
            <p><a class="btn btn-primary btn-lg" href="<?php  echo site_url("home_user"); ?>">Play &raquo;</a></p>
        </div>
        <?php } ?>
    </div>
</div>