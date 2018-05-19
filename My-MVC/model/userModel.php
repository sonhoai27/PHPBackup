<?php
class userModel extends BaseModel {
    public function add($data){
        global $db;
        return $db->insert($data, 'user');
    }
	public function check($data){
        global $db;
		$user = $db->select('user', "
			user_email='".$db->sqlQuote($data['user_email'])."' 
			and user_password ='".$db->sqlQuote($data['user_password'])."'");
        if($user['user_password'] == $data['user_password']
		){
			$_SESSION['userId'] = $user['id'];
			$_SESSION['userEmail'] = $user['user_email'];
			$_SESSION['userStatus'] = $user['user_status'];
			return 1;
		}else{
			return 0;
		}
    }
}