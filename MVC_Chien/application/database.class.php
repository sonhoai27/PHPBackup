<?php 
class Database{ 
    private $connection; 
    private $result = null; //Thuộc tính result trả về kết quả của query. 
    private $magic_quotes_active; 
    private $real_escape_string_exists; 
    private static $instance;
    public function __construct(){  
        $this->magic_quotes_active = get_magic_quotes_gpc(); 
        $this->real_escape_string_exists = function_exists( "mysql_real_escape_string" ); 
    } 
    public static function getInstance() {
		if (!self::$instance)
		{	
			$db_con = new Database();
			$db_con->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			self::$instance = $db_con;
		}
		return self::$instance;
	}
    //Mở kết nối CSDL 
    function connect($address, $account, $pwd, $name) {
        $this->connection = mysqli_connect($address, $account, $pwd); 
        if (!$this->connection){ 
            die("Database connection failed: " . mysql_error()); 
        } 
        else{ 
            $db_select = mysqli_select_db($this->connection, $name); 
            if(!$db_select){ 
                die("Database selection failed: " . mysql_error()); 
            } 
        } 
		//mysqli_query("SET NAMES 'utf8'");
    } 
     
    //Đóng kết nối CSDL 
    public function closeConnect(){ 
        if ($this->connection) 
        { 
            mysqli_close($this->connection); 
            unset($this->connection); 
        } 
    } 
     
    //Phương thức chống SQL Injection 
    public function sqlQuote( $value ){ 
        //Kiểm tra xem version PHP bạn sử dụng có hiểu hàm mysql_real_escape_string() hay ko 
         
        if ($this->real_escape_string_exists) { 
            //Trường hợp sử dụng PHP v4.3.0 trở lên 
            //PHP hiểu hàm mysql_real_escape_string() 
             
            if( $this->magic_quotes_active ) {  
                //Trong trường hợp PHP đã hỗ trợ hàm get_magic_quotes_gpc() 
                //Ta sử dụng hàm stripslashes để bỏ qua các dấu slashes 
                $value = stripslashes( $value );  
            } 
            $value = mysql_real_escape_string( $value ); 
        }  
        else { 
            //Trường hợp dùng cho các version PHP dưới 4.3.0 
            //PHP không hiểu hàm mysql_real_escape_string() 
             
            if( !$this->magic_quotes_active ){  
                //Trong trường hợp PHP không hỗ trợ hàm get_magic_quotes_gpc() 
                //Ta sử dụng hàm addslashes để thêm các dấu slashes vào giá trị 
                $value = addslashes( $value );  
            } 
            // Nếu hàm get_magic_quotes_gpc() đã active có nghĩa là các dấu slashes đã tồn tại rồi 
        } 
        return $value; 
    } 
     
    //Chạy câu truy vấn query 
    public function query($sql){ 
        $this->result = mysqli_query($this->connection,$sql); 
        if (!$this->result){ 
            $output = "Database query failed: " . mysql_error() . "<br /><br />"; 
            die($output); 
        } 
        return $this->result; 
    } 
     
    //Lấy số record dữ liệu mảng trong CSDL thông qua câu truy vấn query 
    public function fetch_array($first_row = FALSE){ 
       if ($this->result){ 
			if(!$first_row)
			{
				$rows = array(); 
				while( $row = mysql_fetch_array($this->result))
				{
					$rows[] = $row;
				}
			}
			else
			{
				$rows = mysql_fetch_array($this->result);
			}
        } 
        return $rows; 
    } 
     
    //Đếm số record trong CSDL thông qua câu truy vấn query 
    public function num_row(){ 
        if($this->result){ 
            $num = null; 
            $num = mysqli_num_rows($this->result); 
        } 
        return $num;  
    } 
	 public function fetch_object($first_row = FALSE){ 
        if ($this->result){ 
			if(!$first_row)
			{
				$rows = array(); 
				while( $row = mysqli_fetch_object($this->result))
				{
					$rows[] = $row;
				}
			}
			else
			{
				$rows = mysqli_fetch_object($this->result);
			}
        } 
        return $rows; 
    }
			//Xử lý rows sau khi dùng function select
        public function processRowSet($rowSet, $singleRow=false)  
        {  
            $resultArray = array();  
            while($row = mysqli_fetch_assoc($rowSet))  
            {  
                array_push($resultArray, $row);  
            }  
      
            if($singleRow === true)
                return $resultArray[0];
      
            return $resultArray;
        }  
      
        //Chọn cột từ database
		//Returns ra một rows đầy đủ hoặc rows trong $table dùng ở $where  
        public function select($table, $where) {              
			$sql = "SELECT * FROM $table WHERE $where";  
            $result = mysql_query($sql);  
            if(mysql_num_rows($result) == 1)
                return $this->processRowSet($result, true);
      
            return $this->processRowSet($result);  
			
        }  
		//chọn tất cả từ db
		public function selectall($table, $where) {
            $sql = "SELECT * FROM $table WHERE $where";  
            $this->result = mysql_query($sql);
            return $this->result;
        } 
		//chọn tất cả actions
		public function selectactions($table, $where) {
            $sql = "SELECT * FROM $table WHERE $where ORDER BY idactions DESC LIMIT 0,25";  
            $this->result = mysql_query($sql);
            return $this->result;
        } 
      
		//$table là bảng cần update, $column là cột, $where là điều kiện.
        public function update($data, $table, $where) {  
            foreach ($data as $column => $value) {
				$sql = "UPDATE $table SET $column = $value WHERE $where";  
                mysql_query($sql) or die(mysql_error());  
            }  
            return true;  
        } 
		//Update một row 
		//$table là bảng cần update, $column là cột, $where là điều kiện.
        public function update1($table,$column,$value,$where) {
            $sql = "UPDATE $table SET $column = $value WHERE $where LIMIT 1 ";  
            mysql_query($sql) or die(mysql_error()); 
            return true;  
        }
			
		//Xóa một row từ cơ sở dữ liệu với biến truyền qua là table và điều kiện where
      public function delete($table, $where){
			$sql="DELETE FROM $table WHERE $where";
			mysql_query($sql) or die(mysql_error());
	  }
        //Thêm cơ sở dữ liệu vào database với một chuỗi,
		//Bạn có thể tạo một chuỗi rồi sau đó truyền trang hàm insert này, sau đó hàm sẽ tự động ghi vào database. 
        public function insert($data, $table) {  
      
            $columns = "";  
            $values = "";  
      
            foreach ($data as $column => $value) {  
                $columns .= ($columns == "") ? "" : ", ";  
                $columns .= $column;  
                $values .= ($values == "") ? "" : ", ";  
                $values .= $value;  
            }  
      
            $sql = "INSERT INTO $table ($columns) values ($values)";  
      
            mysql_query($sql) or die(mysql_error());  
      
            //Return kết quả là ID
            return mysql_insert_id();  
      
        }
} 
