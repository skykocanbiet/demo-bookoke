<?php

class NotificationsController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/layouts_menu';

	/**
	* @return array action filters
	*/
	public function filters()
	{
	return array(
	'accessControl', // perform access control for CRUD operations
	);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return parent::accessRules();
	}

	public function actionView()
	{
		$branch = Branch::model()->findAll();
		$branchList = CHtml::listData($branch, 'id', 'name');

		$this->render('view',array('branch'=>$branchList));
	}
	public function watchedNotifications(){

		if($_POST['id']){

		}
		
	}

	public function actionViewDetail()
	{
		$page   = isset($_POST['page']) ? $_POST['page'] : 1;

		$limit  = 15;

		$noties = VNotification::model()->searchNotification($page,$limit);

		$noty   = $noties['data'];
		$count  = $noties['count'];

		$page_list = $this->paging($page,$count,$limit);

		$this->renderpartial('notyList',array('noty'=>$noty,'page_list'=>$page_list));
	}

    public function paging($page,$count,$limit)
    {
        $curpage = $page;
        $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;

        $page_list = '';

        if(($curpage!=1)&&($curpage))
        {
            $page_list .= '<span onclick="loadNoti(1);" style="cursor:pointer;" class="div_trang">';
            $page_list .= '<a style="color:#000000;" title="Trang đầu"><<</a></span>';
        }
        if(($curpage-1)>0)
        {
            $page_num = $curpage - 1;
            $page_list .= '<span onclick="loadNoti('.$page_num.');" style="cursor:pointer;" class="div_trang">';
            $page_list .= '<a style="color:#000000;" title="Về trang trước"><</a></span>';
        }               
        $vtdau=max($curpage-3,1);
        $vtcuoi=min($curpage+3,$pages);             
        for($i=$vtdau;$i<=$vtcuoi;$i++)
        {
            if($i==$curpage)
            {
                $page_list .= '<span style="background:rgba(115, 149, 158, 0.80);"  class="div_trang">'."<b style='color:#FFFFFF;'>".$i."</b></span>";
            }
            else
            {
                $page_list .= '<span onclick="loadNoti('.$i.');" style="cursor:pointer;" class="div_trang">';
                $page_list .= '<a style="color:#000000;" title="Trang' .$i.'">'.$i.'</a></span>';
            }
        }
        if(($curpage+1)<=$pages)
        {
            $page_list .= '<span onclick="loadNoti('.$curpage.' + 1);" style="cursor:pointer;" class="div_trang"><a style="color:#000000;" title="Đến trang sau">></a></span>';
            $page_list.='<span onclick="loadNoti('.$pages.');" style="cursor:pointer;" class="div_trang"><a style="color:#000000;" title="Đến trang cuối">>></a></span>';
        }

        return $page_list;
    }

    public function actionAllWatchNoti(){
    	$type = $_POST['type'];
    	$id_user =  Yii::app()->user->getState('user_id');
    	if($type == 2){
	    	$list_noti = 0;
	    	$data = CsNotifications::model()->getAllWatchedNotifications($list_noti, $id_user);
	    	if($data['status']=='Fail'){
	    		echo "-1";
	    	}else if($data['status']=='successful'){
	    		echo 1;
	    	}
		}elseif ($type == 3) {
	    	$list_noti = 0;
	    	$data = CsNotifications::model()->deleteNotifications($list_noti, $id_user);
	    	if($data['status']=='Fail'){
	    		echo "-1";
	    	}else if($data['status']=='successful'){
	    		echo 1;
	    	}
		}
		elseif ($type == 4) {
	    	$list_noti =$_POST['list_noti'];
	    	$data = CsNotifications::model()->getAllWatchedNotifications($list_noti, $id_user);
	    	if($data['status']=='Fail' && $data['error']==-2){
	    		echo "-1";
	    	}else if($data['status']=='successful'){
	    		echo 1;
	    	}
		}elseif ($type == 5) {
	    	$list_noti =$_POST['list_noti'];
	    	$data = CsNotifications::model()->deleteNotifications($list_noti, $id_user);
	    	if($data['status']=='Fail'){
	    		echo "-1";
	    	}else if($data['status']=='successful'){
	    		echo 1;
	    	}
		}
    }

    public function actionSumNoti(){
    		$sumNotification 	= CsNotifications::model()->getSumNotificationsNotSeen(Yii::app()->user->getState('user_id'));
    		echo $sumNotification;

    }

}
