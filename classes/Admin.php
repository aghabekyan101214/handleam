<?php
class Admin extends Model{

    public $user_cnt;

    public function __construct(){
        parent::__construct();
        $this->user_cnt = new User();
    }

    // Sign

    public function login(){
        if(empty($_POST['login']) || empty($_POST['password'])){
            unset($_SESSION['admin']);
            return false;
        }
        $admins = $this->db->query("SELECT * FROM `admin` WHERE `email`='".$_POST['login']."' AND `password`='".$_POST['password']."'");
        if($admins->num_rows == 1){
            $_SESSION['admin'] = $admins->fetch_assoc();
            echo json_encode([
                "error" => false,
                "location" => [
                    "href" => false,
                    "hash" => false,
                    "reload" => true
                ]
            ]);
            return false;
        }else{
            unset($_SESSION['admin']);
            echo json_encode([
                "error" => [
                    "field" => ["password", "email"],
                    "message" => '<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Սխալ մոտքանուն կամ գաղտնաբառ!</div>'
                ],
                "location" => false
            ]);
            return false;
        }
    }

    public function logOut(){
        unset($_SESSION['admin']);
    }

    public function addCat(){
        $parent_id = !empty($_POST['parent_category']) ? $_POST['parent_category'] : "NULL";
        if($parent_id != "NULL") $parent_id = intval($parent_id);
        $show_in_menu = !empty($_POST['show_in_menu']) ? intval($_POST['show_in_menu']) : 0;
        $page_type = !empty($_POST['page_type']) ? intval($_POST['page_type']) : 0;
        $this->db->query("INSERT INTO `cat`(`title_am`, `title_en`,`title_ru`, `parent_id`, `show_in_menu`, `page_type` )VALUES('".$_POST['title_am']."','".$_POST['title_en']."','".$_POST['title_ru']."', ".$parent_id.", ".$show_in_menu.", ".$page_type.")");
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function addGoodsType(){
        $this->db->query("INSERT INTO `goods_type`(`catID`, `title_am`, `title_en`,`title_ru` )VALUES('".$_POST['catID']."', '".$_POST['title_am']."','".$_POST['title_en']."','".$_POST['title_ru']."')");
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function addGoods (){
        $this->db->query("INSERT INTO `goods`(`title_am`, `title_en`, `title_ru`, `meta_am`, `meta_en`, `meta_ru`, `catID`, `typeID`, `descr_am`, `descr_en`, `descr_ru`, `discount`, `price`, `type`, `status`) VALUES ('', '', '', '', '', '', '".$_POST['catID']."', '".$_POST['goodsTypeID']."', '', '', '', '0', '0', '', '0')");
        $id = $this->db->insert_id;
        header("Location: /admin/edit?id=$id");
        exit;
    }


    public function addSlide (){
        $this->db->query("INSERT INTO `slide`(`title_am`, `title_en`, `title_ru`, `descr_am`, `descr_en`, `descr_ru`, `btn_am`, `btn_en`, `btn_ru`, `link`)VALUES('".$_POST['title_am']."','".$_POST['title_en']."', '".$_POST['title_ru']."', '".$_POST['descr_am']."', '".$_POST['descr_en']."' , '".$_POST['descr_ru']."', '".$_POST['btn_am']."', '".$_POST['btn_en']."' , '".$_POST['btn_ru']."', '".$_POST['link']."')");
    }

    public function addBlog (){
           $date = date('d-m-Y');
        $this->db->query("INSERT INTO `blog`(`title_am`, `title_en`, `title_ru`, `descr_am`, `descr_en`, `descr_ru`, `date`, `view`)VALUES('".$_POST['title_am']."','".$_POST['title_en']."', '".$_POST['title_ru']."', '', '' , '', '$date', '0')");
    }


    public function addBanner(){
        $this->db->query("INSERT INTO `banner`(`title_am`, `title_en`, `title_ru`, `link`, `type`)VALUES('".@$_POST['title_am']."','".@$_POST['title_en']."', '".@$_POST['title_ru']."',  '".@$_POST['link']."',  '".@$_POST['type']."')");
    }

    public function removeBanner () {
        foreach($this->getPhoto("banner", $_POST['id']) as $photo){
            $_POST['cat'] = $photo["group"];
            $_POST['photoID'] = $photo["photoID"];
            $this->removePhoto();
        }
        $this->db->query("DELETE FROM `banner` WHERE `id`='".$_POST['id']."'");
    }

    // Remove
    public function removeCat () {
        $this->db->query("DELETE FROM `cat` WHERE `id`='".$_POST['id']."'");
    }

     public function removeBlog () {
        $this->db->query("DELETE FROM `blog` WHERE `id`='".$_POST['id']."'");
    }

    public function removeType () {
        $this->db->query("DELETE FROM `goods_type` WHERE `id`='".$_POST['id']."'");
    }

    public function removeSlide () {
        $this->db->query("DELETE FROM `slide` WHERE `id`='".$_POST['id']."'");
    }


    public function removeGoods () {
        $this->db->query("DELETE FROM `goods` WHERE `id`='".$_POST['id']."'");
    }

    public function changeField(){
        if(!empty($_POST['table_name']) && !empty($_POST['field_name']) && !empty($_POST['id_name']) && !empty($_POST['id_value'])){
            $table_name = ltrim($_POST['table_name']);
            $field_name = ltrim($_POST['field_name']);
            $field_value = ltrim($_POST['field_value']);
            $id_name = ltrim($_POST['id_name']);
            $id_value = ltrim($_POST['id_value']);
            if($field_name == 'parent_id') {
                $field_value = !empty($field_value) ? $field_value : "NULL";
                if($field_value != "NULL") $field_value = intval($field_value);
                $this->db->query("UPDATE `$table_name` SET `$field_name`=".$field_value." WHERE `$id_name`='$id_value'");
            } else {
                if($field_name == 'show_in_menu') $field_value = intval($field_value);
                if($field_name == 'is_separate_page') $field_value = intval($field_value);
                $this->db->query("UPDATE `$table_name` SET `$field_name`='$field_value' WHERE `$id_name`='$id_value'");
            }
        }
    }

    public function imageUpload(){
        $dir = 'public/gallery/pages/';
        $filename = $_FILES['file']['name'];
        $path = $dir.$filename;
        $link = '/public/gallery/pages/'.$filename;
        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
        if ($_FILES['file']['type'] == 'image/png'
        || $_FILES['file']['type'] == 'image/jpg'
        || $_FILES['file']['type'] == 'image/gif'
        || $_FILES['file']['type'] == 'image/jpeg'){
            copy($_FILES['file']['tmp_name'], $path);
            //echo stripslashes(json_encode(array('filelink' => $link)));
            exit;
        }
    }

    public function imageGetJson(){

    }

    // Photo

    public function addPhoto(){
        $group = $_POST['cat'];
            if($_POST['act']=='change'){
                $res = $this->db->query("SELECT * FROM `photo` WHERE `group`='".$_POST['group']."' AND `parent`='".$_POST['parent']."'");
                while($row = $res->fetch_assoc()){
                    if(is_file("public/gallery/$group/".$row['photoID'].".jpg")){
                        unlink("public/gallery/$group/".$row['photoID'].".jpg");
                    }elseif(is_file("public/gallery/$group/".$row['photoID'].".gif")){
                        unlink("public/gallery/$group/".$row['photoID'].".gif");
                    }else{
                        unlink("public/gallery/$group/large/".$row['photoID'].".jpg");
                        unlink("public/gallery/$group/middle/".$row['photoID'].".jpg");
                        unlink("public/gallery/$group/small/".$row['photoID'].".jpg");
                    }
                }
                $this->db->query("DELETE FROM `photo` WHERE `group`='".$_POST['group']."' AND `parent`='".$_POST['parent']."'");
            }
            foreach ($_FILES["file"]["error"] as $key => $error) {
                $this->db->query("INSERT INTO `photo` (`group`, `parent`, `sort`) VALUES ('".$_POST['group']."', '".$_POST['parent']."', '1')");
                    $name = $this->db->insert_id.".jpg";
                if ($group=='goods') {
	                addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/small/" . $name, 400, 230, 'crop', false);
	                addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/large/" . $name, 900, 700, 'crop', false);

                } elseif ($group=='blog'){
	                addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/small/".$name, 600, 400, 'crop', false);
	                addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/large/".$name, 1200, 675, 'resize', false);

                } elseif ($group=='slide'){
                    addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/".$name, 1920, 1080, 'resize', false);
                }
                elseif ($group=='banner'){
                    if($this->getBanner(["id"=>$_POST['parent']])["type"]=="aside"){
                        $name = str_replace(".jpg", ".gif", $name);
                        move_uploaded_file($_FILES['file']['tmp_name'][$key], "public/gallery/$group/".$name);
                        //addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/".$name, 600, 600, 'resize', false);
                    }else{
                        addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/".$name, 900, 530, 'crop', false);
                    }

                } elseif ($group=='pages'){
                   move_uploaded_file ($_FILES['file']['tmp_name'][$key], "public/gallery/pages/$name");

                }   else{
                    addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/large/".$name, 1200, 670, 'crop', false);
                    addImage($_FILES['file']['tmp_name'][$key], "public/gallery/$group/middle/".$name, 900, 530, 'crop', false);
                    addImage("public/gallery/$group/large/".$name, "public/gallery/$group/small/".$name, 400, 230, 'crop', false);
                }
            }
    }

    public function removePhoto(){
        $group = $_POST['cat'];
        $this->db->query("DELETE FROM `photo` WHERE `photoID`='".$_POST['photoID']."'");

        if(is_file("public/gallery/$group/".$_POST['photoID'].".jpg")){
            unlink("public/gallery/$group/".$_POST['photoID'].".jpg");
        }elseif(is_file("public/gallery/$group/".$_POST['photoID'].".gif")){
            unlink("public/gallery/$group/".$_POST['photoID'].".gif");
        }else{
            unlink("public/gallery/$group/large/".$_POST['photoID'].".jpg");
            unlink("public/gallery/$group/middle/".$_POST['photoID'].".jpg");
            unlink("public/gallery/$group/small/".$_POST['photoID'].".jpg");
        }
    }

    public function removeList(){
        if(isset($_POST['listID']) && !empty($_POST['listID'])){
            foreach($this->getList("category", $_POST['listID']) as $cat_1){
                foreach($this->getList("category", $cat_1["listID"]) as $cat_2){
                    foreach($this->getList("category", $cat_2["listID"]) as $cat_3){
                        $this->db->query("DELETE FROM `list` WHERE `listID`='".$cat_3['listID']."'");
                        if(isset($this->getPhoto("category", $cat_3['listID'], 1)["photoID"])){
                            $_POST['cat'] = 'category';
                            $_POST['photoID'] = $this->getPhoto("category", $cat_3['listID'], 1)["photoID"];
                            $this->removePhoto();
                        }
                    }
                    $this->db->query("DELETE FROM `list` WHERE `listID`='".$cat_2['listID']."'");
                    if(isset($this->getPhoto("category", $cat_2['listID'], 1)["photoID"])){
                        $_POST['cat'] = 'category';
                        $_POST['photoID'] = $this->getPhoto("category", $cat_2['listID'], 1)["photoID"];
                        $this->removePhoto();
                    }
                }
                $this->db->query("DELETE FROM `list` WHERE `listID`='".$cat_1['listID']."'");
                if(isset($this->getPhoto("category", $cat_1['listID'], 1)["photoID"])){
                    $_POST['cat'] = 'category';
                    $_POST['photoID'] = $this->getPhoto("category", $cat_1['listID'], 1)["photoID"];
                    $this->removePhoto();
                }
            }
            $this->db->query("DELETE FROM `list` WHERE `listID`='".$_POST['listID']."'");
            if(isset($this->getPhoto("category", $_POST['listID'], 1)["photoID"])){
                $_POST['cat'] = 'category';
                $_POST['photoID'] = $this->getPhoto("category", $_POST['listID'], 1)["photoID"];
                $this->removePhoto();
            }
        }
    }

    public function sortable(){
        $table = ltrim($_POST['table']);
        $id_name = ltrim($_POST['id_name']);
        $id_value = ltrim($_POST['id_value']);
        $sort = ltrim($_POST['sort']);
        if(!empty($table) && !empty($id_name) && !empty($id_value)){
            $this->db->query("UPDATE $table SET `sort`='$sort' WHERE `$id_name`='$id_value'");
        }
    }

}
