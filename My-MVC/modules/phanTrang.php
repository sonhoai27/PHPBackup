<?php
class phanTrang{
    private $totalPage;
    private $currentPage;
    private $result = "";
    //num_dis là số lượng sản phẩm muốn hiện
    public function viewPhanTrang($num_rows, $current_page, $num_dis = 16){

        //tính toán xem se có bao nhieu trang
        $this->totalPage = ceil($num_rows/$num_dis);

        //trang hien tai la bao nhieu
        $this->currentPage = $current_page; //gán giá trị ban đầu

        //neu trang hien tai lon hon tong so trong, thi trang hien tai bang tong so trang
        if($current_page > $this->totalPage){
            $this->currentPage = $this->totalPage;
        }elseif ($current_page < 1){
            $this->currentPage = 1;
        }
        if($this->totalPage == 0){
            $this->currentPage = 1;
        }

        $current_url = explode("?", $_SERVER['REQUEST_URI']);
        $new_link = $current_url[0]."?";
        if(isset($current_url[1]) && (explode("=", $current_url[1])[0] == 'date' || explode("=", $current_url[1])[0] == 'filter')){
            $new_link = explode("&", $_SERVER['REQUEST_URI'])[0]."&";
        }
        //neu tang hien tai lon hon 1 va tong so trang lon hon 1
        if($this->currentPage > 1 && $this->totalPage > 1){
            $this->result .= "<a href='".$new_link."page=".($this->currentPage - 1)."' class='pg pg_pre'><span></span></a>";
        }

        for($i = 1; $i <= $this->totalPage; $i++){
            if($i == $this->currentPage){
                $this->result .=  "<span class='pg_num_active'>".$i."</span>";
            }else{
                $this->result .=  "<a href='".$new_link."page=".$i."'><span class='pg_num'>".$i."</span></a>";
            }
        }

        if($this->currentPage < $this->totalPage && $this->totalPage > 1){
            $this->result .=  "<a href='".$new_link."page=".($this->currentPage + 1)."' class='pg pg_next'><span></span></a>";
        }

        return $this->result;
    }
}