<?php 

include("./include/header.php");

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
    
    $entity = $_GET['entity'];
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == "delete") {

        if ($entity == "post") {
            $query = $db->prepare('DELETE FROM posts WHERE id = :id');

        } elseif ($entity == "category") {
            $query = $db->prepare('DELETE FROM categories WHERE id = :id');

        } else {
            $query = $db->prepare('DELETE FROM comments WHERE id = :id');
        }

        $query->execute(['id' => $id]);
        
    } else {
        $query = $db->prepare("UPDATE comments SET status = '1' WHERE id = :id");
        $query->execute(['id' => $id]);
    }
}

$query_posts = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db->query($query_posts);

$query_comments = "SELECT * FROM comments WHERE status = '0' ORDER BY id DESC";
$comments = $db->query($query_comments);

$query_categories = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db->query($query_categories);

?>

<div class="container-fluid">
    <div class="row">

        <?php include("./include/sidebar.php"); ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 pb-2 my-3 border-bottom">
                <h1 class="h2">داشبورد</h1>
            </div>

            <h3>مقالات اخیر</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>نویسنده</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if ($posts->rowCount() > 0) {

                            foreach ($posts as $post) {
                                ?>
                                <tr>
                                    <td><?php echo $post['id'] ?></td>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo $post['author'] ?></td>
                                    <td>
                                        <a href="edit_post.php?id=<?php echo $post['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                                        <a href="index.php?entity=post&action=delete&id=<?php echo $post['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-danger" role="alert">
                                مقاله ای برای نمایش وجود ندارد ! ! !
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <h3>کامنت های اخیر</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام</th>
                            <th>کامنت</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($comments->rowCount() > 0) {
                                foreach ($comments as $comment) {
                                    ?>
                                    <tr>
                                        <td> <?php echo $comment['id'] ?> </td>
                                        <td> <?php echo $comment['name'] ?> </td>
                                        <td> <?php echo $comment['comment'] ?> </td>
                                        <td>
                                            <a href="index.php?entity=comment&action=approve&id=<?php echo $comment['id'] ?>" class="btn btn-outline-success">تایید</a>
                                            <a href="index.php?entity=comment&action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-danger" role="alert">
                                        کامنتی برای نمایش وجود ندارد!!!
                                    </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <h3>دسته بندی ها</h3>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>تنظیمات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                                ?>
                                <tr>
                                    <td> <?php echo $category['id'] ?> </td>
                                    <td> <?php echo $category['title'] ?> </td>
                                    <td>
                                        <a href="edit_category.php?id=<?php echo $category['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                                        <a href="index.php?entity=category&action=delete&id=<?php echo $category['id'] ?>" class="btn btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php
                                }
                            } else {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    دسته ای برای نمایش وجود ندارد!!!
                                </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </main>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>
</html>