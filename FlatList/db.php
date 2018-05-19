<?php
    $con = mysqli_connect("localhost", "root", "");
    mysqli_select_db($con, "dqwatch");
    mysqli_query($con, "SET NAME 'utf8'");

    class Product{
        public $key;
        public $name;
        public $image;
        public $price;
        public $sale;

        function Product($key, $name, $image, $price, $sale){
            $this->key = $key;
            $this->name = $name;
            $this->image = $image;
            $this->price = $price;
            $this->sale = $sale;
        }
    }
?>