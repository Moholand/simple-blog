<?php

include("./include/header.php");

$query_posts = "SELECT * FROM posts ORDER BY id DESC";
$posts = $db->query($query_posts);

if (isset($_GET['action']) && isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = $db->prepare('DELETE FROM posts WHERE id = :id');

    $query->execute(['id' => $id]);

    header("Location:post.php");
    exit();
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>مقالات</h3>
                <a href="new_post.php" class="btn btn-outline-primary">ایجاد مقاله</a>
            </div>

            <div class="table-responsive">
                <form action="post">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>نویسنده</th>
                                <th>دسته بندی</th>
                                <th>تنظیمات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($posts->rowCount() > 0) {
                                foreach ($posts as $post) {
                                    $category_id = $post['category_id'];

                                    $query_post_category = "SELECT * FROM categories WHERE id=$category_id";

                                    $post_category = $db->query($query_post_category)->fetch();
                                    ?>
                                    <tr>
                                        <td><?php echo $post['id'] ?></td>
                                        <td><?php echo $post['title'] ?></td>
                                        <td><?php echo $post['author'] ?></td>
                                        <td><?php echo $post_category['title'] ?></td>
                                        <td>
                                            <a href="edit_post.php?id=<?php echo $post['id'] ?>" class=" btn btn-outline-info">ویرایش</a>
                                            <a href="post.php?action=delete&id=<?php echo $post['id'] ?>" class=" btn btn-outline-danger">حذف</a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </form>
            </div>

        </main>

    </div>

</div>

</body>
</html>