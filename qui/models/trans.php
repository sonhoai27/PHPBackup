<?php
	ob_start();
	require_once ("dbcon.php");
	class Model_Trans extends ConnectDB{
		public function AddModelTrans($data = array()){
			$name = $data['name'];
			$phone = $data['phone'];
			$email = $data['email'];
			$link = "";
			$qty = "";
			for($i = 0; $i < count($data['link']); $i++){
				$link = $link.$data['link'][$i]." -/- ";
			}
			$link = addslashes($link);
			for($i = 0; $i < count($data['qty']); $i++){
				$qty = $qty.$data['qty'][$i]."-";
			}
			$qty = addslashes($qty);
			$sql = "INSERT INTO order_usa 
						(email_order_usa, name_order_usa, phone_order_usa, link_prd_order_usa, qty_order_usa)
            VALUES ('$email', '$name', '$phone', '$link', '$qty')
						";
			if($this->query($sql)){
				$url_dir = "https://dqwatch.com/mua-hang-my";
				if (headers_sent()) {
						die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
				}
				else{
						exit(header("Location: $url_dir"));
				}
			}else{
					echo "Error";
				}
		}
		
		public function Get_All_Trans($pg = 0, $custom, $filter = "DESC"){
			$sql = "select * from order_usa $custom order by id_order_usa $filter limit $pg, 8";
			$sql_count_order = "select * from order_usa";
			$sum_order = $this->num_rows_query($sql_count_order);
			$data = array();
			if($this->query($sql)){
				$list = $this->fetch();
				$data['list_order_usa'] = $list;
				$data['sum_order_usa'] = $sum_order;
				return $data;
				$this->db->disconnectdb();
			}
		}
		public function Get_One_Trans($id){
			$sql = "select * from order_usa where id_order_usa = $id";
			if($this->query($sql)){
				$data = $this->fetch();
				return $data;
				$this->db->disconnectdb();
			}
		}
		public function Delete_One_Trans($id){
			$sql = "delete from order_usa where id_order_usa = $id";
			if($this->query($sql)){
				$url_dir = "./admin?a=order&pages=detail&dir=list_order_usa";
				$_SESSION['detele_order_success'] = "Xóa thành công";
				if (headers_sent()) {
						die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
				}
				else{
						exit(header("Location: $url_dir"));
				}
				$this->db->disconnectdb();
			}
		}
		public function Check_On_One_Trans($id){
			$sql = "UPDATE order_usa SET onoff_order_usa = 1 where id_order_usa = $id";
			if($this->query($sql)){
				$url_dir = "./admin?a=order&pages=detail&dir=list_order_usa&id=$id";
				$_SESSION['confirm_contact_success'] = "Xóa thành công";
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
		public function Check_Off_One_Trans($id){
			$sql = "UPDATE order_usa SET onoff_order_usa = 0 where id_order_usa = $id";
			if($this->query($sql)){
				$url_dir = "./admin?a=order&pages=detail&dir=list_order_usa&id=$id";
				$_SESSION['un_confirm_order_success'] = "thành công";
				if (headers_sent()) {
						die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
				}
				else{
						exit(header("Location: $url_dir"));
				}
				
				$this->db->disconnectdb();
			}
		}
	}
   ob_end_flush();
?>