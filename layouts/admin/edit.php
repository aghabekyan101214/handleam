<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $goodsID = $_GET['id'];
} else {
    header('location: /admin/goods');
}
$goods = $cnt->getGoods(["id" => $goodsID]);
$category = $cnt->getCategory($goods['catID']);
$category_id = $category['parent_id'] ?? $category['id'];

if (!isset($goods["id"]) || empty($goods["id"])) {
    header('location: /admin/goods');
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php require "inc/head.php"; ?>
</head>

<body data-ma-theme="indigo">
<main class="main">
    <?php require "inc/header.php" ?>

    <?php require "inc/aside.php" ?>
    <section class="content">
        <div class="content__inner content__inner--sm" style="max-width:1100px;">
            <div class="col-md-12">
                <br>
                <h5>Խմբագրել ապրանքը</h5>
                <br>
            </div>
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Ընտրեք բաժինը</label>
                            <select class="select2 live categories" name="catID" required
                                    data-live="goods, catID, id, <?php echo $goods['id'] ?>"
                                    value="<?php echo $cat['catID'] ?>">
                                <?php foreach ($cnt->getCat() as $cat) { ?>
                                    <option <?php if ($goods['catID'] == $cat['id']) { ?> selected<?php } ?>
                                            value="<?= $cat['id'] ?>"><?= $cat['title'] ?></option>
                                <?php } ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-3">
                            <label>Ընտրեք տեսակը</label>
                            <select class="select2 live" name="goodsTypeID" required
                                    data-live="goods, typeID, id, <?php echo $goods['id'] ?>"
                                    value="<?php echo $cat['typeID'] ?>">
                                <option value="">Ընտրեք տեսակը</option>
                                <?php foreach ($cnt->getGoodsType(["catID" => $category_id]) as $goodsType) { ?>
                                    <option <?php if ($goodsType['id'] == $goods['typeID']) { ?> selected <?php } ?>
                                            value="<?= $goodsType['id'] ?>"><?= $goodsType['title'] ?></option>
                                <?php } ?>
                            </select>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Կարգավիճակ</label>
                                <select class="select2 live" data-minimum-results-for-search="Infinity" required data-live="goods, status, id, <?php echo $goods['id'] ?>" value="<?php echo $cat['status'] ?>">
                                    <option <?php if ($goods['status'] == '1') { ?> selected<?php } ?> value="1">Առկա է
                                    </option>
                                    <option <?php if ($goods['status'] == '0') { ?> selected<?php } ?> value="0">Պատվերով
                                    </option>
                                </select>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ավելացնել պիտակ</label>
                                <select class="select2 live" data-minimum-results-for-search="Infinity" required data-live="goods, status_new, id, <?php echo $goods['id'] ?>" value="<?php echo $cat['status_new'] ?>">
                                    <option <?php if ($goods['status_new'] == '0') { ?> selected<?php } ?> value="0">...</option>
                                    <option <?php if ($goods['status_new'] == '1') { ?> selected<?php } ?> value="1">Նորույթ
                                    </option>
                                </select>
                                <i class="form-group__bar"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Գին</label>
                            <input type="text" class="form-control live"
                                   data-live="goods, price, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['price'] ?>" placeholder="Գին">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-6">
                            <label>Զեղչ %</label>
                            <input type="text" class="form-control live"
                                   data-live="goods, discount, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['discount'] ?>">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-12" style="height:30px;"></div>
                        <div class="col-md-4">
                            <label>AM</label>
                            <input type="text" class="form-control live"
                                   data-live="goods, title_am, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['title_am'] ?>" placeholder="Անվանում ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <label>EN</label>
                            <input type="text" class="form-control live"
                                   data-live="goods, title_en, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['title_en'] ?>" placeholder="Անվանում ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <label>RU</label>
                            <input type="text" class="form-control live"
                                   data-live="goods, title_ru, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['title_ru'] ?>" placeholder="Անվանում ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control live"
                                   data-live="goods, meta_am, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['meta_am'] ?>" placeholder="Թեգ ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control live"
                                   data-live="goods, meta_en, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['meta_en'] ?>" placeholder="Թեգ ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control live"
                                   data-live="goods, meta_ru, id, <?php echo $goods['id'] ?>"
                                   value="<?php echo $goods['meta_ru'] ?>" placeholder="Թեգ ">
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <textarea type="text" class="form-control live editor"
                                      data-live="goods, descr_am, id, <?php echo $goods['id'] ?>"
                                      placeholder="Նկարագրություն"
                                      style="min-height:250px;"><?php echo $goods['descr_am'] ?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <textarea type="text" class="form-control live editor"
                                      data-live="goods, descr_en, id, <?php echo $goods['id'] ?>"
                                      placeholder="Նկարագրություն"
                                      style="min-height:250px;"><?php echo $goods['descr_en'] ?></textarea>
                            <i class="form-group__bar"></i>
                        </div>
                        <div class="col-md-4">
                            <textarea type="text" class="form-control live editor"
                                      data-live="goods, descr_ru, id, <?php echo $goods['id'] ?>"
                                      placeholder="Նկարագրություն"
                                      style="min-height:250px;"><?php echo $goods['descr_ru'] ?></textarea>
                            <i class="form-group__bar"></i>
                        </div>

                    <div class="col-md-12">
                        <?php $group = 'goods'; ?>
                        <?php $parent = $goods['id']; ?>
                        <?php $multiple = true; ?>
                        <?php $photos = $cnt->getPhoto($group, $parent); ?>
                        <div class="p-2"></div>
                        <button class="btn btn-info photo-btn">
                            <i class="zmdi zmdi-cloud-download" style="font-size:25px"></i>
                            <input type="file"
                                   onChange="addPhoto('<?php echo $group ?>', '<?php echo $parent ?>', this, '<?php echo $group ?>'<?php if ($multiple === false) { ?>, 'change'<?php } ?>)"
                                   style="opacity:0;position:absolute;top:0;left:0;width:100%;height:200%;"
                                   <?php if ($multiple === true){ ?>multiple<?php } ?>>
                        </button>
                        <?php foreach ($photos as $photo){ ?>
                            <div class="photo-box card sortable" data-sort="photo, photoID, <?php echo $photo['photoID'] ?>">
                                <span onClick="removePhoto('<?php echo $group ?>', <?php echo $photo['photoID'] ?>)">x</span>
                                <img src="/public/gallery/<?php echo $group ?>/small/<?php echo $photo['photoID'] ?>.jpg">
                            </div>
                        <?php } ?>
                    </div>
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
