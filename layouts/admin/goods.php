<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
    <style>
        .nav-category li {
            display: inline-block;
        }
    </style>
</head>
<body data-ma-theme="indigo">
<main class="main">
    <?php require "inc/header.php" ?>

    <?php require "inc/aside.php" ?>
    <?php $categories = $cnt->getCat( isset($_GET['page_type']) ? ['page_type' => $_GET['page_type'], 'page_type_value' => 1] : ['page_type' => 'is_individual_order', 'page_type_value' => 0]); ?>
    <?php $goods = $cnt->getGoods(['filter_in_categories' => array_column($categories, 'id')]); ?>

    <section class="content">
        <div class="content__inner content__inner--sm" style="max-width:1100px;">
            <div class="col-md-12">
                <br><h4>Ավելացնել ապրանք</h4><br>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <ul class='navigation nav-category'>
                        <li class="<?php if(!isset($_GET['page_type'])) echo 'navigation__active'; ?>">
                            <a href="/admin/goods">Հիմնական</a>
                        </li>
                        <li class="<?php if(isset($_GET['page_type']) && $_GET['page_type'] == 'is_individual_order') echo 'navigation__active'; ?>">
                            <a href="/admin/goods?page_type=is_individual_order">Անհատական Պատվերներ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card p-1">
                <div class="card-header nav-bar p-3">
                    <form action="?cmd=addGoods<?php if (isset($_GET['page_type']) && $_GET['page_type'] == 'is_individual_order') echo '&page_type='.$_GET['page_type']; ?>" method="post" style="width:100%;">
                        <div class="row">
                            <div class="col-md-5">
                                <label>Ընտրեք բաժինը</label>
                                <select class="select2" name="catID" required>
                                    <option value="">-----</option>
                                    <?php foreach ($categories as $cat) { ?>
                                        <option value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                                    <?php } ?>
                                </select>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="col-md-5">
                                <label>Ընտրեք տեսակը</label>
                                <select class="select2" name="goodsTypeID" required>
                                </select>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button style="float:right; width:100%" type="submit" class="btn btn-success btn-block">
                                    Ավելացնել
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-block">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bnewsed">
                            <thead class="thead-default">
                            <tr>
                                <th>ID</th>
                                <th>Նկար</th>
                                <th>Անվանում</th>
                                <th>Գին</th>
                                <th>Զեղչ</th>
                                <th width="250">Խմբագրել | Հեռացնել</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($goods as $good) { ?>
                                <?php $photo = $cnt->getPhoto("goods", $good['id'], 1); ?>
                                <tr>
                                    <td><?= $good['id'] ?></td>
                                    <td>
                                        <img src="/public/gallery/<?= $photo['group'] ?>/small/<?= $photo['photoID'] ?>.jpg"
                                             alt="" width="80"/>
                                    </td>
                                    <td><?= $good['title_am'] ?></td>
                                    <td><?= $good['price'] ?></td>
                                    <td><?= $good['discount'] ?>%</td>
                                    <td>
                                        <a href="/admin/edit?id=<?= $good['id'] ?>">
                                            <button class="btn btn-default">Խմբագրել</button>
                                        </a>
                                        <button class="btn btn-danger"
                                                onClick="removeGoods(<?php echo $good['id'] ?>)">Հեռացնել
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="p-1"></div>
        </div>
        <?php require "inc/footer.php" ?>
        <script>
            $(function () {
                $("select[name='catID']").on("change", function () {
                    $.get("?cmd=getGoodsTypeJSON&catID=" + this.value, function (data) {
                        var data = $.parseJSON(data);
                        var list = '<option value="x">--Ընտրել տեսակը--</option>';
                        $.each(data, function (i, item) {
                            list += '<option value="' + item.id + '">' + item.title + '</option>';
                        });
                        $("select[name='goodsTypeID']").html(list);
                    });
                });
            });
        </script>
    </section>
</main>
</body>
</html>
