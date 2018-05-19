<?php
    require_once('./db.php');
    $ds_prd = array(); 
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $page = ($page - 1)* 8;
    $sql = "SELECT *, GROUP_CONCAT(img_watch.id_img,':',img_watch.content_img) as Array_Img
            from  brand, sex,watch
            INNER JOIN img_watch ON watch.id_watch = img_watch.id_watch 
            GROUP by watch.id_watch
            ORDER by watch.id_watch DESC
            LIMIT $page,8";

    $ds = mysqli_query($con, $sql);
    $check = 0;
    while($row = mysqli_fetch_array($ds)){
        array_push($ds_prd, new Product(
            $row['id_watch'],
            $row['name_watch'],
            'http://192.168.1.118:8082/FlatList/'.$row['content_img'],
            $row['price_watch'],
            $row['sale_watch']
        ));
        $check = $check + 1;
    }
    $json_rl =json_encode($ds_prd);
    echo $json_rl;
   
?>
