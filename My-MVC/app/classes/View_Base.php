<?php
    class BaseView {
        private static $instance;
        public $data = array();
        function __constructor(){

        }
        public static function getInstance() {
            if (!self::$instance)
            {
                self::$instance = new BaseView();
            }
            return self::$instance;
        }
        //custom, ví dụ có các thư mục trong view sẽ áp dụng dc.
        function show($name, $custom = ""){
            $custom = empty($custom) ? '' : $custom.'/';
            $path = __SITE_PATH.'/views'.'/'.$custom.$name.'.php';

            if(!file_exists($path)){
                throw new Exception('Template not found in '. $path);
                return false;
            }

            foreach ($this->data as $key => $value)
            {
                $$key = $value; //chuyển 1 $key thành 1 biến
            }
            include ($path);   
        }
    }
?>