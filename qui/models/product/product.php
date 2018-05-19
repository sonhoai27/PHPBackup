<?php
    ob_start();
    require_once("./models/dbcon.php");
    class M_Product {
        private $db = NULL;
        function __construct(){
            $this->db = new ConnectDB();
            // $this->db->connectdb();
        }

        public function Add_Prd($name, $brand, $price, $sale, $color, $sex, $size, $alias,$arr_img, $info, $ksu = ""){
            $isOk = false;
            $sql = "INSERT INTO watch (name_watch, brand_id, price_watch, sale_watch, size_watch, color_watch, sex_watch, info_watch, ksu_watch, alias_watch)
            VALUES ('$name', '$brand', '$price', '$sale', '$size', '$color', '$sex','$info', '$ksu','$alias')";
            $last_id = $this->db->query_return_id($sql);
            if($last_id == false) {
                echo "sai";
            }
            if($last_id != false){
                if(count($arr_img['target_files']) > 0){
                    for($i = 0; $i < count($arr_img['target_files']); $i++){
                        $name_img = $arr_img['target_files'][$i];
                        $sql_img = "INSERT INTO `img_watch`(`id_watch`, `content_img`) VALUES ('$last_id','$name_img')";
                        if($this->db->query($sql_img)){
                            $isOk = true;
                        }
                    }
                    if($isOk){
                        echo "Thêm Thành Công";
                        $url_dir = "./admin?a=admin_product";
                        $this->db->disconnectdb();
                        if (headers_sent()) {
                            die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                        }
                        else{
                            exit(header("Location: $url_dir"));
                        }
                    }
                }
                else{
                    echo "Thêm Thành Công";
                    $url_dir = "./admin?a=admin_product";
                    $this->db->disconnectdb();
                    if (headers_sent()) {
                        die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                    }
                    else{
                        exit(header("Location: $url_dir"));
                    }
                }

            }else{
                echo "Thêm Thất Bại";
            }
        }
        public function Update_Prd($id, $name, $brand, $price, $sale, $color, $sex, $size, $info, $ksu = "", $on_off_sp, $alias){
            $sql = "UPDATE watch
            SET name_watch = '$name', brand_id = '$brand', price_watch = '$price', sale_watch = '$sale',
                size_watch = '$size', color_watch = '$color', sex_watch = '$sex', info_watch = '$info', ksu_watch = '$ksu', alias_watch = '$alias' ,switch_watch = '$on_off_sp'
                WHERE id_watch = '$id'";

            if($this->db->query($sql) == true){
                echo "Success";
                $url_dir = "./admin?a=admin_product";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }else{
                echo "Error";
            }
            $this->db->disconnectdb();
        }

        public function Delete_Prd($arr_prd){
            $arr = array();
            $arr = explode(",",$arr_prd);
            $finished = false;
            for($i = 0; $i < count($arr); $i++){
                $id = $arr[$i];
                $sql = "DELETE FROM `watch` WHERE `watch`.`id_watch` = '$id'";
								$sql_get_img = "select content_img from img_watch where id_watch = '$id'";
								if($this->db->query($sql_get_img)){
										$dir_img = $this->db->fetch();
								}
                if($this->db->query($sql) == true){
                    if($this->db->query("delete from img_watch where img_watch.id_watch = '$id'")){
												for($i = 0; $i < count($dir_img); $i++){
													if (file_exists("./". $dir_img[$i]['content_img']))
														{
															unlink("./".$dir_img[$i]['content_img']);
														}	
												}
												$finished = true;
                    }else{
                        $finished = false;
                    }
                }else{
                    $finished = false;
                }
            }
            if($finished == true){
                echo "Success";
                $url_dir = "./admin?a=admin_product";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }else{
                echo "Error";
            }

            $this->db->disconnectdb();
        }

        public function UpdateImgPrd($id_img, $img_data, $id_watch){
            $sql = "UPDATE img_watch SET content_img = '$img_data' where id_img = '$id_img'";
						$sql_add_new = "INSERT INTO `img_watch`(`id_watch`, `content_img`) VALUES ('$id_watch','$img_data')";
            $sql_get_img = "select content_img from img_watch where id_img = '$id_img'";
            if($id_img != ""){
							if($this->db->query($sql_get_img)){
                $dir_img = $this->db->fetch();
							}
							if($this->db->query($sql)){
									if (file_exists("./". $dir_img[0]['content_img']))
									{
												unlink("./".$dir_img[0]['content_img']);
									}
							}
						}else{
							$this->db->query($sql_add_new);
						}
					$this->db->disconnectdb();
        }

        public function CountRow(){
            $sql = "select * from watch";
            $this->db->query($sql);
            $sum_watch = $this->db->num_rows();
            return  $sum_watch."";
            $this->db->disconnectdb();
        }
        public function GetSomeProduct($pg = 0){
            $sql = "select *, GROUP_CONCAT(img_watch.content_img) as Array_Img
					from sex, watch
					INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
					WHERE watch.sex_watch = sex.id_sex
					GROUP BY watch.id_watch
                    LIMIT $pg,8";
            $this->db->query($sql);
            $prd = $this->db->fetch();
            return $prd;
            $this->db->disconnectdb();
        }
        public function GetOneProduct($id){
            $sql = "select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
					from brand, sex, watch
					INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
					WHERE watch.id_watch = '$id' and brand.id_brand = watch.brand_id and sex_watch = id_sex
					GROUP BY watch.id_watch";
            $this->db->query($sql);
            $datarow = $this->db->fetch();
            return $datarow;
            $this->db->disconnectdb();
        }
        public function AddToOrder($payemnt, $address, $email, $name, $phone, $total){
            $sql = "INSERT INTO my_order (email_buyer, number_buyer, name_buyer, address_buyer, payment_order, total_order)
                VALUES ('$email', '$phone', '$name', '$address', '$payemnt', '$total')";
            $id = $this->db->query_return_id($sql);
            return $id;
            $this->db->disconnectdb();
        }

        public function AddProductOrder($dem, $id, $name_prd, $price_prd, $qty_prd, $img_prd, $id_prd){
            $sql = "INSERT INTO `product_of_order`(`id_order`, `name_watch`, `price_watch_off`, `qty_watch`, `img_watch`, `id_watch`)
            VALUES ('$id','$name_prd',' $price_prd', '$qty_prd', '$img_prd', '$id_prd')";

            if($this->db->query($sql) == true){
                $dem--;
            }else{
                echo "LOI";
            }

            if($dem == 0){
               $this->db->disconnectdb();
            }
        }
        public function GetAllPrdCustom($limit = 4, $from = 0, $choose = "sale_watch", $filter = "DESC", $where_w = "", $having = ""){
            $sql = "select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
					from  brand, sex,watch
					INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
					$where_w
					GROUP by watch.id_watch
					$having
					ORDER by $choose $filter
					LIMIT $from,$limit";
// 					echo $sql;
            if($this->db->query($sql)){
                $data = $this->db->fetch();
                return $data;
                $this->db->disconnectdb();
            }

        }
        public function SearchProduct($where, $pg = 0){
            $sql = "select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
					from  brand, sex,watch
					INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
					where id_brand = brand_id and sex_watch = id_sex and $where
					GROUP by watch.id_watch
					ORDER by watch.id_watch DESC
                    LIMIT $pg,8";
            if($this->db->query($sql)){
                $data = $this->db->fetch();
                return $data;
                $this->db->disconnectdb();
            }
        }
        
        public function Search_Admin_Prd($pg, $where){
            $sql = "select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
            from  brand, sex,watch
            INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
            where id_brand = brand_id and sex_watch = id_sex and $where'
            GROUP by watch.id_watch
            ORDER by watch.id_watch DESC
            LIMIT $pg,8";
            $num_rows = $this->db->num_rows_query("
            select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
            from  brand, sex,watch
            INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
            where id_brand = brand_id and sex_watch = id_sex and $where'
            GROUP by watch.id_watch
            ORDER by watch.id_watch DESC");
            if($this->db->query($sql)){
                $data = $this->db->fetch();
                $arr = array();
                $arr['list_prds'] = $data;
                $arr['num_rows'] = $num_rows;
                return $arr;
                $this->db->disconnectdb();
            }
        }
				public function Search_RealTime_Admin_Prd($key){
            $sql = "select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
            from  brand, sex,watch
            INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
            where id_brand = brand_id and sex_watch = id_sex and name_watch like '%$key%' or ksu_watch like '%$key%'
            GROUP by watch.id_watch
            ORDER by watch.id_watch DESC
            LIMIT 4";
					
            if($this->db->query($sql)){
                $data = $this->db->fetch();
                return $data;
                $this->db->disconnectdb();
            }
        }
				public function Delete_Img($id_img){
					$sql_get_img = "select content_img from img_watch  where id_img = $id_img";
					$sql_del_img = "delete from img_watch where id_img = $id_img";
					if($this->db->query($sql_get_img)){
							$content_img = $this->db->fetch();
							if($this->db->query($sql_del_img)){
								if (file_exists("./". $content_img[0]['content_img']))
									{
												unlink("./".$content_img[0]['content_img']);
												echo "S";
									}
							}
					}
					$this->db->disconnectdb();
				}
    }
    ob_end_flush();
?>
