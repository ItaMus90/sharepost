<?php require APP_ROOT . "/views/inc/header.php"; ?>

    <a href="<?php echo URL_ROOT; ?>/posts" class="btn btn-light">
        <i class="fa fa-backward"></i> Back
    </a>

    <h2><?php echo $data["post"][0]["title"]; ?></h2>
    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?php echo $data["post"][0]["name"]; ?> on <?php echo $data["post"][0]["created_at"]; ?>
    </div>
    <p>
        <?php echo $data["post"][0]["body"]; ?>
    </p>

    <?php if ($data["post"][0]["user_id"] == $_SESSION["user_id"]) : ?>

        <hr>
        <a href="<?php echo URL_ROOT;?>/posts/edit/<?php echo $data["post"][0]["id"]; ?>" class="btn btn-dark">Edit</a>

        <form class="pull-right" method="post" action="<?php echo URL_ROOT;?>/posts/delete/<?php echo $data["post"][0]["id"]; ?>">
            <input type="submit" value="Delete" class="btn btn-danger">
        </form>

    <?php endif; ?>

<?php require APP_ROOT . "/views/inc/footer.php"; ?>
