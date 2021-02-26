<?php

$query_slider = "SELECT * FROM `posts_slider`";
$posts_slider = $db->query($query_slider);

?>

<section>
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

        <?php

        if ($posts_slider->rowCount() > 0) {

            foreach ($posts_slider as $post_slider) {
                $id_post = $post_slider['post_id'];
                $query_posts = "SELECT * FROM posts WHERE id = $id_post";

                $post = $db->query($query_posts)->fetch();

                ?>

                <div class="carousel-item <?php echo ($post_slider['active']) ? 'active' : ""; ?>" style="height: 650px">
                    <img src="./upload/posts/<?php echo $post['image'] ?>" class="d-block w-100 h-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $post['title'] ?></h5>
                        <p><?php echo substr($post['body'], 0, 200) . "..." ?></p>
                        <a href="single.php?post=<?php echo $post['id'] ?>" class="btn btn-danger"> مشاهده </a>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>
</section>