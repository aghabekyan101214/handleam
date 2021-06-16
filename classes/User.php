<?php

class User extends Model
{

    const SECRET_KEY = 110001079;
    const EDP_REC_ACCOUNT = 'Qav3qVgmwHRr9TsrbqaFxAxgMNn8u5gF6TUaDP';

    public function sendMail()
    {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
            echo json_encode([
                "error" => [
                    "field" => ["name", "email", "message"],
                    "message" => '<p style="color:red">' . (($this->lang == "am") ? "Լրացրեք բոլոր դաշտերը" : "Fill in all the fields") . '</p>'
                ],
                "location" => false
            ]);
            return false;
        }
        if (!preg_match("|[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}|i", $_POST['email'])) {
            echo json_encode([
                "error" => [
                    "field" => ["email"],
                    "message" => '<p style="color:red">' . (($this->lang == "am") ? "Էլ.փոստը պատշաճ չէ" : "Your email is incorrect") . '</p>'
                ],
                "location" => false
            ]);
            return false;
        }

        sendMailSmtp("info@example.com", "BizArt Media contact form", "<br>Name: " . $_POST["name"] . "<br>E-mail: " . $_POST["email"] . "<br>Description: " . $_POST["message"] . "");
        echo json_encode([
            "error" => [
                "field" => false,
                "message" => '<p style="color:green">' . (($this->lang == "am") ? "<i class='fa fa-check-circle'></i> Ձեր հաղորդագրությունը հաջողությամբ ուղարկվել է։" : "<i class='fa fa-check-circle'></i> Your message has been successfully sent") . '</p>'
            ],
            "location" => false,
            "reset" => true,
        ]);
        return false;
    }

    public function getToCart()
    {
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $data = [];
            $total = 0;
            $data['count'] = count($_SESSION['cart']);
            $data['html'] = '<ul>
						<li>';
            foreach ($_SESSION['cart'] as $productID => $info) {

                // $data[] = array_merge($this->getGoodsCart($productID), array(
                // 	 "count" => $info['count'],
                // 	 "photoID" => $this->getPhoto('goods', $productID, 1)["photoID"]
                // ));


                $product_info = $info['info'];
                $lang = $_SESSION['lang'];

                $data['html'] .= '<div class="cart-img-price">
							<div class="cart-img">
								<a href="#"><img style="width: 64px; height: 64px;" src="' . $product_info['image'] . '" alt="' . $product_info['title_' . $lang] . '"></a>
							</div>
							<div class="cart-content">
								<h3><a href="#">' . $product_info['title_' . $lang] . '</a></h3>
								<span class="cart-price">' . $info['count'] . ' x ' . ($info['count'] * $product_info['price']) . ' ֏</span>
							</div>
							<div class="cart-del" data-id="' . $productID . '">
								<i class="pe-7s-close-circle"></i>
							</div>
						</div>
						';
                $total += ($info['count'] * $product_info['price']);
            }
            $data['html'] .= '</li>
				<li>
					<p class="total">
						Ընդամենը:
						<span>' . $total . ' ֏</span>
					</p>
				</li>
				<li>
					<p class="buttons">
						<a class="my-cart" href="/cart">Զամբյուղ</a>
					</p>
				</li>
			</ul>';

            if ($this->check_is_ajax()) {
                echo json_encode($data);
                exit;
            }
            return $data;
        } else {
            return [];
        }
    }

    function check_is_ajax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    }

    public function getToCartJSON()
    {
        echo json_encode($this->getToCart());
    }

    public function addToCart()
    {
        if (!isset($_POST["productID"]) || empty($_POST["productID"])) {
            return false;
        }

        $product = $this->getGoods(["id" => $_POST["productID"]]);
        $productID = $product["id"];

        if (!empty($product)) {
            $_SESSION["cart"][$productID]['info'] = $product;
            $_SESSION["cart"][$productID]['info']["descr_am"] = "";
            $_SESSION["cart"][$productID]['info']["descr_en"] = "";
            $_SESSION["cart"][$productID]['info']["descr_ru"] = "";
            $_SESSION["cart"][$productID]['info']["descr"] = "";
            $photoID = $this->getPhoto('goods', $productID, 1)['photoID'];
            $_SESSION["cart"][$productID]['info']['image'] = "/public/gallery/goods/small/$photoID.jpg";
            $_SESSION["cart"][$productID]['info']['price'] = ($product["discount"] > 0) ? ($product["price"] - ($product["price"] / 100 * $product["discount"])) : $product["price"];

            if (!empty($_SESSION["cart"][$productID]['count'])) {
                $_SESSION["cart"][$productID]['count'] += (!empty($_POST['count'])) ? $_POST['count'] : 1;
            } else {
                $_SESSION["cart"][$productID]['count'] = (!empty($_POST['count'])) ? $_POST['count'] : 1;
            }
        }

        echo "Product added to cart! Please update cart.";

    }

    public function removeToCart()
    {
        if (!isset($_POST["productID"]) || empty($_POST["productID"])) {
            return false;
        }

        if (isset($_SESSION["cart"][$_POST["productID"]])) {
            unset($_SESSION["cart"][$_POST["productID"]]);
        }

        echo "ok";
        exit;
    }

    public function get_filter($page_type = 0)
    {
        return [
            "cat" => $this->db->query("SELECT * FROM cat WHERE `page_type`=" . intval($page_type) . "")->fetch_all(MYSQLI_ASSOC),
            "type" => $this->db->query("SELECT * FROM goods_type")->fetch_all(MYSQLI_ASSOC)
        ];
    }

    public function ax_get_filtered_products()
    {
        $where = ' `goods`.`id` IS NOT NULL ';
        $page_type = $_GET['page_type'] ?? 0;
        $categories = $this->get_filter($page_type)['cat'];
        $cat_ids = array_column($categories, 'id');
        $ids = implode("','", $cat_ids);
        $where .= " AND `catID` IN ('" . $ids . "')";
        if (isset($_POST['orderby_rand']) && $_POST['orderby_rand'] == "true") {
            $orderBy = "ORDER BY `status` DESC, `finalPrice` ASC";
        } else {
            $orderBy = "ORDER BY `goods`.`id` DESC";
        }

        if (!empty($_POST['cat'])) {
            $cats = $_POST['cat'];
            foreach ($categories as $c) {
//                if($c['id'] == $_POST['cat'][0] && !is_null($c['parent_id']) ){
//                    $cats []= $c['parent_id'];
//                } else
                if ($c['parent_id'] == $_POST['cat'][0]) {
                    $cats [] = $c['id'];
                }
            }
            $where_cat = '';
            $or = '';
            foreach ($cats as $key => $value) {
                $where_cat .= " $or `goods`.`catID` = '" . $value . "' ";
                $or = 'OR';
            }
            $where .= ' AND (' . $where_cat . ')';
        }
        if (!empty($_POST['type'])) {
            $where_type = '';
            $or = '';
            foreach ($_POST['type'] as $key => $value) {
                $where_type .= " $or `goods`.`typeID` = '" . $value . "' ";
                $or = 'OR';
            }
            $where .= ' AND (' . $where_type . ')';
        }
        if (isset($_POST['amount'][0]) && !empty($_POST['amount'][0])) {
            $where .= ' AND `goods`.`price`>=' . $_POST['amount'][0] . '';
        }
        if (isset($_POST['amount'][1]) && !empty($_POST['amount'][1])) {
            $where .= ' AND `goods`.`price`<=' . $_POST['amount'][1] . '';
        }

        $query = $this->db->query("SELECT *, CASE WHEN `discount` > 0 THEN `price` - (`price` * discount / 100) ELSE `price` END AS `finalPrice` FROM `goods` WHERE $where GROUP BY `goods`.`id` $orderBy");

        if ($query->num_rows > 0) {
            $data = [];
            foreach ($query->fetch_all(MYSQLI_ASSOC) as $item) {
                $item["size"] = (isset($this->getGoodsType(["id" => $item['typeID']])["title"])) ? $this->getGoodsType(["id" => $item['typeID']])["title"] : " ";
                $item["photo"] = "/public/gallery/goods/small/" . $this->getPhoto("goods", $item['id'], 1)["photoID"] . ".jpg";
                $data[] = $item;
            }
            echo json_encode($data);
            exit;
        }

        echo "{}";
        exit;

    }


    public function getPay()
    {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo 'Զամբյուղը դատարկ է';
            exit;
        }
        if (!isset($_POST["amount"]) || empty($_POST["amount"])) {
            echo 'Գումարը նշված չէ';
            exit;
        }
        if (empty($_POST["name"]) || empty($_POST["phone"]) || empty($_POST["address"])) {
            echo 'Լրացրեք պարտադիր դաշտերը';
            exit;
        }

        $order_date = json_encode($_SESSION['cart'], JSON_UNESCAPED_UNICODE);

        $this->db->query("INSERT INTO `order`(`order_data`, `pay_method`, `mdorder`, `pay_amount`, `status`, `client_name`, `client_phone`, `client_address`, `date`) VALUES ('" . $order_date . "', '" . @$_POST['method'] . "', '', '" . @$_POST["amount"] . "', '0', '" . @$_POST["name"] . "', '" . @$_POST["phone"] . "', '" . @$_POST["address"] . "', NOW())");
        $orderID = $this->db->insert_id;
        $_SESSION['cart'] = [];

        if ($_POST['method'] == "card") {
            $this->getPayArca($_POST["amount"], $orderID);
        } elseif ($_POST['method'] == "idram") {
            echo '{"order_id":"' . $orderID . '"}';
            exit;
        } elseif ($_POST['method'] == "cache") {
            echo "ok";
            exit;
        } else {
            echo 'Անհայտ վճարային համակարգ․';
            exit;
        }
    }

    private function getPayIdram($amount, $orderID)
    {
        $url = 'https://banking.idram.am/Payment/GetPayment';
        $lang = strtoupper($_SESSION['lang'] ?? 'AM');
        $account = "100000114";

        $data = [
            "EDP_LANGUAGE" => $lang,
            "EDP_REC_ACCOUNT" => $account,
            "EDP_AMOUNT" => $amount,
            "EDP_BILL_NO" => $orderID,
            "RESULT_URL" => urlencode('http://' . $_SERVER['HTTP_HOST'] . '/?cmd=idramCallback')
        ];

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        var_dump($result);
    }

    public function idramCallback()
    {
        var_dump($_GET, $_REQUEST);
        die;
    }

    private function getPayArca($amount, $orderID)
    {
        $merchant = '34540688_api';
        $password = 'Nq5tBahb';
        $currency = '051';
        $return_url = urlencode('http://' . $_SERVER['HTTP_HOST'] . '/?cmd=getConfirmArca');
        $language = 'hy';
        $description = urlencode('Handle.am / Payment');
        $arcaID = $orderID;

        if ($data = file_get_contents('https://ipay.arca.am/payment/rest/register.do?userName=' . $merchant . '&password=' . $password . '&orderNumber=' . $arcaID . '&amount=' . $amount . '00&currency=' . $currency . '&returnUrl=' . $return_url . '&description=' . $description . '&language=' . $language . '')) {
            $data = json_decode($data);
            if (!isset($data->orderId)) {
                echo "Վճարման խափանում 1";
                exit;
            }
            $orderId = $data->orderId;
            $form_url = $data->formUrl;
            $error_code = $data->errorCode;
            if ($error_code == 0 && $form_url != '') {
                $this->db->query("UPDATE `order` SET `mdorder`='$orderId' WHERE `orderID`='$arcaID'");
                echo '{"url":"' . $form_url . '"}';
                exit;
            } else {
                echo "Վճարման խափանում 2";
                exit;
            }
        } else {
            echo "Վճարման խափանում 3";
            exit;
        }
    }

    public function getConfirmArca()
    {
        $merchant = '34540688_api';
        $password = 'Nq5tBahb';
        $language = 'hy';
        $orderId = $_GET['orderId'];
        if (isset($orderId) && !empty($orderId)) {
            if ($data = file_get_contents('https://ipay.arca.am/payment/rest/getOrderStatus.do?userName=' . $merchant . '&password=' . $password . '&orderId=' . $orderId . '&language=' . $language . '')) {
                $data = json_decode($data);
                $amount = substr($data->depositAmount, 0, -2);
                $arca_error_code = $data->ErrorCode;
                $arca_order_status = $data->OrderStatus;
                if ($arca_error_code == 0 && $arca_order_status == 2 && $amount > 0) {
                    $arca_res = $this->db->query("SELECT * FROM `order` WHERE `mdorder`='$orderId' AND `status`='0'");
                    if ($arca_res->num_rows == 1) {
                        $arca_row = $arca_res->fetch_assoc();
                        $this->db->query("UPDATE `order` SET `pay_amount`='$amount', `status`='1' WHERE `orderID`='" . $arca_row['orderID'] . "'");
                        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/');
                        exit;
                    }
                }
            }
        }
    }

    public function idramSuccessCallback()
    {
        echo 'success';
    }

    public function idramFailCallback()
    {
        echo 'fail';
        exit;
    }

    public function idramResultCallback()
    {
        if (isset($_REQUEST['EDP_PRECHECK']) && isset($_REQUEST['EDP_BILL_NO']) &&
            isset($_REQUEST['EDP_REC_ACCOUNT']) && isset($_REQUEST['EDP_AMOUNT'])) {
            if ($_REQUEST['EDP_PRECHECK'] == "YES") {
                if ($_REQUEST['EDP_REC_ACCOUNT'] == self::SECRET_KEY) {
                    $bill_no = $_REQUEST['EDP_BILL_NO'];
                    $res = $this->db->query("SELECT * FROM `order` WHERE `orderID`='$bill_no' AND `status`='0'");
                    if($res->num_rows == 1) {
                        echo("OK");
                    }
                }
            }
        }

        if(isset($_REQUEST['EDP_PAYER_ACCOUNT']) && isset($_REQUEST['EDP_BILL_NO']) &&
            isset($_REQUEST['EDP_REC_ACCOUNT']) && isset($_REQUEST['EDP_AMOUNT'])
            && isset($_REQUEST['EDP_TRANS_ID']) && isset($_REQUEST['EDP_CHECKSUM']))
        {
            $txtToHash =

                self::EDP_REC_ACCOUNT . ":" .
                $_REQUEST['EDP_AMOUNT'] . ":" .
                self::SECRET_KEY . ":" .
                $_REQUEST['EDP_BILL_NO'] . ":" .
                $_REQUEST['EDP_PAYER_ACCOUNT'] . ":" .
                $_REQUEST['EDP_TRANS_ID'] . ":" .
                $_REQUEST['EDP_TRANS_DATE'];

            if(strtoupper($_REQUEST['EDP_CHECKSUM']) == strtoupper(md5($txtToHash)))
            {
                $amount = $_REQUEST['EDP_AMOUNT'];
                $bill_no = $_REQUEST['EDP_BILL_NO'];
                $res = $this->db->query("SELECT * FROM `order` WHERE `orderID`='$bill_no' AND `status`='0'");
                $res_row = $res->fetch_assoc();
                $this->db->query("UPDATE `order` SET `pay_amount`='$amount', `status`='1' WHERE `orderID`='" . $res_row['orderID'] . "'");
                echo("OK");
            }
        }
        exit;
    }


}
