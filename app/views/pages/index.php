<?php require APP_ROOT . "/views/inc/header.php"; ?>

<div class="jumbotron jumbotron-fluid text-center">

    <div class="container">

        <div class="card card-body md-3">

            <h4 class="card-title"><?php echo $data["title"];?></h4>

            <p class="card-text">
                <?php echo $data["body"]; ?>
            </p>

        </div>

    </div>

</div>


<?php require APP_ROOT . "/views/inc/footer.php"; ?>


