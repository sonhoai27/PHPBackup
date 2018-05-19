<?php
    class indexController extends BaseController {
        public function index(){
            $this->view->data['title'] = "Son Ne";
            $this->view->data['titles'] = "Son NeS";
            $this->view->show('index_view');
            $this->render("main", "foot");
        }
    }
?>