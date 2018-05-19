<?php
    require_once("./models/product/product.php");
    require_once ("./models/brand/brand.php");
    require_once("./controllers/shopping_cart.php");
    class RES_ST{
        public function res_img(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if ( 0 < $_FILES['img-sp-1']['error'] ) {
                    echo 'Error: ' . $_FILES['img-sp-1']['error'] . '<br>';
                }
                else {

                    //xy ly id tung san pham
                    $arr_id = array();
                    $handel_id = $_POST['id_prd'];

                    $arr_id = explode(" ", $handel_id);

                    $id_img = $arr_id[1];

                    $target_dir = "././public/images/products/";

                    $file_img = $_FILES['img-sp-1'];
                    

                    $target_file = $target_dir .date("H i s"). basename($file_img["name"]);
                    
                    $uploadOk = 1;

                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    
                    $check = getimagesize($file_img["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                    if (file_exists($target_file)) {
                        $uploadOk = 0;
                    }
                     // Check file size
                    if ($file_img["size"] > 5000000) {
                        $uploadOk = 0;
                    }
                    // Allow certain file formats
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                        $uploadOk = 0;
                    }
                    if ($uploadOk == 0) {
                        echo "error";
                    } else {
                        $main = new M_Product();
                        move_uploaded_file($file_img["tmp_name"], $target_file);
                        $img = substr($target_file, 2);
                        $main->UpdateImgPrd($id_img, $img);
                        echo $img;
                    }
                }
            }
        }
        public function Add_To_Cart($id){
            $main = new Shopping_Cart();
            $main->AddToCart($id);
        }
        public function Add_New_Brand(){
            $main = new Brand();
            $name = $_POST['name_brand'];
            $alias = $_POST['alias_brand'];
            $last_id = $main->Add_New_Brand($name, $alias);
            $data_row = $main->GetOneBrand($last_id);
            if($data_row != NULL){
                echo "<tr>
                       <td width='25%'>
                           <input
                           id='brand_".$data_row["id_brand"]."'
                           name ='brand_item_'".$data_row["id_brand"]."
                           type='checkbox' class='sh_btn_checkbox'
                           onclick = 'DeleteBrandId(".$data_row["id_brand"].")'>
                           <label for='brand_".$data_row["id_brand"]."' class='sh_checkbox_label'></label></td>
                       <td width='50%'><p>".$data_row["name_brand"]."</p></td>
                       <td width='25%'><p>Sửa</p></td>
                   </tr>";
            }else{
                echo "THAT_BAI";
            }
        }
        public function Bg_Brand($pg){
            $main = new Brand();
            return $main->Pagination_Get_Brand($pg);
        }
        public function Pg_Product($pg = "", $alias = "", $sex = ""){
            $main = new M_Product();
            if($alias != "" && $sex == ""){
                $where = "WHERE watch.brand_id = id_brand and alias_brand = '$alias'";
                return $main->GetAllPrdCustom(8,$pg,"watch.id_watch","DESC",$where);
            }else {
                if($alias == "" && $sex == ""){
                    return $main->GetSomeProduct($pg);
                }else{
                    if($alias != "" && $sex != ""){
                        $where = "WHERE watch.brand_id = `id_brand` and alias_brand = '$alias' and sex_watch = id_sex and name_sex = '$sex'";
                        return $main->GetAllPrdCustom(8,$pg,"watch.id_watch","DESC",$where);
                    }
                }
            }
        }
        public function Pg_Prd_Price($pg, $price, $sex= ""){
            $prd = new M_Product();
            $custom_get_prd = NULL;
            if($sex == ""){
                if($price == "4000000"){
                    $custom_get_prd = $prd->GetAllPrdCustom(
                        8,
                        $pg,
                        "watch.id_watch",
                        "DESC",
                        "WHERE `brand_id` = `id_brand` and `price_watch` <= $price");
                    return $custom_get_prd;
                }
                if($price == "5000000"){
                    $custom_get_prd = $prd->GetAllPrdCustom(
                        8,
                        $pg,
                        "watch.id_watch",
                        "DESC",
                        "WHERE `brand_id` = `id_brand` and `price_watch` >= $price and `price_watch` < 10000000");
                    return $custom_get_prd;
                }
                if($price == "10000000"){
                    $custom_get_prd = $prd->GetAllPrdCustom(
                        8,
                        $pg,
                        "watch.id_watch",
                        "DESC",
                        "WHERE `brand_id` = `id_brand` and `price_watch` >= $price and `price_watch` < 20000000");
                    return $custom_get_prd;
                }
                if($price == "20000000"){
                    $custom_get_prd = $prd->GetAllPrdCustom(
                        8,
                        $pg,
                        "id_watch",
                        "DESC",
                        "WHERE `brand_id` = `id_brand` and `price_watch` >= $price");
                    return $custom_get_prd;
                }
            }else{
                if($sex != ""){
                    echo $price;
                    echo $sex;
                    if($price == "4000000"){
                        $custom_get_prd = $prd->GetAllPrdCustom(
                            8,
                            $pg,
                            "watch.id_watch",
                            "DESC",
                            "WHERE sex_watch = id_sex and brand_id = id_brand and alias_sex = '$sex' and price_watch <= $price");
                        return $custom_get_prd;
                    }
                    if($price == "5000000"){
                        $custom_get_prd = $prd->GetAllPrdCustom(
                            8,
                            $pg,
                            "watch.id_watch",
                            "DESC",
                            "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` >= $price and `price_watch` < 10000000");
                        return $custom_get_prd;
                    }
                    if($price == "10000000"){
                        $custom_get_prd = $prd->GetAllPrdCustom(
                            8,
                            $pg,
                            "watch.id_watch",
                            "DESC",
                            "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` >= $price and `price_watch` < 20000000");
                        return $custom_get_prd;
                    }
                    if($price == "20000000"){
                        $custom_get_prd = $prd->GetAllPrdCustom(
                            8,
                            $pg,
                            "watch.id_watch",
                            "DESC",
                            "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` >= $price");
                        return $custom_get_prd;
                    }
                }
            }
        }
        public function Pg_Prd_Sex($pg, $sex){
            $prd = new M_Product();
            $custom_get_prd = $prd->GetAllPrdCustom(
                8,
                $pg,
                "watch.id_watch",
                "DESC",
                "WHERE `sex_watch` = `id_sex` and `alias_sex` = '$sex'");
            return $custom_get_prd;
        }
        public function Pg_Prd_Custom_Smart_Filter($pg, $colunm, $filter, $sex = ""){
            $prd = new M_Product();
            if($sex == ""){
                $custom_get_prd = $prd->GetAllPrdCustom(
                    8,
                    $pg,
                    $colunm,
                    $filter
                );
                return $custom_get_prd;
            }else {
                $custom_get_prd = $prd->GetAllPrdCustom(
                    8,
                    $pg,
                    $colunm,
                    $filter,
                    "where brand_id = id_brand and sex_watch = id_sex and alias_sex = '$sex'"
                );
                return $custom_get_prd;
            }
        }
        public function GetOneBrand($id){
            $brand = new Brand();
            return $brand->GetOneBrand($id);
        }
        public function GetPrdOfSexBrand($filter, $pg = 0){
            $prd = new M_Product();
            $custom_get_prd = $prd->GetAllPrdCustom(
                8,
                $pg,
                "id_watch",
                "DESC",
                $filter
            );
            return $custom_get_prd;
        }
    }
?>