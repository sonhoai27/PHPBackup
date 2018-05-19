<?php
	if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
		if(isset($_POST['update_cart'])){
		$qty_watch[] = $_POST['qty_watch'];
		$arr_prd = $_SESSION['cart'];
		$i = 0;
		foreach($arr_prd as $key => $val){
			$arr_prd[$key]['qty_watch'] = $qty_watch[0][$i];
			$price_off_qty = (($arr_prd[$key]['price_watch']) - (($arr_prd[$key]['price_watch']*$arr_prd[$key]['sale_watch'])/100))*$arr_prd[$key]['qty_watch'];
			$arr_prd[$key]['price_off'] = $price_off_qty;
			$i = $i + 1;
		}
		$_SESSION['cart'] = $arr_prd;
	}
		if(isset($_POST['delete_prd'])){
			$id_cart = $_POST['delete_prd_id_cart'];
			$arr_id_cart = explode(",", $id_cart);
			foreach($arr_id_cart as $val) {
				unset($_SESSION['cart'][$val]);
			}
		}
	}
?>
<title>Q.SHOP - Giỏ Hàng</title>
<div class="container">
	<div class="row">
		<div class="col-xs-12 action_btn_cart sh_prd_btn_action">
            <form accept-charset="utf-8" method="post">
                <input type="text" id="get_prd_id_cart" name="delete_prd_id_cart" style="display: none">
                <button type="submit" class="sh_action_submit" name="delete_prd"><p>Xóa</p></button>
            </form>
		<form method ="post">
            <button type="submit" class="sh_action_submit" name="update_cart"><p>Cập nhật</p></button>
        </div>
		<div class="col-sm-12">
			<div class="sh_prd_table_manager">
					<table class="sh_table_list_order">
						<tr class="sh_border_table">
								<td width="5%" style="text-align: center">#</td>
								<td width="15%">Hình</td>
								<td width="40%">Tên</td>
								<td width="25%">Giá (Đã tính giảm giá)</td>
								<td width="15%">Số Lượng</td>
						</tr>
						<?php
							if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
								$resultPrd = $_SESSION['cart'];
								foreach($resultPrd as $kq => $value_kq){ ?>
								<tr>
									<td>
										<input
												id="cart_prd_<?php echo $value_kq['id_watch']?>"
												name ="prd_item_<?php echo $value_kq['id_watch']?>"
												type="checkbox" class="sh_btn_checkbox" 
												value="<?php echo $value_kq['id_watch']?>"
												onclick = "Delete_Prd_Id_Cart(<?php echo $value_kq['id_watch']?>)">
										<label for="cart_prd_<?php echo $value_kq['id_watch']?>"  class="sh_checkbox_label"></label>
									</td>
									<td><img src="<?php echo $value_kq['content_img']?>" alt="" class="img img-responsive" width="50%"></td>
									<td><a href="./dong-ho/<?php echo $value_kq['alias_watch']?>-<?php echo $value_kq['id_watch'] ?>"><?php echo $value_kq['name_watch']?></a></td>
									<td><?php echo number_format($value_kq['price_off']).' VND'?></td>
									<td><input type="number" name="qty_watch[]" value="<?php echo $value_kq['qty_watch']?>" style="padding: 5px; width: 50%;"></td>
								</tr>   
							<?php } ?>	 
						<?php } ?>
				</table>
			</div>
		</div>
		</form>
	</div>
	<div class="row">
		<div class="text-center">
			<div class="col-xs-12 text-left">
			<?php if(isset($_SESSION['cart']) && $_SESSION['cart'] == NULL || !isset($_SESSION['cart'])){?>
				<h4 style="padding: 15px 0;">Không có sản phẩm nào trong giỏ hàng.</h4>
			<?php } ?>
			</div>
			<div class="col-sm-10">
			</div>
			<div class="col-xs-2">
				<button type="button" class="btn btn-default btn-sm btn-block btn_checkout">
					<a href="./checkout">Đặt hàng</a>
				</button>
			</div>
		</div>
	</div>
</div>
<script>
	// var check_btn_delete_cart = false;
    var array_id_cart = []
    function Delete_Prd_Id_Cart(id){
        var text_id_cart = "";
        if(document.getElementById('cart_prd_' + id).checked == true){
            array_id_cart.push(id)
            for(var i = 0; i < array_id_cart.length; i++){
                text_id_cart = text_id_cart + array_id_cart[i] + ","
            }
        }else{
             if(document.getElementById('cart_prd_' + id).checked == false){ 
                for(var i = 0; i < array_id_cart.length; i++){
                    if(array_id_cart[i] == id){
                        for(var j = i; j < array_id_cart.length; j++){
                            array_id_cart[j] =array_id_cart[j + 1]
                        }
                    }
                }
                text_id_cart = "";
                array_id_cart.length--;
                for(var i = 0; i < array_id_cart.length; i++){
                    text_id_cart = text_id_cart + array_id_cart[i] + ","
                }
            }
        }
        document.getElementById('get_prd_id_cart').value = text_id_cart.substr(0, (text_id_cart.length - 1))
    }	
</script>