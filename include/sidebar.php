<?php

$query_categories = "SELECT * FROM categories";

$categories = $db->query($query_categories);

?>

<div class="col-md-4 mb-3">

    <div class="card bg-light my-2">
        <div class="card-body">
            <h5 class="card-title">جستجو در وبلاگ</h5>
            <form action="search.php" method="get">
                <div class="input-group mb-3">
                    <div class="input-group-prepend order-2">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="icofont-search"></i>
                        </button>
                    </div>
                    <input name="search" type="text" class="form-control" placeholder="جستجو...">
                </div>
            </form>
        </div>
    </div>

    <div class="list-group mb-3">

        <a href="#" class="list-group-item list-group-item-action active">
            دسته بندی ها
        </a>

        <?php

        if ($categories->rowCount() > 0) {

            foreach ($categories as $category) {
                ?>
                <a href="index.php?category=<?php echo $category['id'] ?>" class="list-group-item list-group-item-action">
                    <?php echo $category['title'] ?>
                </a>
        <?php
            }
        }
        ?>

    </div>

    <div class="card bg-light mb-3 p-3">
        <div class="card-body">

            <?php

            if (isset($_POST['subscribe'])) {
                if (trim($_POST['name']) != "" && trim($_POST['email']) != "") {
                    
                    $name = $_POST['name'];
                    $email = $_POST['email'];

                    $subscribe_insert = $db->prepare("INSERT INTO subscribers (name, email) VALUES (:name, :email)");
                    $subscribe_insert->execute(['name' => $name, 'email' => $email]);
                } else {
                    echo "فیلد ها نباید خالی باشند";
                }
            }

            ?>
            
            <form method="post">
                <div class="form-group">
                    <label for="name">نام</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="نام خود را وارد کنید...">

                </div>
                <div class="form-group">
                    <label for="email">ایمیل</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="ایمیل خود را وارد کنید...">
                </div>

                <button type="submit" name="subscribe" class="btn btn-outline-primary btn-block">ارسال</button>
            </form>
        </div>
    </div>

    <div class="card p-3">
        <div class="card-body">
            <h3> درباره ما </h2>
            <p class="text-justify">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
            </p>
        </div>
    </div>

</div>