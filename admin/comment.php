<?php
include("./include/header.php");

$query_comments = "SELECT * FROM comments ORDER BY id DESC";
$comments = $db->query($query_comments);

if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action == "delete") {

        $query = $db->prepare('DELETE FROM comments WHERE id = :id');
        $query->execute(['id' => $id]);
        header("Location:comment.php");
        exit();
        
    } else {
        $query = $db->prepare("UPDATE comments SET status='1' WHERE id = :id");
        $query->execute(['id' => $id]);
        header("Location:comment.php");
        exit();
    }
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

            <h3 class="mt-5">کامنت ها</h3>

            <div class="table-responsive">
                <form action="post">
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
                                        <td><?php echo $comment['id'] ?></td>
                                        <td><?php echo $comment['name'] ?></td>
                                        <td><?php echo $comment['comment'] ?></td>
                                        <td>
                                            <?php
                                                if ($comment['status']) {
                                                    ?>
                                                <a href="#" class="btn btn-outline-success">تایید </a>
                                            <?php
                                                } else {
                                                    ?>
                                                <a href="comment.php?action=approve&id=<?php echo $comment['id'] ?>" class="btn btn-outline-info">در انتظار تایید</a>

                                            <?php
                                                }
                                                ?>
                                            <a href="comment.php?action=delete&id=<?php echo $comment['id'] ?>" class="btn btn-outline-danger">حذف</a>
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