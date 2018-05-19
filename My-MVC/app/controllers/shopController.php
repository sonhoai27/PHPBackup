<?php
	class shopController extends BaseController{
		function index(){
			echo "HAHA";
		}
		
		function order_manager(){
			$this->view->show("order_view","shop");
		}
		function order_add(){
			
		}
		function order_edit(){
			
		}
		function order_confirm(){
			
		}
		function order_detail(){
			
		}
		function order_delete(){
			
		}
		
		
		function contact_manager(){
			$this->view->show("contact_view","shop");
		}
		function contact_add(){
			
		}
		function contact_edit(){
			
		}
		function contact_confirm(){
			
		}
		function contact_detail(){
			
		}
		function contact_delete(){
			
		}
		
		
		function am_manager(){
			$this->view->show("usa_view","shop");
		}
		function am_add(){
			
		}
		function am_edit(){
			
		}
		function am_confirm(){
			
		}
		function am_detail(){
			
		}
		function am_delete(){
			
		}
	}