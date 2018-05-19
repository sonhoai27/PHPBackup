<?php
    require_once ("./modules/phanTrang.php");
    class productController extends BaseController{
        /**
         * @all controllers must contain an index method
         */
        function index()
        {
            //add module phanTrang to product
            $where_custom = array();
            $phanTrang = new phanTrang();
            $currentPage = isset($_GET['page']) ? $_GET['page'] : "1";
            $numPrdWillGet = ($currentPage - 1)* 16;

            $this->view->data['list_brands'] = $this->model->get('brandModel')->getBrand(0,1);

            if(isset($_GET['date'])){
                $where_custom['sort'] = $_GET['date'];
            }
            if(isset($_GET['brand'])){
                $where_custom['where'] = "and list_brand_prd.alias_brand = '".$_GET['brand']."'";
            }

            $this->view->data['prds'] = (isset($_GET['date']) || isset($_GET['brand']))
                ? $this->model->get('productModel')->getCustomProducts($numPrdWillGet, $where_custom)
                : $this->model->get('productModel')->getProducts($numPrdWillGet);


            $this->view->data['phanTrang'] = $phanTrang->viewPhanTrang(
                $this->view->data['prds']['num_rows'],
                $currentPage,
                16
            );
            $this->view->show("list_products_view", "product");
            //require_once (__SITE_PATH.'/views/ex/struchtml.php');
			$this->render("main", "foot");
        }
        function add_new (){
            $this->view->data['list_sex'] = $this->model->get('sexModel')->getSex();
            $this->view->data['list_brands'] = $this->model->get('brandModel')->getBrand(0,1);
            $this->view->show("add_product_view", "product");
           $this->render("main", "foot");
        }
        function detail($args){
            $id_prd =  $args[1];
			
				if(is_numeric($id_prd)){
					$this->view->data['id_prd'] = $id_prd;
				$this->view->data['list_sex'] = $this->model->get('sexModel')->getSex();
				$this->view->data['list_brands'] = $this->model->get('brandModel')->getBrand(0,1);
				
				$prds = $this->model->get('productModel')->getDetailProduct($id_prd);
				
				if(count($prds)>0){
					$this->view->data['prd'] = $prds;
					$this->view->show("detail_product_view", "product");
					$this->render("main", "foot");
				}else{
					$this->view->show("instant404", "init");
				}
			}else{
				$this->view->show("instant404", "init");
			}
        }

        function progress_add_prd(){
            $arrFiles =$_FILES['img-prd'];
            $name = $alias = $brand = $price = $sale = $color = $sex = $size = $ksu = $info = $public = "";

            $listLinkImg = null; //luu lai mang img da upload
            $infoPrd = array();

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = $_POST['name-prd'];
                $infoPrd['name_prd'] = addslashes($name);
                
                $alias = $_POST['alias-prd'];
                $infoPrd['alias_prd'] = addslashes($alias);

                $ksu = $_POST['ksu-prd'];
                $infoPrd['ksu_prd'] = $ksu;

                $brand = $_POST['brand-prd'];
                $infoPrd['brand_id_prd'] = $brand;

                $price = $_POST['price-prd'];
                $infoPrd['price_prd'] = $price;

                $sale = $_POST['sale-off-prd'];
                $infoPrd['sale_off_prd'] = $sale;

                $size = $_POST['size-prd'];
                $infoPrd['size_prd'] = $size;

                $sex = $_POST['sex-prd'];
                $infoPrd['sex_prd'] = $sex;

                $color = $_POST['color-prd'];
                $infoPrd['color_prd'] = $color;

                $info = $_POST['info-prd'];
                $infoPrd['info_prd'] = addslashes($info);

                $public = $_POST['public-prd'];
                $infoPrd['public_prd'] = $public;
            }

            //kiem tra tình trạng upload img
            $statusUploadImg = $this->uploadImage($arrFiles);
            if($statusUploadImg == "ERROR"){
                $listLinkImg['src_prd'][0] = "./public/images/cdn/icon/no-image.svg";
            }else {
                $listLinkImg = $statusUploadImg;
            }

            $idNewPrd = $this->model->get("productModel")->addNewProduct($infoPrd, $listLinkImg);
            if(is_numeric($idNewPrd)){
                $this->redirect("product", "detail/".$idNewPrd);
            }
        }

        function edit_img(){
            $productModel = $this->model->get("productModel");

            $file = $_FILES['file'];
            $idFile = explode("-", $_POST['id_file']);
            $statusImg = $idFile[0];
            $idImg = $idFile[1];
            $idPrd = $idFile[2];//id_prd

            $theOldSrcPrd = $productModel->getOneImg($idImg);
            $arrInfoSingleImg['src_prd']  = $this->uploadSingleImage($file);
            $resultChangeImgDb = $productModel->changeImage($arrInfoSingleImg, "id_img =".$idImg);

            //0 là có hình ảnh.
            if($statusImg == 0){
                if($resultChangeImgDb == true){
                    if (file_exists("./".$theOldSrcPrd['src_prd']))
                    {
                        unlink("./".$theOldSrcPrd['src_prd']);
                        echo BASE_URL."crop_image/?src=".BASE_URL.$arrInfoSingleImg['src_prd']."&w=250&h=250";
                    }

                }
            }else if($statusImg == 1){
                if($resultChangeImgDb){
                    echo BASE_URL."crop_image/?src=".BASE_URL.$arrInfoSingleImg['src_prd']."&w=250&h=250";
                }
            }

        }
        function progress_edit_prd($args){
            $idPrd = $args[1];
            $status = $args[2];
            $infoPrd = array();
            $name = $alias = $brand = $price = $sale = $color = $sex = $size = $ksu = $info = $public = "";
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $name = $_POST['name-prd'];
                $infoPrd['name_prd'] = addslashes($name);

                $alias = $_POST['alias-prd'];
                $infoPrd['alias_prd'] = addslashes($alias);

                $ksu = $_POST['ksu-prd'];
                $infoPrd['ksu_prd'] = $ksu;

                $brand = $_POST['brand-prd'];
                $infoPrd['brand_id_prd'] = $brand;

                $price = $_POST['price-prd'];
                $infoPrd['price_prd'] = $price;

                $sale = $_POST['sale-off-prd'];
                $infoPrd['sale_off_prd'] = $sale;

                $size = $_POST['size-prd'];
                $infoPrd['size_prd'] = $size;

                $sex = $_POST['sex-prd'];
                $infoPrd['sex_prd'] = $sex;

                $color = $_POST['color-prd'];
                $infoPrd['color_prd'] = $color;

                $info = $_POST['info-prd'];
                $infoPrd['info_prd'] = addslashes($info);

                $public = $_POST['public-prd'];
                $infoPrd['public_prd'] = $public;
            }

            if( $this->model->get("productModel")->updatePrd($infoPrd, "id_prd=".$idPrd)){
               if($status == 0){
                    $this->redirect("product");
               }else{
                   echo 1;
               }
            }
        }
        function add_image(){
            $file = $_FILES['file'];
            $idFile = explode("-", $_POST['id_file']);
            $statusImg = $idFile[0];
            $idPrd = $idFile[1];
            if($statusImg == "2"){
                $arrInfoSingleImg['src_prd']  = $this->uploadSingleImage($file);
                $arrInfoSingleImg['id_prd'] = $idPrd;
                $idNewImg = $this->model->get("productModel")->addImageToPrd($arrInfoSingleImg);
                if(is_numeric($idNewImg)){
                    $src = preg_replace("/ /", "%20", $arrInfoSingleImg['src_prd']);
                    $arrResult['src_img'] = BASE_URL."crop_image/?src=".BASE_URL.$src."&w=250&h=250";
                    $arrResult['id_new_img'] = $idNewImg;

                    echo json_encode($arrResult);
                }
            }
        }
        function delete_img(){
            $urlImg = $_POST['src_img'];
            $arrInfoImg = explode("-", $_POST['id_img']);

            $idImg = $arrInfoImg[1];
            $statusImg = $arrInfoImg[0];

            $srcImg = explode(".", $urlImg)[1];
            $sexImg = explode("&", explode(".", $urlImg)[2])[0];

            if($statusImg == 0){
                if($this->model->get("productModel")->deleteImage($idImg) && file_exists(".".$srcImg.".".$sexImg)){
                    unlink(".".$srcImg.".".$sexImg);
                    echo 0;//0 true
                }else{
                    echo 1; //false
                }
            }else{
                echo ($this->model->get("productModel")->deleteImage($idImg) == true) ? "0" : "1";
            }


        }
        function delete_product(){
            $status = true;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $listId = explode(",", $_POST['list-id-prd']);
                $listImage = $this->model->get("productModel")->getImageFromId($listId);
                for($i = 0; $i < count($listImage); $i++){
                    //xoa hình
                    for ($j = 0; $j < count($listImage[$i]['img']); $j++){
                        if (file_exists("./".$listImage[$i]['img'][$j]['src_prd']) && explode(".", $listImage[$i]['img'][$j]['src_prd'])[2] != "svg")
                        {
                            unlink("./".$listImage[$i]['img'][$j]['src_prd']);
                        }
                        $this->model->get("productModel")->deleteImage($listImage[$i]['img'][$j]['id_img']);
                    }
                    if($this->model->get("productModel")->deleteProduct($listImage[$i]['prd'])){
                        $status = true;
                    }
                }
            }
            sleep(2);
            echo ($status == true) ? "OK" : "NO";
        }

        function search ($args){
            $method = $args[1];
            $key = $args[2];
            //add module phanTrang to product
            $where_custom = array();
            $phanTrang = new phanTrang();
            $currentPage = isset($_GET['page']) ? $_GET['page'] : "1";
            $numPrdWillGet = ($currentPage - 1)* 16;

            $this->view->data['list_brands'] = $this->model->get('brandModel')->getBrand();

            $where_custom['where'] = "and products.name_prd like '%".$key."%'";

            if($method == 0){
                $this->view->data['prds'] = $this->model->get('productModel')->getCustomProducts($numPrdWillGet, $where_custom);

                $this->view->data['phanTrang'] = $phanTrang->viewPhanTrang(
                    $this->view->data['prds']['num_rows'],
                    $currentPage,
                    16
                );


                $this->view->show("list_products_view", "product");
                require_once (__SITE_PATH.'/views/ex/struchtml.php');
            }else if($method == 1) {
                echo json_encode($this->model->get('productModel')->getCustomProducts($numPrdWillGet, $where_custom));
            }
        }
		function product_status(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$data = array(
					'public_prd'=>$_POST['status']
				);
				echo $this->model->get("productModel")->update_product_public($data,$_POST['id']);
			}
		}
        function uploadSingleImage($files, $status = 0){
            $root_folder = "././public/images/products/";
            $list_link_img = "";//luu lai cac duong dan hinh.
            $num_file = count($files['name']);
            $isOk = false;
            if($num_file > 0 && $files['name'] != null){
                $link_of_img = $root_folder.date("H-i-s").basename("-".$files['name']);
                $temp_image = explode(".", $link_of_img);
                $newNameImage = $root_folder.date("H-i-s")."-".$this->generateRandomString().".".end($temp_image);
                $uploadOk = 0;
                $imageFileType = pathinfo($link_of_img,PATHINFO_EXTENSION);

                if(getimagesize($files["tmp_name"])){
                    $uploadOk = 1;
                    $isOk = true;
                }else{
                    $uploadOk = 0;
                    $isOk = false;
                }
                if(file_exists($link_of_img)){
                    $uploadOk = 0;
                    $isOk = false;
                }
                if($files['size'] > 500000){
                    $uploadOk = 0;
                    $isOk = false;
                }

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    $uploadOk = 0;
                    $isOk = false;
                }

                if($uploadOk == 1){
                    if($status == 0){
                        move_uploaded_file($files['tmp_name'], $newNameImage);
                    }
                    $list_link_img = substr($newNameImage, 2);
                    $isOk = true;
                }

            }

            if($isOk){
                return $list_link_img;
            }else{
                return "ERROR";
            }
        }
        function uploadImage($files, $status = 0){
            $root_folder = "././public/images/products/";
            $list_link_img = array();//luu lai cac duong dan hinh.
            $num_file = count($files['name']);
            $dem = 1;
            $isOk = false;
            if($num_file > 0 && $files['name'][0] != null){
                for($i = 0; $i < $num_file; $i++){
                    $link_of_img = $root_folder.date("H-i-s").basename("-".$files['name'][$i]);
                    $temp_image = explode(".", $link_of_img);
                    $newNameImage = $root_folder.date("H-i-s")."-".$this->generateRandomString().".".end($temp_image);
                    $uploadOk = 0;
                    $imageFileType = pathinfo($link_of_img,PATHINFO_EXTENSION);

                    if(getimagesize($files["tmp_name"][$i])){
                        $uploadOk = 1;
                        $isOk = true;
                    }else{
                        $uploadOk = 0;
                        $isOk = false;
                    }
                    if(file_exists($link_of_img)){
                        $uploadOk = 0;
                        $isOk = false;
                    }
                    if($files['size'][$i] > 500000){
                        $uploadOk = 0;
                        $isOk = false;
                    }

                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        $uploadOk = 0;
                        $isOk = false;
                    }

                    if($uploadOk == 1 && $dem < 6){
                        if($status == 0){
                            move_uploaded_file($files['tmp_name'][$i], $newNameImage);
                        }
                        $list_link_img['src_prd'][$i] = substr($newNameImage, 2);
                        $isOk = true;
                        $dem = $dem + 1;
                    }

                }
            }

            if($isOk){
                return $list_link_img;
            }else{
                return "ERROR";
            }
        }
        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }