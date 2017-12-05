<?php

class SegmentController extends Controller
{
/**
* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
* using two-column layout. See 'protected/views/layouts/column2.php'.
*/
public $layout='/layouts/main_sup';

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

public function actionAdmin()
{
	$model            = new Segment;

	$this->render('admin',array('model'=>$model));
}

public function actionSearchSegment()
{

	$model 		   = new Segment;
	$cur_page      = isset($_POST['cur_page'])?$_POST['cur_page']:1;
	$lpp           = 20;
	$search_params = '';	
	$orderBy 	   = '`name` ASC ';

	if($_POST['type'] == 4){
		$orderBy = '`code` DESC ';
	}

	if ($_POST['value']) 
	{
		$search_params= 'AND (`name` LIKE "%'.$_POST['value'].'%" ) OR (`code` LIKE "%'.$_POST['value'].'%" )';
	}


	$data  = $model->searchSegment('','',' '.$search_params.' order by '.$orderBy,$lpp,$cur_page);

	if($cur_page > $data['paging']['cur_page']){	
		echo '<script>stopped = true; </script>';	
		exit;
	}

	$this->renderPartial('search_sort',array('model'=>$model,'list_data'=>$data,'page'=>$data['paging']['cur_page']));

}

public function actionDetailSegment()
{
	$model = new Segment();	

	$listSegmentRule = "";

	$lst = "";	

	$data = "";

	if(isset($_POST['id']) && isset($_POST['curpage']))
	{
		$model 	= $model->findByPk($_POST['id']);		

		$listSegmentRule = SegmentRule::model()->findAllByAttributes(array('id_segment'=>$_POST['id']));

		$limit = 20;  

		$count = count(CustomerSegment::model()->findAllByAttributes(array('id_segment'=>$_POST['id'])));

		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;	 

		$lst   = $model->pageList($_POST['curpage'],$pages,$_POST['id']); 

		$data  = $model->listCustomerSegmentPagination($_POST['curpage'],$limit,$_POST['id']);		

	}

	$this->renderPartial('segment_info',array('model'=>$model,'listSegmentRule'=>$listSegmentRule,'lst'=>$lst,'data'=>$data));

	
}

public function actionAddSegment()
{	
	$model  = new Segment;
		
	$result = $model->addSegment(array('name' => $_POST['name'], 'color' => $_POST['color'], 'code' => $_POST['code'], 'description' => $_POST['description'], 'segment_rule' => json_decode($_POST['segment_rule']))); 	
	
	echo $result;

	exit;	
			
}	

public function actionUpdateSegment()
{	
	$model  = new Segment;

	$result = $model->updateSegment(array('id_segment' => $_POST['id_segment'], 'name' => $_POST['name'], 'color' => $_POST['color'], 'code' => $_POST['code'], 'description' => $_POST['description'], 'segment_rule' => json_decode($_POST['segment_rule']))); 	
	
	echo $result;

	exit;	
			
}

public function actionUpdateSegmentNewName()
{
	$model=Segment::model()->findByPk($_POST['id_segment']);		
	$model->name=$_POST['segmentNewName'];					
	$model->update();
	
	echo "1";
	exit;
		
}	

public function actionDeleteSegment()
{
	$model=Segment::model()->findByPk($_POST['id']);		
	$model->status=0;					
	$model->update();		

	echo "1";
	exit;
	
}

}

