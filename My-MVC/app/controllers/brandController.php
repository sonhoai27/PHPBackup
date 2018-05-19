<?php
	require_once ("./modules/phanTrang.php");
	class brandController extends BaseController {
		public function index(){
			$phanTrang = new phanTrang();
            $currentPage = isset($_GET['page']) ? $_GET['page'] : "1";
            $numPrdWillGet = ($currentPage - 1)* 16;
			
			
			$this->view->data['listBrands'] = $this->model->get('brandModel')->getBrand($numPrdWillGet);
			
			$this->view->data['phanTrang'] = $phanTrang->viewPhanTrang(
                $this->view->data['listBrands']['numRows'],
                $currentPage,
                16
            );
			
			$this->view->show("brand_view", "brand");
			
			$this->render("main", "foot");
		}
		
		public function detail(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				//1 get, 0 save
				if($_POST['status'] == 1){
					echo json_encode($this->model->get("brandModel")->detail($_POST['id']));
				}else if($_POST['status'] == 0){
					
				}
			}
		}
		
		public function add(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$data = array(
					"name_brand"=>$_POST['name'],
					"alias_brand"=>$_POST['alias']
				);
				echo $this->model->get("brandModel")->add($data);
			}
		}
		public function edit(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$id = isset($_POST['id']) ? $_POST['id'] : 0;
				$data = array(
					"name_brand"=>$_POST['name'],
					"alias_brand"=>$_POST['alias']
				);
				echo $this->model->get("brandModel")->edit($data, $id);
			}
		}
		
		public function search(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				echo json_encode($this->model->get("brandModel")->search($_POST['key']));
			}
		}
	}
