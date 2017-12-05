<?php

/**
 * This is the model class for table "v_receipt".
 *
 * The followings are the available columns in table 'v_receipt':
 * @property integer $id
 * @property double $pay_amount
 * @property string $pay_date
 * @property integer $pay_type
 * @property string $code
 * @property integer $id_customer
 * @property integer $id_author
 */
class VReceipt extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_receipt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, pay_type, id_customer, id_author', 'numerical', 'integerOnly'=>true),
			array('pay_amount', 'numerical'),
			array('code', 'length', 'max'=>45),
			array('pay_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pay_amount, pay_date, pay_type, code, id_customer, id_author', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pay_amount' => 'Pay Amount',
			'pay_date' => 'Pay Date',
			'pay_type' => 'Pay Type',
			'code' => 'Code',
			'id_customer' => 'Id Customer',
			'id_author' => 'Id Author',
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
		$criteria->compare('pay_amount',$this->pay_amount);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('pay_type',$this->pay_type);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('id_author',$this->id_author);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VReceipt the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function search_receipt($curpage,$limit,$type,$branch,$search_time,$lstUser,$fromtime="",$totime="")
    {
         $start_point=$limit*($curpage-1);
        $p = new VReceipt;         
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        
        $time = 0;

        if($search_time) {       // thời gian
            if($search_time == 1) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(pay_date) = :pay_date');
                $v->params = array(':pay_date' => $time);
            }
            elseif ($search_time == 2) {         // trong tuần
                $time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));  
                $v->addCondition('DATE(pay_date) >="'. $time_fisrt .'" AND DATE(pay_date) <="'.$time_last.'"');
            }
            elseif($search_time == 3){                               // trong tháng 
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(pay_date) = :pay_date');
                $v->params = array(':pay_date' => $time);
            }
            elseif($search_time == 4){
                $time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
                $v->addCondition('MONTH(pay_date) = :pay_date');
                $v->params = array(':pay_date' => $time);
            } elseif($search_time == 5){
            	$v->addCondition('DATE(pay_date) >="'. $fromtime .'" AND DATE(pay_date) <="'.$totime.'"');
            }
        }
        if($branch) {         
            $v->addCondition('id_branch ='. $branch);
        }

        $count=count($p->findAll($v));

        $v->order= 'id ASC';
      
        $v->limit = $limit;
        $v->offset = $start_point;
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }
    public function search_exportReceipt($type,$branch,$search_time,$lstUser,$fromtime="",$totime="")
    {
        $p = new VReceipt;         
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria();
        $time = 0;

        if($search_time) {       // thời gian
            if($search_time == 1) {              // hôm nay
                $time = date('Y-m-d');
                $v->addCondition('DATE(pay_date) = :pay_date');
                $v->params = array(':pay_date' => $time);
            }
            elseif ($search_time == 2) {         // trong tuần
                $time_fisrt = date('Y-m-d',strtotime('monday this week'));
				$time_last = date('Y-m-d',strtotime('sunday this week'));  
                $v->addCondition('DATE(pay_date) >="'. $time_fisrt .'" AND DATE(pay_date) <="'.$time_last.'"');
            }
            elseif($search_time == 3){                               // trong tháng 
                $time = date('m',strtotime(date('Y-m-d')));
                $v->addCondition('MONTH(pay_date) = :pay_date');
                $v->params = array(':pay_date' => $time);
            }
            elseif($search_time == 4){
                $time = date('m',strtotime(date('Y-m-d') . ' - 1 month')); //tháng trước
                $v->addCondition('MONTH(pay_date) = :pay_date');
                $v->params = array(':pay_date' => $time);
            } elseif($search_time == 5){
            	$v->addCondition('DATE(pay_date) >="'. $fromtime .'" AND DATE(pay_date) <="'.$totime.'"');
            }
        }
        if($branch) {         
            $v->addCondition('id_branch ='. $branch);
        }

        $count=count($p->findAll($v));

        $v->order= 'id ASC';
        $q->mergeWith($v);      
         
        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }
//////////////////////////////ReportingBusiness////////////////////////////
    public function totalValueInvoice($branch,$month,$year,$currency_use){ //Tổng giá trị hóa đơn theo tháng
 		$con = Yii::app()->db;
		$sql = "select SUM(sum_amount) as sumAmount from v_invoice where 1 = 1";
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($currency_use){
            $sql.=" and currency_use='$currency_use'";
        }
		if($month && $year){
			$sql.= " and (month(v_invoice.`create_date`)='$month' and year(v_invoice.`create_date`)='$year')";
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return (int)$data[0]['sumAmount'];
		}
		else
			return 0;
 	}

 	public function totalValueBalance($branch,$month,$year,$currency_use){ //Tổng giá trị công nợ theo tháng
 		$con = Yii::app()->db;
		$sql = "select SUM(balance) as balance from v_invoice where 1 = 1";
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($currency_use){
            $sql.=" and currency_use='$currency_use'";
        }
		if($month && $year){
			$sql.= " and (month(v_invoice.`create_date`)='$month' and year(v_invoice.`create_date`)='$year')";
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return (int)$data[0]['balance'];
		}
		else
			return 0;
 	}
 	public function totalValueReceipt($branch,$month,$year,$currency_use){ //Tổng giá trị thanh toán theo tháng
 		$con = Yii::app()->db;
		$sql = "select SUM(curr_amount) as curr_amount from v_receipt where 1 = 1";
		if ($branch) {
			$sql.=" and id_branch=$branch";
		}
		if($currency_use){
            $sql.=" and curr_unit='$currency_use'";
        }
		if($month && $year){
			$sql.= " and (month(v_receipt.`pay_date`)='$month' and year(v_receipt.`pay_date`)='$year')";
		}
		
		$data = $con->createCommand($sql)->queryAll();
		if ($data) {
			return (int)$data[0]['curr_amount'];
		}
		else
			return 0;
 	}
// tiêu đề search report
 	public function titleReport($search_time,$branch,$user,$fromtime,$totime){
 		$string ='';
 		if($search_time){
		    if($search_time == "1"){
				$fromdate = date("d-m-Y");
				$todate= "";
				$string .= $fromdate;
			
			} elseif($search_time == "2"){
				$fromdate = date("d-m-Y",strtotime('monday this week'));
				$todate= date("d-m-Y",strtotime('sunday this week'));
				$string .= $fromdate .' đến '.$todate;
			}elseif($search_time == "3"){
				 $fromdate = date("01-m-Y", strtotime("first day of this month"));
				 $todate= date("t-m-Y", strtotime("last day of this month"));
				$string .= $fromdate .' đến '.$todate;
			}elseif($search_time == "4"){
				$fromdate = date("d-m-Y", strtotime('first day of last month'));
		    	$todate= date("d-m-Y", strtotime('last day of last month'));
				$string .= $fromdate .' đến '.$todate;
			}else{
				$string .= $fromtime .' đến '.$totime;
			}
		}
		if($branch == ''){
			$string .= ', Tất cả văn phòng';
		}elseif ($branch) {
			$branchList =  Branch::model()->findByPk($branch);
			if($branchList){
				$string .= ', Văn phòng: '.$branchList->name;
			}
		}
		if($user == ''){
			$string .= ', Tất cả nhân viên';
		}elseif ($user) {
			$userList =  GpUsers::model()->findByPk($user);
			if($userList){
				$string .= ', Bác sĩ: '.$userList->name;
			}
		}

		return $string;
	}
}
