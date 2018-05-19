<?php
    class Database {
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
                $dbCon = new Database();
                $dbCon->connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                self::$instance = $dbCon;
            }
            return self::$instance;
        }

        //Mở kết nối CSDL
        function connect($address, $account, $pwd, $name) {
            $this->connection = mysqli_connect($address, $account, $pwd);
            mysqli_set_charset($this->connection,"utf8");
            if (!$this->connection){
                die("Database connection failed: " . mysqli_error());
            }
            else{
                $dbSelect = mysqli_select_db($this->connection, $name);
                if(!$dbSelect){
                    die("Database selection failed: " . mysqli_error());
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
            mysqli_set_charset($this->connection,"utf8");
            if (!$this->result){
                $output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";
                die($output);
            }
//            echo $sql;
            return $this->result;
        }

        //Lấy số record dữ liệu mảng trong CSDL thông qua câu truy vấn query
        public function fetch_array($first_row = FALSE){
            if ($this->result){
                if(!$first_row)
                {
                    $rows = array();
                    while( $row = mysqli_fetch_array($this->result))
                    {
                        $rows[] = $row;
                    }
                }
                else
                {
                    $rows = mysqli_fetch_array($this->result);
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
            $result = mysqli_query($this->connection,$sql);
            if(mysqli_num_rows($result) == 1)
                return $this->processRowSet($result, true);

            $this->closeConnect();
            return $this->processRowSet($result);

        }
        //chọn tất cả từ db
        public function selectall($table, $where) {
            $sql = "SELECT * FROM $table WHERE $where";
            $this->result = mysqli_query($this->connection,$sql);
            return $this->processRowSet($this->result);
        }

        //Xóa một row từ cơ sở dữ liệu với biến truyền qua là table và điều kiện where
        public function delete($table, $where){
            $sql="DELETE FROM $table WHERE $where";
            mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
            return true;
        }
        //Thêm cơ sở dữ liệu vào database với một chuỗi,
        //Bạn có thể tạo một chuỗi rồi sau đó truyền trang hàm insert này, sau đó hàm sẽ tự động ghi vào database.
        public function insert($data, $table) {

            $columns = "";
            $values = "";

            foreach ($data as $column => $value) {
                $columns .= ($columns == "") ? "" : ", ";
                $columns .= $column;
                $values .= ($values == "") ? "'" : ", '";
                $values .= $value."' ";
            }

            $sql = "INSERT INTO $table ($columns) values ($values)";

            mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));

            //Return kết quả là ID
            return mysqli_insert_id($this->connection);

        }
        public function update($data, $table, $where) {
            $changes = "";

            foreach ($data as $column => $value) {
                $changes .= ($changes == "") ? "" : ", ";
                $changes .= $column."= '".$value."' ";
            }
            $sql = "UPDATE $table SET $changes WHERE $where";
            mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));

            return true;
        }
    }
?>