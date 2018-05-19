<?php
/**
 * Created by PhpStorm.
 * User: sonho
 * Date: 11/23/2017
 * Time: 12:55 AM
 */
class productModel extends BaseModel {
    public function getProducts($page = 0)
    {
        global $db;
        $listData = array();
        $products = $db->query("SELECT *, GROUP_CONCAT(list_img_prd.id_img,':',list_img_prd.src_prd) as Array_Img 
                                    from list_brand_prd, sex_prd,products 
                                    INNER JOIN list_img_prd ON products.id_prd = list_img_prd.id_prd
                                    where list_brand_prd.id_brand = products.brand_id_prd 
                                    GROUP by products.id_prd 
                                    ORDER by products.id_prd DESC LIMIT ".$db->sqlQuote($page).",16");
        $listData['list_prds'] = $db->fetch_array();
        $db->query("SELECT *, GROUP_CONCAT(list_img_prd.id_img,':',list_img_prd.src_prd) as Array_Img 
                                    from list_brand_prd, sex_prd,products 
                                    INNER JOIN list_img_prd ON products.id_prd = list_img_prd.id_prd
                                    where list_brand_prd.id_brand = products.brand_id_prd 
                                    GROUP by products.id_prd 
                                    ORDER by products.id_prd DESC");
        $numRows = $db->num_row();
        $listData['num_rows'] = $numRows;
        return $listData;
    }

    public function getCustomProducts($page = 0, $custom){
        global $db;
        $where = "";
        $sort = "DESC";
        $listData = array();
        foreach ($custom as $key => $value)
        {
            $$key = $value;
        }
//        echo "SELECT *, GROUP_CONCAT(list_img_prd.id_img,':',list_img_prd.src_prd) as Array_Img
//                                    from list_brand_prd, sex_prd,products
//                                    INNER JOIN list_img_prd ON products.id_prd = list_img_prd.id_prd
//                                    where list_brand_prd.id_brand = products.brand_id_prd ".$where."
//                                    GROUP by products.id_prd
//                                    ORDER by products.id_prd ".$sort." LIMIT ".$db->sqlQuote($page).",16";
        $products = $db->query("SELECT *, GROUP_CONCAT(list_img_prd.id_img,':',list_img_prd.src_prd) as Array_Img 
                                    from list_brand_prd, sex_prd,products 
                                    INNER JOIN list_img_prd ON products.id_prd = list_img_prd.id_prd
                                    where list_brand_prd.id_brand = products.brand_id_prd ".$where."
                                    GROUP by products.id_prd 
                                    ORDER by products.id_prd ".$sort." LIMIT ".$page.",16");
        $listData['list_prds'] = $db->fetch_array();
        $db->query("SELECT *, GROUP_CONCAT(list_img_prd.id_img,':',list_img_prd.src_prd) as Array_Img 
                                    from list_brand_prd, sex_prd,products 
                                    INNER JOIN list_img_prd ON products.id_prd = list_img_prd.id_prd
                                    where list_brand_prd.id_brand = products.brand_id_prd ".$where."
                                    GROUP by products.id_prd 
                                    ORDER by products.id_prd ".$sort);
        $numRows = $db->num_row();
        $listData['num_rows'] = $numRows;
        return $listData;
    }
    public function getDetailProduct($id){
        global $db;
        $product = $db->query("select *, GROUP_CONCAT(list_img_prd.id_img,':',list_img_prd.src_prd) as Array_Img
					from list_brand_prd, sex_prd, products
					INNER JOIN list_img_prd ON products.id_prd = list_img_prd.id_prd
					WHERE products.id_prd = ".$db->sqlQuote($id)." and list_brand_prd.id_brand = products.brand_id_prd and sex_prd.id_sex = products.sex_prd
					GROUP BY products.id_prd");
        return $db->fetch_array($first_row = true);
    }

    public function addNewProduct($prd = array(), $imgs = array()) {
        global $db;
        $checkSuccess = false;

        $lastId = $db->insert($prd, "products");
        $numSrc = count($imgs['src_prd']);
        for($i = 0; $i < $numSrc; $i++){
            $img = array();
            $img['src_prd'] = $imgs['src_prd'][$i];
            $img['id_prd'] = $lastId;

            if(is_numeric($db->insert($img, "list_img_prd"))){
                $checkSuccess = true;
            }
        }

        if($checkSuccess){
            return $lastId;
        }
    }

    public function changeImage($img = array(), $where){
        global $db;
        return $db->update($img, 'list_img_prd', $where);
    }
    public function getOneImg($id_img){
        global $db;
        return $db->select("list_img_prd", "id_img=".$id_img);
    }

    public function updatePrd($prd = array(), $where){
        global $db;
        return $db->update($prd, 'products', $where);
    }

    public function addImageToPrd($info = array()){
        global $db;
        return $db->insert($info, "list_img_prd");
    }
    public function deleteImage($info){
        global $db;
        return $db->delete("list_img_prd", "id_img=".$info);
    }

    public function deleteProduct($id){
        global $db;
        return $db->delete("products", "id_prd=".$id);
    }
    public function getImageFromId($listId = array()){
        global $db;
        $listImage = array();
        //luu key la key id img vs val id img
        for($i = 0; $i < count($listId); $i++){
            $listImage[$i]['img'] = $db->selectall("list_img_prd", "id_prd=".$listId[$i]);
            $listImage[$i]['prd'] = $listId[$i];

        }

        return $listImage;
    }
	public function update_product_public($prd = array(), $where){
		global $db;
		$wh = "id_prd = ".$db->sqlQuote($where);
		return $db->update($prd, 'products', $wh);
	}
}