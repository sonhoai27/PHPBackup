<?php
class sexModel extends BaseModel{
    public function getSex(){
        global $db;
        $sex = $db->query("SELECT * FROM `sex_prd`");
        return $db->fetch_array();
    }
}