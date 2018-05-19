
           <div class="row">
                <div class="col-xs-12">
                    <div class="row sh_card">
                        <div class="col-sm-3 col-xs-12">
                            <div class="sh_card_total">
                                <h3>Tổng Sản Phẩm</h3>
                                <p><?php echo $count_watch ?></p>
                                <a href="?a=admin_product"><span>Xem Thêm</span></a>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="sh_card_total">
                                <h3>Đặt Hàng</h3>
                                <p><?php echo $count_order ?></p>
                                <a href=""><span>Xem Thêm</span></a>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="sh_card_total">
                                 <h3>Chưa Kiểm Tra</h3>
                                <p><?php echo $count_order_uncheck ?></p>
                                <a href=""><span>Xem Thêm</span></a>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="sh_card_total">
                                <h3>Đã Kiểm Tra</h3>
                                <p><?php echo $count_order_checked?></p>
                                <a href=""><span>Xem Thêm</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="sh_list_order col-xs-12">
                        <div class="row">
                            <div class="sh_title_list_order">
                                <p style="margin-bottom: 0">New Order</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive sh_content_list_new_order">
                                <table class="sh_table_list_order" width="100%">
                                    <tr class="sh_border_table" width="100%">
                                        <td width="5%" class="text-center">#</td>
                                        <td width="45%">Khách hàng</td>
                                        <td width="35%">Giá tiền</td>
                                        <td width="15%">Tình trạng</td>
                                    </tr>
                                    <?php foreach($my_order['list_order'] as $order){?>
                                        <tr width="100%">
                                            <td>
                                                <input id="i22" type="checkbox" class="sh_btn_checkbox">
                                                <label for="i22" class="sh_checkbox_label"></label>
                                            </td>
                                            <td><a href="?a=order&pages=detail&dir=order&id=<?php echo $order['id_order']?>"><?php echo $order['name_buyer']?></a></td>
                                            <td><?php echo number_format($order['total_order']).' VND'?></td>
                                            <td><?php
                                                if($order['status_order'] == 0){
                                                    echo "Chưa kiểm tra";
                                                }else{
                                                    echo "Đã kiểm tra";
                                                }
                                            ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                       <div class="sh_pagination p12">
                          <ul>
                            <a id="sh_load_more_order_pre"><li>Trở lại</li></a>
                            <a id="sh_load_more_order_next"><li>Trang tiếp theo</li></a>
                          </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
