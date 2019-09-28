<?php require APP_ROOT . "/views/inc/header.php"; ?>
<?php flash("post_message") ?>
<div class="row mb-3">

    <div class="col-md-6">

        <h1>Posts</h1>

    </div><!--col-md-6-->

    <div class="col-md-6">

        <a href="<?php echo URL_ROOT;?>/posts/add" class="btn btn-primary pull-right">

            <i class="fa fa-pencil"></i> Add Post

        </a>

    </div><!--col-md-6-->


</div><!--row-->

<?php foreach ($data["posts"] as $post): ?>

    <div class="card card-body md-3">

        <h4 class="card-title"><?php echo $post["title"];?></h4>

        <div class="bg-light p-2 mb-3">
            written by User <?php echo $post["name"];?> on <?php echo $post["created_at"]; ?>
        </div>
        <p class="card-text">
            <?php echo $post["body"]; ?>
        </p>
        <a href="<?php echo URL_ROOT;?>/posts/show/<?php echo $post["id"]; ?>" class="btn btn-dark">
            More
        </a>
    </div>

<?php endforeach;?>

<?php require APP_ROOT . "/views/inc/footer.php"; ?>


