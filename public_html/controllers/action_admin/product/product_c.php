<?php
    require_once("./views/admin/product/add_prd.php");
    require_once("./models/brand/brand.php");
    require_once("./models/product/product.php");
    require_once ("./models/dbcon.php");
    class ShowAdminAddPrd{
        public function ShowAddPrd(){
            $brand = new Brand();
            $list_sex = new ConnectDB();
            $list_brand = $brand->GetAllBrand();
            $main = new Add_Prd();
            $main->AddPrdPage($list_brand, $list_sex->GetAllSex());
        }

        public function AddAdminPrd($name, $brand, $price, $sale, $color, $sex, $size, $alias, $info){
            $main = new M_Product();
            if($name != "" && $price != ""){
                if(isset($_SESSION["SH_ERROR_ADD_NEW"])){
                    unset($_SESSION["SH_ERROR_ADD_NEW"]);
                }
                $target_dir = "././public/images/products/";
                $mangFile =$_FILES['img-sp'];
                $arr_img = array();
                $dem = 1;
                $isOk = false;
                if(count($mangFile['name']) > 0 && $mangFile['name'][0] != NULL){
                    for($i = 0; $i < count($mangFile['name']); $i++){

                        $target_file = $target_dir .date("H i s"). basename($mangFile["name"][$i]);

                        $uploadOk = 1;

                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                        if(isset($_POST["submit"])) {
                            $check = getimagesize($mangFile["tmp_name"][$i]);
                            if($check !== false) {
                                $uploadOk = 1;
                                $isOk = true;
                            } else {
                                $_SESSION["SH_ERROR_UPLOAD"] = "File is not an image.";
                                $uploadOk = 0;
                                $isOk = false;
                            }
                        }
                        // Check if file already exists
                        if (file_exists($target_file)) {
                            $_SESSION["SH_ERROR_UPLOAD"] = "Sorry, file already exists.";
                            $uploadOk = 0;
                            $isOk = false;
                        }
                        // Check file size
                        if ($mangFile["size"][$i] > 5000000) {
                            $_SESSION["SH_ERROR_UPLOAD"] = "<br>Sorry, your file is too large.";
                            $uploadOk = 0;
                            $isOk = false;
                        }
                        // Allow certain file formats
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                            $_SESSION["SH_ERROR_UPLOAD"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                            $isOk = false;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            $_SESSION["SH_ERROR_UPLOAD"] = "Sorry, your file was not uploaded.";
                            $isOk = false;

                        } else {
                            if($dem < 6){
                                move_uploaded_file($mangFile["tmp_name"][$i], $target_file);
                                $arr_img['temp_files'][$i] = $mangFile["tmp_name"][$i];
                                $arr_img['target_files'][$i] = substr($target_file, 2);
                                $isOk = true;
                                $dem = $dem + 1;
                            }
                        }
                    }
                }else{
                    if(count($mangFile['name']) == 1 && $mangFile['name'][0] == NULL ){
                        $main->Add_Prd($name, $brand, $price, $sale, $color, $sex, $size, $alias,$arr_img, $info);
                    }
                }
                if($isOk){
                    $main->Add_Prd($name, $brand, $price, $sale, $color, $sex, $size, $alias, $arr_img, $info);
                }
            }else {
                $url_dir = "./admin?a=product_c";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    $_SESSION["SH_ERROR_ADD_NEW"] = "ERROR ADD NEW PRODUCT";
                    exit(header("Location: $url_dir"));
                }
            }
        }

        public function UpdateAdminPrd($id, $name, $brand, $price, $sale, $color, $sex, $size, $info){
            $main = new M_Product();
            $main->Update_Prd($id, $name, $brand, $price, $sale, $color, $sex, $size, $info);
            //echo $id."<br>".$name;
        }
        public function DeleteAdminPrd($id){
            $main = new M_Product();
            $main->Delete_Prd($id);
            //echo $id."<br>".$name;
        }
    }
?>