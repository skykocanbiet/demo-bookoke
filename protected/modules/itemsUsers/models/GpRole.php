<?php

/**
 * This is the model class for table "role_ccp".
 *
 * The followings are the available columns in table 'role_ccp':
 * @property integer $id
 * @property integer $group_id
 * @property string  $action_id
 */
class GpRole extends CActiveRecord
{
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gp_role';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('group_id','required'),
			array('group_id', 'numerical', 'integerOnly'=>true),
            array('group_id','unique', 'message'=>'Group is already exist, please change'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, action_id', 'safe', 'on'=>'search'),
            
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'rel_group' => array(self::BELONGS_TO,'GpGroup','group_id'),
            //'list_action'=>array(self::HAS_MANY, 'Post', 'author_id'),
            'rel_action' => array(self::MANY_MANY, 'GpAction', 'ActionRole(action_id, id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Group',
			'action_id' => 'Action',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('action_id',$this->action_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoleCcp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    public function getControllersActions(){

        $list_data      = Yii::app()->metadata->getModulesControllersActions();
     
        $arr_controller = array();   
        $arr_action     = array();
        if($list_data){
            foreach($list_data as $key => $value){
                $name            = substr_replace($value['name'],'',-10);
                $arr_controller[]= $name;
                $info_controller = GpController::model()->findByAttributes(array("name"=>$name));
                
                if(!$info_controller){
                    $newcontroller = new GpController();
                    $newcontroller->name = $name;
                    
                    if($newcontroller->save(false)){
                        if(count($value['actions']) > 0){
                            foreach($value['actions'] as $temp){
                                $arr_action[] = strtolower($temp);
                                if(!GpAction::model()->findByAttributes(array('name'=>strtolower($temp),'controller_id'=>$newcontroller->id))){
                                    $actions = new GpAction();
                                    $actions->name = strtolower($temp);
                                    $actions->controller_id = $newcontroller->id;
                                    $actions->save(false);
                                }
                                
                            }
                        }
                    }
                }else{
                    if(count($value['actions']) > 0 && is_array($value['actions'])){
                        foreach($value['actions'] as $temp){
                            $arr_action[] = strtolower($temp);
                            if(!GpAction::model()->findByAttributes(array('name'=>strtolower($temp),'controller_id'=>$info_controller->id))){
                                $actions = new GpAction();
                                $actions->name = strtolower($temp) ;
                                $actions->controller_id = $info_controller->id;
                                $actions->save(false);
                            }
                        }
                    }
                }
            }
            foreach(GpAction::model()->findAll() as $key =>$value){
                if(!in_array($value['name'],$arr_action)){
                    GpAction::model()->deleteByPk($value['id']);
                }
            }
            foreach(GpController::model()->findAll() as $key =>$value){
                if(!in_array($value['name'],$arr_controller)){
                    if(GpController::model()->deleteByPk($value['id'])){
                        $arr_action = GpAction::model()->findAllByAttributes(array('controller_id'=>$value['id']));
                        $arr_action_id = array();
                        foreach($arr_action as $action){
                            $action_id = $action->id;
                            $arr_action_id[] = $action_id;
                        }
                        $result = GpAction::model()->deleteAllByAttributes(array('controller_id'=>$value['id']));
                    }
                }
            }
            $this->updateRoleAfterDeleteController();
			$this->getAutoGroup();
        }
        return true;
    }
    public function updateRoleAfterDeleteController(){
        $role_all = GpRole::model()->findAll();
        foreach($role_all as $role){
            if($role->action_id != '*' AND $role->action_id != ""){
                $actions = $role->action_id;
                $actions = trim($actions,'-');
                $arr_action = explode('-',$actions);
                $final_arr_action = array();
                foreach($arr_action as $v){
                    $action = GpAction::model()->findByPk($v);
                    if($action){
                        $final_arr_action[] = $v;
                    }
                }
                $actions = implode('-',$final_arr_action);
                $actions = '-'.$actions.'-';
                $result = GpRole::model()->updateByPk($role->id,array('action_id'=>$actions));
            }
            
        }
    }
    public function getAutoGroup(){
        $group_all  = GpGroup::model()->findAll();
        foreach($group_all as $group)
        {
            if(!GpRole::model()->findByAttributes(array('group_id'=>$group['id']))){
                $role =  new GpRole();
                $role->group_id  = $group['id'];
                $role->save();
            }
        }    
    }    
}
