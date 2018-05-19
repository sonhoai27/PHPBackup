<?php
require_once ("./views/search.php");
require_once ("./models/product/product.php");
class Search_C {
    public function Page_Search(){
        $search_v = new Search_V();
        $prd = new M_Product();
        $code_search = isset($_GET['ma']) ? $_GET['ma'] : "";
        $value_search = isset($_GET['tu-khoa']) ? $_GET['tu-khoa'] : "";
        $page_search = isset($_GET['trang']) ? $_GET['trang'] : 1;
        $page_search = ($page_search-1)*8;
        $list_prd = NULL;
        $value_search = addslashes($value_search);
        if($value_search != ""){
            switch($code_search){
                case "name-prd": {
                    $list_prd = $prd->SearchProduct("name_watch like '%$value_search%'", $page_search);
                };break;
                case "code-prd": {
                    $list_prd = $prd->SearchProduct("ksu_watch like '%$value_search%'", $page_search);
                };break;
            }
            $search_v->View_Search($list_prd);
        }
    }
}
?>