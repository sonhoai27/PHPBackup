<?php
    require_once("./views/admin/order/order.php");
    require_once("./views/admin/order/contact.php");
    require_once("./views/admin/order/order_usa.php");
    require_once("./models/order/order.php");
    require_once("./models/trans.php");
    class Order_C{
        private $order_view = NULL;
        private $order_m = NULL;
        private $contact_view = NULL;
        private $model_trans = NULL;
        private $view_trans = NULL;
       function __construct(){
            $this->order_view = new Order_V();
            $this->order_m = new M_Order();
            $this->contact_view = new Contact_View();
            $this->model_trans = new Model_Trans();
            $this->view_trans = new Order_Usa_View();
              
        }
        public function Order_Home($pages, $status = "", $filter ="", $pg = 1){
            $pg = ($pg - 1)*8;
            switch ($pages) {
              case 'list_order':
                if($status == "" && $filter == ""){
                    $this->order_view->Order_Home($this->order_m->GetSomeOrder($pg));
                }
                if($status != "" && $filter == ""){
                    switch($status){
                        case "chua-xac-nhan": {
                            $this->order_view->Order_Home($this->order_m->GetSomeOrder(
                                $pg,
                                "DESC",
                                "WHERE status_order = 0"
                            ));                           
                        };break;
                        case "da-xac-nhan": {
                            $this->order_view->Order_Home($this->order_m->GetSomeOrder(
                                $pg,
                                "DESC",
                                "WHERE status_order = 1"
                            )); 
                        };break;
                    }
                }
                if($status == "" && $filter != ""){
                    switch($filter){
                        case "desc": case "asc":{
                            $this->order_view->Order_Home($this->order_m->GetSomeOrder(
                                $pg,
                                $filter
                            ));                            
                        };break;
                    }
                }
                if($status != "" && $filter != ""){
                    $status_order = ($status == "da-xac-nhan") ? 1 : 0;
                    switch($filter){
                        case "desc": case "asc":{
                            $this->order_view->Order_Home($this->order_m->GetSomeOrder(
                                $pg,
                                $filter,
                                "WHERE status_order = $status_order"
                            ));                           
                        };break;
                    }
                }
                break;
              case 'contacts': {
                if($status == "" && $filter == ""){
                    $this->contact_view->Main_Contact_View($this->order_m->GetSomeContact($pg));
                }
                if($status != "" && $filter == ""){
                    switch($status){
                        case "chua-xac-nhan": {
                            $this->contact_view->Main_Contact_View($this->order_m->GetSomeContact(
                                $pg,
                                "DESC",
                                "WHERE viewed_contact_us = 0"
                            ));                           
                        };break;
                        case "da-xac-nhan": {
                            $this->contact_view->Main_Contact_View($this->order_m->GetSomeContact(
                                $pg,
                                "DESC",
                                "WHERE viewed_contact_us = 1"
                            )); 
                        };break;
                    }
                }
                if($status == "" && $filter != ""){
                    switch($filter){
                        case "desc": case "asc":{
                            $this->contact_view->Main_Contact_View($this->order_m->GetSomeContact(
                                $pg,
                                $filter
                            ));                            
                        };break;
                    }
                }
                if($status != "" && $filter != ""){
                    $status_contact = ($status == "da-xac-nhan") ? 1 : 0;
                    switch($filter){
                        case "desc": case "asc":{
                            $this->contact_view->Main_Contact_View($this->order_m->GetSomeContact(
                                $pg,
                                $filter,
                                "WHERE viewed_contact_us = $status_contact"
                            ));                           
                        };break;
                    }
                }
              };break;
              case 'list_order_usa': {
                if($status == "" && $filter == ""){
                  $this->view_trans->Main_Order_Usa_View($this->model_trans->Get_All_Trans($pg, ""));
                }
                if($status != "" && $filter == ""){
                    switch($status){
                        case "chua-xac-nhan": {
                            $this->view_trans->Main_Order_Usa_View($this->model_trans->Get_All_Trans(
                                $pg,
                                "WHERE onoff_order_usa = 0",
                                "DESC"
                            ));                           
                        };break;
                        case "da-xac-nhan": {
                            $this->view_trans->Main_Order_Usa_View($this->model_trans->Get_All_Trans(
                                $pg,
                                "WHERE onoff_order_usa = 1",
                                "DESC"
                            )); 
                        };break;
                    }
                }
                if($status == "" && $filter != ""){
                    switch($filter){
                        case "desc": case "asc":{
                            $this->view_trans->Main_Order_Usa_View($this->model_trans->Get_All_Trans(
                                $pg,
                                " ",
                                $filter
                            ));                            
                        };break;
                    }
                }
                if($status != "" && $filter != ""){
                    $status_contact = ($status == "da-xac-nhan") ? 1 : 0;
                    switch($filter){
                        case "desc": case "asc":{
                            $this->view_trans->Main_Order_Usa_View($this->model_trans->Get_All_Trans(
                                $pg,
                                "WHERE onoff_order_usa = $status_contact",
                                $filter
                            ));                           
                        };break;
                    }
                }
                
              };break;
            }
        }

        public function Contact_Detail($id){
            $get_contact = $this->order_m->GetOneContact($id);
            $this->contact_view->Contact_Detail($get_contact);
        }
        public function Order_Detail($id){
            $get_order = $this->order_m->GetOneOrder($id);
            $prd_order = $this->order_m->GetPrdOrder($id);
            $this->order_view->Order_detail($get_order, $prd_order);
        }
        public function Order_Usa_Detail($id){
            $get_order = $this->model_trans->Get_One_Trans($id);
            $this->view_trans->Order_Usa_Detail($get_order);
        }
        public function Confirm_Order($id, $dir){
            if($dir == "order"){
              $this->order_m->Confirm_Order($id);
            }
            if($dir == "contact"){
              $this->order_m->Confirm_Contact($id);
            }
            if($dir == "list_order_usa"){
                $this->model_trans->Check_On_One_Trans($id);
              }
        }
        public function Un_Confirm_Order($id, $dir){
            if($dir == "order"){
              $this->order_m->Un_Confirm_Order($id);
            }
            if($dir == "contact"){
              $this->order_m->Un_Confirm_Contact($id);
            }
            if($dir == "list_order_usa"){
              $this->model_trans->Check_Off_One_Trans($id);
            }
        }
        public function Delete_Order($id, $dir){
          if($dir == "order"){
              $this->order_m->Delete_Order($id);
          }
          if($dir == "contact"){
              $this->order_m->Delete_Contact($id);
          }
          if($dir == "list_order_usa"){
              $this->model_trans->Delete_One_Trans($id);
          }
        }
        public function Pg_List_Order($pg){
            return $this->order_m->GetSomeOrder($pg);
        }
    }
?>
