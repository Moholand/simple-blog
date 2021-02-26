<?php
include("./include/header.php");

if (isset($_POST['add_category'])) {
    if (trim($_POST['title'])) {

        $title = $_POST['title'];

        $category_insert = $db->prepare("INSERT INTO categories (title) VALUES (:title )");
        $category_insert->execute(['title' => $title]);

        header("Location:category.php");
        exit();
    } else {
        header("Location:new_category.php?err_msg=فیلد عنوان الزامی هست");
        exit();
    }
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>ایجاد دسته</h3>
            </div>
            <hr>
            <?php
            if (isset($_GET['err_msg'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['err_msg'] ?>
                </div>
            <?php
            }
            ?>
            <form method="post">
                <div class="form-group">
                    <label for="category">عنوان : </label>
                    <input type="text" class="form-control" name="title" id="category">
                    <small class="form-text text-muted">نام دسته را وارد کنید.</small>
                </div>

                <button type="submit" name="add_category" class="btn btn-outline-primary">ایجاد</button>
            </form>

        </main>

    </div>

</div>