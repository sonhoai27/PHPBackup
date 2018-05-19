<?php
	class ConnectDB
	{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		private $db_name = "shopwatch";
		private $conn = NULL;
		private $result = NULL;

		public function __construct()
		{
            /** TYPE_NAME $this */
            $this->conn = mysqli_connect($this->host, $this->user, $this->pass);
			mysqli_select_db($this->conn, $this->db_name);
            mysqli_set_charset($this->conn, 'utf8');
		}

		//huy ket noi
		public function disconnectdb()
		{
			if($this->conn){
				mysqli_close($this->conn);
			}
		}

		//truy van sql
		public function query($sql){
			$this->result = mysqli_query($this->conn, $sql);
			if($this->result){
				return true;
			}else {
				return false;
			}
		}

		public function query_return_id($sql){
			$this->result = mysqli_query($this->conn, $sql);
			if($this->result){
				$id = $this->conn->insert_id;
				return $id;
			}else {
				return false;
			}
		}

		//dem so dong
		public function num_rows(){
			if($this->result){
				$row = mysqli_num_rows($this->result);
			}else{
				$row = 0;
			}

			return $row;
		}
		public function num_rows_query($sql){
			$this->result = mysqli_query($this->conn, $sql);
			if($this->result){
				$row = mysqli_num_rows($this->result);
			}else{
				$row = 0;
			}

			return $row;
		}

		//fetch de kiem tra cau truy van, sau do dua du lieu ra dang array

		public function fetch() {
			if($this->result){
                $data = array();
				while($post = mysqli_fetch_assoc($this->result)){
                    $data[] = $post;
                }
			}else{
				$data = 0;
			}

			return $data;
		}

        public function getAllProduct(
			$pg = 0,
			$table_row = "watch.id_watch",
			$filter = "DESC" ,
			$where = "sex_watch = id_sex",
			$order_by = "watch.id_watch"
		){
            $db = new ConnectDB();
            $sql = "select *, GROUP_CONCAT(img_watch.content_img) as Array_Img
					from sex, brand, watch
					INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
					WHERE $where
					GROUP BY $table_row
					ORDER BY $order_by $filter
					LIMIT $pg, 8";
			$num_rows = $db->num_rows_query("
				select *, GROUP_CONCAT(img_watch.content_img) as Array_Img
				from sex, brand, watch
				INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
				WHERE $where
				GROUP BY $table_row
				ORDER BY $order_by $filter
			");
			$db->query($sql);
			$datarow = $db->fetch();
			$arr = array();
			$arr['list_prds'] = $datarow;
			$arr['num_rows'] = $num_rows;
            return $arr;
        }
        public function getOneProduct($id){
            $db = new ConnectDB();
            // $db->__construct();
			$sql = "select *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
					from watch
					INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch
					WHERE watch.id_watch = '$id'
					GROUP BY watch.id_watch";
            $db->query($sql);
            $datarow = $db->fetch();
            return $datarow;
        }
        public function GetAllSex(){
        	$db = new ConnectDB();
        	$sql = "select * from sex";
            $db->query($sql);
            $datarow = $db->fetch();
            return $datarow;
		}
	}

//thao tac truc tiep tren co so du lieu la models
//dieu huong...cac thao tac giua client va server

?>
