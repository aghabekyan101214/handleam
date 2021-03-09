<?php
abstract class Model {
    
    protected $db;
    public $lang;
    public $val;
    public $currency;
    public $currency_symbol;
    
    public function __construct(){
        //$this->db = new DataBase("localhost", "root", "", "handle", "+4:00");
        $this->db = new DataBase("localhost", "handlea_smart", "Smart.2018", "handlea_smart", "+4:00");
    }
    
    public function getConfig(){
        echo json_encode([
            "lang" => $this->lang,
            "val" => $this->val,
            "currency" => $this->currency,
            "currency_symbol" => $this->currency_symbol
        ]);
    }
    
    public function __call($name, $value){
        return false;
    }
    
    public function getListJson(){
        if(!isset($_GET["group"]) || !isset($_GET["parent"])){
            echo json_encode([]);
        }
        echo json_encode($this->getList($_GET["group"], $_GET["parent"]));
    }
    
    public function addView($name = '', $id = '') {
        $this->db->query("UPDATE `$name` SET `view`=`view`+1 WHERE `id`='$id'");
    }
    
    public function getPages($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(!empty($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }
       
        if(!empty($filter['type'])){
            $where .= " AND `type`='".$filter['type']."'";
        }
        
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title`, `descr_".$this->lang."` AS `descr` FROM `pages` $where  ORDER BY `id` ASC");
        
        if(!empty($filter['id']) || !empty($filter['type'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }

    public function getBanner($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['orderby_rand']) && $filter['orderby_rand']==true){
            $orderBy = "ORDER BY RAND()";
        }else{
            $orderBy = "ORDER BY `id` ASC";
        }
        
        if(isset($filter['limit'])){
           $limits =  $filter['limit'];
            $limit = "limit $limits";
        } else {
             $limit = '';
        }
        
        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }
       
        if(isset($filter['type'])){
            $where .= " AND `type`='".$filter['type']."'";
        }
       
        if(isset($filter['type_large_small']) && $filter['type_large_small']=="true"){
            $where .= " AND `type`='large' OR `type`='small'";
        }
        
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title` FROM `banner` $where  $orderBy $limit");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getCat($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }

       
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title` FROM `cat` $where  ORDER BY `id` DESC");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getGoodsType($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }
        
        if(isset($filter['catID'])){
            $where .= " AND `catID`='".$filter['catID']."'";
        }

       
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title` FROM `goods_type` $where  ORDER BY `id` DESC");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }    
    
    public function getGoodsTypeJSON() {
        echo json_encode($this->getGoodsType(["catID"=>$_GET["catID"]]));
    }

    
    public function getGoods($filter = []) {
        $where = "WHERE `id` IS NOT NULL";
        
        if(isset($filter['orderby_rand']) && $filter['orderby_rand']==true){
            $orderBy = "ORDER BY RAND()";
        }else{
            $orderBy = "ORDER BY `id` DESC";
        }

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }
       
        if(isset($filter['status'])){
            $where .= " AND `status`='".$filter['status']."'";
        }
        if(isset($filter['typeID'])){
            $where .= " AND `typeID`='".$filter['typeID']."'";
        }
        if(isset($filter['catID'])){
            $where .= " AND `catID`='".$filter['catID']."'";
        }
        if(isset($filter['discount_start'])){
            $where .= " AND `discount`>='".$filter['discount_start']."'";
        }
        if(isset($filter['limit'])){
           $limits =  $filter['limit'];
            $limit = "limit $limits";
        } else {
             $limit = '';
        }
        
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title`, `descr_".$this->lang."` AS `descr`, `meta_".$this->lang."` AS `meta` FROM `goods` $where $orderBy $limit");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        } else {
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getSlide($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }

        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title`,  `descr_".$this->lang."` AS `descr`, `btn_".$this->lang."` AS `btn` FROM `slide` $where  ORDER BY `id` DESC");
        
        if(isset($filter['id']) || !empty($filter['selectID'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getBlog($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }
        
        if(!empty($filter['limit'])){
           $limits =  $filter['limit'];
            $limit = "limit $limits";
        } else {$limit = '';}
        
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title`,  `descr_".$this->lang."` AS `descr` FROM `blog` $where  ORDER BY `id` DESC $limit");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getPartner($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }

        $select = $this->db->query("SELECT * FROM `partners` $where  ORDER BY `id` DESC");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getService($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }

       
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title`,  `descr_".$this->lang."` AS `descr` FROM `services` $where  ORDER BY `id` DESC");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    
    public function getGallery($filter = []) {
        $where = "WHERE `id` IS NOT NULL";

        if(isset($filter['id'])){
            $where .= " AND `id`='".$filter['id']."'";
        }

       
        $select = $this->db->query("SELECT *, `title_".$this->lang."` AS `title` FROM `gallery` $where  ORDER BY `id` DESC");
        
        if(isset($filter['id'])) {
            return $select->fetch_assoc();
        }else{
            return $select->fetch_all(MYSQLI_ASSOC);
        }

    }
    

    public function getContacts(){
        return $this->db->query("SELECT *, `address_".$this->lang."` AS `address` FROM `contacts`")->fetch_assoc();
    }

    public function getAdmin(){
        return $this->db->query("SELECT * FROM `admin`")->fetch_assoc();
    }
 
    public function getPhoto($group = "", $parent = "", $count = ""){
        $where = "";
        $limit = "";
        if(!empty($group)){
            $where .= "WHERE `group`='$group'";
        }
        if(!empty($parent)){
            $where .= " AND `parent`='$parent'";
        }
        if(!empty($count)){
            $limit = "limit $count";
        }
        if($count == 1){
            return $this->db->query("SELECT * FROM `photo` $where ORDER BY `sort` ASC, `photoID` ASC $limit")->fetch_assoc();
        }else{
            return $this->db->query("SELECT * FROM `photo` $where ORDER BY `sort` ASC, `photoID` ASC $limit")->fetch_all(MYSQLI_ASSOC);
        }
    }
    
    
    ///////////// Pay /////////////
    
    // Exchange currency
    public function exchangeCurrency($sum = ""){
        if(isset($_GET["sum"])){
            $sum = $_GET["sum"];
        }
        $row = $this->db->query("SELECT * FROM `currency`")->fetch_assoc();
        if(isset($_GET["sum"])){
            echo ceil($sum / $row[''.$this->currency.'']);
        }else{
            return ceil($sum / $row[''.$this->currency.'']);
        }
    }
    
    public function getGoodsCart($id = ""){
        return $this->db->query("SELECT `id`, `title_".$this->lang."` AS `title`, `price` FROM `goods` LEFT JOIN `photo` ON `photo`.`group`='goods' AND `photo`.`parent`=`goods`.`id` WHERE `id`='$id' ORDER BY `photo`.`sort` ASC, `photo`.`photoID`")->fetch_assoc();
    }
    
    // Order
    public function getOrder($mdorder = ""){
        $where = "";
        if(!empty($mdorder)){
            $where = "WHERE `mdorder`='$mdorder'";
        }
        $order = $this->db->query("SELECT * FROM `order` $where ORDER BY `orderID` DESC");
        if(!empty($mdorder)){
            return $order->fetch_assoc();
        }else{
            return $order->fetch_all(MYSQLI_ASSOC);
        }
        
    }
    
}

