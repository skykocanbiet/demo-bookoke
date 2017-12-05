<?php
class UserManager{
    
    public function isBlock($id){
        $criteria = new CDbCriteria();
        $criteria->select = 'id';
        $criteria->condition = 'id=:id AND block=:block';
        $criteria->params = array(':id'=>$id,':block'=>0);
        $model = GpUser::model()->find($criteria);
        return $model;
    }

    public function getGroupIdOfGuest() {
         $db = Yii::app()->db;

        $sql = "SELECT id FROM `gp_group` WHERE group_no = 'guest' ";

        $db = Yii::app()->db;
        $command = $db->createCommand($sql);
        $group_id = $command->queryScalar();

        return $group_id;
    }
    
    public function getActionOfGroup($group_id, $current_controller, $current_action) {

        $sql = "SELECT `a`.`name`
                FROM `gp_action` `a`
                    LEFT JOIN `gp_role` `r` ON  `r`.`action_id` LIKE CONCAT('%-', `a`.`id`, '-%')
                    LEFT JOIN `gp_group` `g` ON `g`.`id` = `r`.`group_id`
                    LEFT JOIN `gp_controller` `c` ON `a`.`controller_id` = `c`.`id`
                WHERE `g`.`id` = '$group_id' AND `c`.`name` = '$current_controller' AND `a`.`name` = '$current_action'
                UNION
                SELECT `r`.`action_id`
                FROM `gp_role` `r`
                    LEFT JOIN `gp_group` `g` ON `r`.`group_id` = `g`.`id`
                WHERE `g`.`id` = '$group_id'";

        $db = Yii::app()->db;
		
        $action =  $db->createCommand($sql)->queryScalar();
        
        return $action;
        
    }
	public function saveHistoryLogin($arr){
        extract($arr);
        $username = $arr['username'];
        $password = $arr['password'];

        $sql = "INSERT INTO gp_history_login (`username`, `password`, `ip`, `login_time`, `error_code`, `error_msg`) VALUES('$username', '$password', '$ip', NOW(), '$error_code', '$error_msg');";

        $db = Yii::app()->db;
        $affected_rows = $db->createCommand($sql)->execute();
        return $db->getLastInsertID();
    }

    public function saveHistoryLogout($id){
        $sql = "UPDATE gp_history_login SET `logout_time` = NOW() WHERE `id` = '$id';";
        $db = Yii::app()->db;
        $affected_rows = $db->createCommand($sql)->execute();
    }
	
	
}
?>