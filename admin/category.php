<?php
include("./include/header.php");

$query_categories = "SELECT * FROM categories ORDER BY id DESC";
$categories = $db->query($query_categories);

if (isset($_GET['action']) && isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = $db->prepare('DELETE FROM categories WHERE id = :id');

    $query->execute(['id' => $id]);

    header("Location:category.php");
    exit();
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>دسته بندی ها</h3>
                <a href="new_category.php" class="btn btn-outline-primary">ایجاد دسته</a>
            </div>

            <div class="table-responsive">
                <form action="post">
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
                                        <td><?php echo $category['id'] ?></td>
                                        <td><?php echo $category['title'] ?></td>
                                        <td>
                                            <a href="edit_category.php?id=<?php echo $category['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                                            <a href="category.php?action=delete&id=<?php echo $category['id'] ?>" class=" btn btn-outline-danger">حذف</a>
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