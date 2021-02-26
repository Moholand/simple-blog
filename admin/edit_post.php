<?php
include("./include/header.php");

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $post = $db->prepare('SELECT * FROM posts WHERE id = :id');
    $post->execute(['id' => $post_id]);
    $post = $post->fetch();

    $query_categories = "SELECT * FROM categories";
    $categories = $db->query($query_categories);
}

if (isset($_POST['edit_post'])) {

    if (trim($_POST['title']) != "" && trim($_POST['author']) != "" && trim($_POST['category_id']) != "" && trim($_POST['body']) != "" ) {

        $title = $_POST['title'];
        $author = $_POST['author'];
        $category_id = $_POST['category_id'];
        $body = $_POST['body'];
        
        if( trim($_FILES['image']['name']) != "" ){
         
          $name_image = $_FILES['image']['name'];
          $tmp_name = $_FILES['image']['tmp_name'];
          if (move_uploaded_file($tmp_name, "../upload/posts/$name_image")) {
              echo "Upload Success";
          } else {
              echo "Upload Error";
          }

          $post_update = $db->prepare("UPDATE posts SET title =:title, author=:author, category_id=:category_id, body=:body, image=:image WHERE id=:id");
          $post_update->execute(['title' => $title, 'author' => $author, 'category_id' => $category_id, 'body' => $body, 'image' => $name_image, 'id' => $post_id]);

        }else{

          $post_update = $db->prepare("UPDATE posts SET title =:title, author=:author, category_id=:category_id, body=:body WHERE id=:id");
          $post_update->execute(['title' => $title, 'author' => $author, 'category_id' => $category_id, 'body' => $body, 'id' => $post_id]);

        }

        header("Location:post.php");
        exit();

    } else {
        header("Location:edit_post.php?id=$post_id&err_msg= تمام فیلد ها الزامی هست");
        exit();
    }
}

?>

<div class="container-fluid">
    <div class="row">

        <?php include('./include/sidebar.php') ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 p-4">

            <div class="d-flex justify-content-between mt-5">
                <h3>ویرایش مقاله</h3>
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
            <form method="post" class="mb-5" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">عنوان : </label>
                    <input type="text" class="form-control" value="<?php echo $post['title'] ?>" name="title" id="title">
                    <small class="form-text text-muted">نام مقاله را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="author">نویسنده : </label>
                    <input type="text" class="form-control" value="<?php echo $post['author'] ?>" name="author" id="author">
                    <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
                </div>
                <div class="form-group">
                    <label for="category_id">دسته بندی : </label>
                    <select class="form-control" name="category_id" id="category_id">
                        <?php
                        if ($categories->rowCount() > 0) {
                            foreach ($categories as $category) {
                                ?>
                                <option value="<?php echo $category['id'] ?>" <?php echo ($category['id'] == $post['category_id']) ? "selected" : "" ?>> <?php echo $category['title'] ?> </option>

                        <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">متن مقاله : </label>
                    <textarea class="form-control" name="body" id="body" rows="3">
                        <?php echo $post['body'] ?>
                    </textarea>
                    <small class="form-text text-muted">متن مقاله را وارد کنید.</small>
                </div>

                <img class="img-fluid" src="../upload/posts/<?php echo $post['image'] ?>" alt="">
                <div class="form-group">
                    <label for="image">تصویر : </label>
                    <input type="file" class="form-control" name="image" id="image">
                    <small class="form-text text-muted">تصویر مقاله را وارد کنید.</small>
                </div>

                <button type="submit" name="edit_post" class="btn btn-outline-primary">ویرایش</button>
            </form>

        </main>

    </div>

</div>


<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('body');
</script>

</body>
</html>