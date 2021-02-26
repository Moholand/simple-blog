<?php
include("./include/header.php");

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    $category = $db->prepare('SELECT * FROM categories WHERE id = :id');
    $category->execute(['id' => $category_id]);
    $category = $category->fetch();
}

if (isset($_POST['edit_category'])) {

    if (trim($_POST['title']) != "") {

        $title = $_POST['title'];

        $category_update = $db->prepare("UPDATE categories SET title =:title WHERE id=:id");
        $category_update->execute(['title' => $title, 'id' => $category_id]);

        header("Location:category.php");
        exit();

    } else {
        header("Location:edit_category.php?id=$category_id&err_msg= فیلد عنوان الزامی هست");
        exit();
    }
    
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>ویرایش دسته</h3>
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
                    <input type="text" class="form-control" value="<?php echo $category['title'] ?>" name="title" id="category">
                    <small class="form-text text-muted">نام دسته را وارد کنید.</small>
                </div>

                <button type="submit" name="edit_category" class="btn btn-outline-primary">ویرایش</button>
            </form>

        </main>

    </div>

</div>