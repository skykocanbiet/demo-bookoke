<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules() {
        return array(
			array('allow', // allow users define in table role in database
                'expression'=>array($this, "checkAccessRule"),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function checkAccessRule() {
        
        //Get action name
        $current_action = strtolower($this->getAction()->getId());
		
        if(Yii::app()->user->isGuest && $current_action != 'login') {
            $this->redirect('http://bookoke.com/login');

        }

        //Get Controller name
        $current_controller = $this->getId(); // or $controllerId = Yii::app()->controller->id;
        

        // Get Current User ID
        $manager = new UserManager;

        if(Yii::app()->user->isGuest){
            $group_id = $manager->getGroupIdOfGuest();
        }
        else {
            $group_id = Yii::app()->user->getState('group_id');

            if(Yii::app()->user->getState('queue_login')){
                if(!Yii::app()->user->getState('queue_extension')){
                    return true;
                }
                
            }
        }
		
        $checkaction = $manager->getActionOfGroup($group_id, $current_controller, $current_action);

        
        if($current_action == 'login' || $current_action == 'logout'){
            return true;
        }

        if($checkaction == $current_action || $checkaction == '*') {
			return true;
        }
        die('Access Denied. Please contact to administrator.');
    }
}