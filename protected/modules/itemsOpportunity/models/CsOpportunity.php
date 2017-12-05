<?php

/**
 * This is the model class for table "cs_opportunity".
 *
 * The followings are the available columns in table 'cs_opportunity':
 * @property integer $id
 * @property integer $id_lead
 * @property string $contact_person_name
 * @property string $organization_name
 * @property string $phone
 * @property string $email
 * @property string $title
 * @property double $deal_value
 * @property string $create_date
 * @property string $move_date
 * @property string $finish_date
 * @property integer $stage
 * @property string $currency
 * @property integer $st
 */
class CsOpportunity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cs_opportunity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// array('id_lead', 'required'),
            array('contact_person_name, phone, email, title, stage', 'required'),
			array('id_lead, stage, st', 'numerical', 'integerOnly'=>true),
			array('deal_value', 'numerical'),
			array('contact_person_name, organization_name, email, title, currency', 'length', 'max'=>255),
            array('phone', 'length', 'max'=>20),
			array('move_date, finish_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lead, contact_person_name, organization_name, phone, email, title, deal_value, create_date, move_date, finish_date, stage, currency, st', 'safe', 'on'=>'search'),
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
			'id_lead' => 'Id Lead',
            'contact_person_name' => 'Contact Person Name',
            'organization_name' => 'Organization Name',
            'phone' => 'Phone',
            'email' => 'Email',
			'title' => 'Title',
			'deal_value' => 'Deal Value',
			'create_date' => 'Create Date',
			'move_date' => 'Move Date',
			'finish_date' => 'Finish Date',
			'stage' => 'Stage',
            'currency' => 'Currency',
			'st' => 'St',
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
		$criteria->compare('id_lead',$this->id_lead);
        $criteria->compare('contact_person_name',$this->contact_person_name,true);
        $criteria->compare('organization_name',$this->organization_name,true);
        $criteria->compare('phone',$this->phone,true);
        $criteria->compare('email',$this->email,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('deal_value',$this->deal_value);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('move_date',$this->move_date,true);
		$criteria->compare('finish_date',$this->finish_date,true);
		$criteria->compare('stage',$this->stage);
        $criteria->compare('currency',$this->currency,true);
		$criteria->compare('st',$this->st);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CsOpportunity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
    public function getListUsers(){
        return GpUsers::model()->findAllByAttributes(array('block'=>0,'group_id'=>3));
    }
    
    public function getListMonths(){
        return Yii::app()->locale->getMonthNames();
    }
    
    /** Pagging **/
    public static function getPageSearch($cur_page,$lpp,$num_row){
        $lpp_org = $lpp;
        if($lpp == 'all'){
    		$lpp = $num_row;
    	}
        if($num_row < $lpp){
    		$cur_page = 1;
    		$num_page = 1;
    		$lpp      = $num_row;
    		$start    = 0;
    	}else{
    		$num_page     = ceil($num_row/$lpp); 
    		if($cur_page >= $num_page){
    			$cur_page = $num_page;
    			$lpp      = $num_row - ($num_page - 1) * $lpp_org;
    		} 
    		$start        = ($cur_page - 1) * $lpp_org;
    	}
        return array(   'num_row'   =>$num_row,
                        'num_page'  =>$num_page,
                        'cur_page'  =>$cur_page,
                        'lpp'       =>$lpp_org,
                        'start_num' =>$start+1
                );
    }
    public function AjaxSearchOpportunity(){ 
                
        $data   = Yii::app()->db->createCommand()
                ->select('cs_opportunity.id, cs_opportunity.id_lead, cs_opportunity.contact_person_name, cs_opportunity.organization_name, cs_opportunity.title, cs_opportunity.deal_value,cs_opportunity.create_date, cs_opportunity.move_date, cs_opportunity.finish_date, cs_opportunity.stage, cs_opportunity.currency')
                ->from('cs_opportunity')          
                ->where('cs_opportunity.st =:st', array(':st' => 0))
                ->order('stage ASC')               
                ->queryAll();
                        
        return array('data'=>$data);
        
    }

    public function AjaxSearchDealTable(){ 
                
        $data   = Yii::app()->db->createCommand()
                ->select('cs_opportunity.id, cs_opportunity.id_lead, cs_opportunity.contact_person_name, cs_opportunity.organization_name, cs_opportunity.title, cs_opportunity.deal_value,cs_opportunity.create_date, cs_opportunity.move_date, cs_opportunity.finish_date, cs_opportunity.stage, cs_opportunity.currency')
                ->from('cs_opportunity')          
                ->where('cs_opportunity.st =:st', array(':st' => 0))                           
                ->queryAll();
                        
        return array('data'=>$data);
        
    }
    
    public function InfoDealStage(){
       
        $data = Yii::app()->db->createCommand()
        ->select('stage, COUNT(id) AS number_stage, SUM(deal_value) AS value_stage')
        ->from('cs_opportunity')
        ->where('cs_opportunity.st =:st', array(':st' => 0))
        ->group('stage')
        ->queryAll();
        
        if(count($data) > 0){
            $reponse =  array();
            foreach($data as $key => $value ){
                $reponse[$value['stage']] = array(
                                                'number'=>$value['number_stage'],
                                                'value' =>$value['value_stage']
                                            );
            }
            return $reponse;
        }
        
    }

    public function toalDealStage($stage,$userid){
        if($userid){
            $data = Yii::app()->db->createCommand()
                ->select('cs_opportunity.id')
                ->from('cs_opportunity')
                ->leftJoin('cs_lead', 'cs_lead.id = cs_opportunity.id_lead')
                ->where('cs_opportunity.st =:st', array(':st' => 0))
                ->andWhere('cs_opportunity.stage =:stage', array(':stage' => $stage))
                ->queryAll();
        }else{
            
        }
        $data = Yii::app()->db->createCommand()
                ->select('cs_opportunity.id')
                ->from('cs_opportunity')
                ->leftJoin('cs_lead', 'cs_lead.id = cs_opportunity.id_lead')
                ->where('cs_opportunity.st =:st', array(':st' => 0))
                ->andWhere('cs_opportunity.stage =:stage', array(':stage' => $stage))
                ->queryAll();
        return count($data);  
    }
    
    public function toalValueDeal($stage,$userid){
        $data = Yii::app()->db->createCommand()
                ->select('SUM(cs_opportunity.deal_value) as value')
                ->from('cs_opportunity')
                ->leftJoin('cs_lead', 'cs_lead.id = cs_opportunity.id_lead')
                ->where('cs_opportunity.st =:st', array(':st' => 0))
                ->andWhere('cs_opportunity.stage =:stage', array(':stage' => $stage))
                ->queryScalar();
        return $data;
    }
    
    public function checkSchedule($id){
        $data = Yii::app()->db->createCommand()
            ->select('*')
            ->from('cs_opportunity_schedule')
            ->where('cs_opportunity_schedule.id_opportunity =:id_opportunity', array(':id_opportunity' => $id))
            ->andWhere('cs_opportunity_schedule.st =:st', array(':st' => 1))
            ->order('datetime_schedule')
            ->queryAll();
        return $data;
     }
     public function getLeadPhone($idlead){
        return $data = Yii::app()->db->createCommand()
                ->select('phone')
                ->from('cs_lead')
                ->where('cs_lead.id =:idlead', array(':idlead' => $idlead))
                ->queryRow();
     }
     public function getIdDeal($id){
       return  $data   = Yii::app()->db->createCommand()
                ->select('cs_opportunity.id, cs_opportunity.id_lead, cs_opportunity.contact_person_name, cs_opportunity.organization_name, cs_opportunity.title, cs_opportunity.deal_value,cs_opportunity.create_date, cs_opportunity.move_date, cs_opportunity.finish_date, cs_opportunity.stage')
                ->from('cs_opportunity')          
                ->where('cs_opportunity.id =:id', array(':id' => $id))
                ->queryRow();
     }
     public function getIdScheduleActivity($id){
       return  $data   = Yii::app()->db->createCommand()
                ->select('*')
                ->from('cs_opportunity_schedule')
                ->where('cs_opportunity_schedule.id =:id', array(':id' => $id))
                ->queryRow();
     }
     
     public function intervale_deal_activity($enddatetime,$stardatetime){
            
            if($enddatetime > $stardatetime){
                $intervale = ($enddatetime-$stardatetime)/3600;
            }else{
                $intervale = ($stardatetime-$enddatetime)/3600;
            }
            if($intervale > 24){
               $data  = round($intervale / 24).' ngày';
            }else{
                $data = round($intervale).' giờ';
            }
            return $data;
     }
     public function getAllListPhone($userid,$phone){

        if($userid){
          return  $data = Yii::app()->db->createCommand()
            ->select('cs_lead.id, cs_lead.phone, cs_lead.status')
            ->from('cs_lead')     
            ->where('cs_lead.phone LIKE :phone'  , array(':phone'=>'%'.$phone.'%'))
            ->order('status ASC')
            ->limit(10)
            ->queryAll(); 
        }else{
        return $data = Yii::app()->db->createCommand()
            ->select('cs_lead.id, cs_lead.phone, cs_lead.status')
            ->from('cs_lead')            
            ->where('cs_lead.phone LIKE :phone'  , array(':phone'=>'%'.$phone.'%'))
            ->order('status ASC')
            ->limit(10)
            ->queryAll(); 
        }
       
     }

     public function getAllListContactPersonName($userid,$contact_person_name){

        if($userid){
          return  $data = Yii::app()->db->createCommand()
            ->select('id, contact_person_name')
            ->from('cs_opportunity')  
            ->where('contact_person_name LIKE :contact_person_name'  , array(':contact_person_name'=>'%'.$contact_person_name.'%'))
            ->limit(10)
            ->queryAll(); 
        }else{
        return $data = Yii::app()->db->createCommand()
            ->select('id, contact_person_name')
            ->from('cs_opportunity')            
            ->where('contact_person_name LIKE :contact_person_name'  , array(':contact_person_name'=>'%'.$contact_person_name.'%'))  
            ->limit(10)
            ->queryAll(); 
        }
       
     }

     public function getAllListOrganizationName($userid,$organization_name){

        if($userid){
          return  $data = Yii::app()->db->createCommand()
            ->select('id, organization_name')
            ->from('cs_opportunity')  
            ->where('organization_name LIKE :organization_name'  , array(':organization_name'=>'%'.$organization_name.'%'))
            ->limit(10)
            ->queryAll(); 
        }else{
        return $data = Yii::app()->db->createCommand()
            ->select('id, organization_name')
            ->from('cs_opportunity')            
            ->where('organization_name LIKE :organization_name'  , array(':organization_name'=>'%'.$organization_name.'%'))  
            ->limit(10)
            ->queryAll(); 
        }
       
     }

     public function CheckPhoneOpp($id_user,$phone){
        if($id_user){
            $lead_info = Yii::app()->db->createCommand()
            ->select('cs_lead.id')
            ->from('cs_lead')
            ->where('cs_lead.phone =:phone', array(':phone' => $phone))
            ->queryScalar();
        }else{
            $lead_info = Yii::app()->db->createCommand()
            ->select('cs_lead.id')
            ->from('cs_lead')
            ->where('cs_lead.phone =:phone', array(':phone' => $phone))
            ->queryScalar();
        }
        if($lead_info){
            return $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('cs_opportunity')
                ->where('cs_opportunity.id_lead =:id_lead', array(':id_lead' => $lead_info))
                ->queryRow();
        }
        return 0; 
        
     }

     public function CheckContactPersonNameOpp($id_user,$contact_person_name){
        if($id_user){
            $lead_info = Yii::app()->db->createCommand()
            ->select('cs_opportunity.id')
            ->from('cs_opportunity')
            ->where('cs_opportunity.contact_person_name =:contact_person_name', array(':contact_person_name' => $contact_person_name))
            ->queryScalar();
        }else{
            $lead_info = Yii::app()->db->createCommand()
            ->select('cs_opportunity.id')
            ->from('cs_opportunity')
            ->where('cs_opportunity.contact_person_name =:contact_person_name', array(':contact_person_name' => $contact_person_name))
            ->queryScalar();
        }    
        if($lead_info){
            return $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('cs_opportunity')
                ->where('cs_opportunity.id =:id', array(':id' => $lead_info))
                ->queryRow();
        }
        return 0; 
        
     }

     public function CheckOrganizationNameOpp($id_user,$organization_name){
        if($id_user){
            $lead_info = Yii::app()->db->createCommand()
            ->select('cs_opportunity.id')
            ->from('cs_opportunity')
            ->where('cs_opportunity.organization_name =:organization_name', array(':organization_name' => $organization_name))
            ->queryScalar();
        }else{
            $lead_info = Yii::app()->db->createCommand()
            ->select('cs_opportunity.id')
            ->from('cs_opportunity')
            ->where('cs_opportunity.organization_name =:organization_name', array(':organization_name' => $organization_name))
            ->queryScalar();
        }    
        if($lead_info){
            return $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('cs_opportunity')
                ->where('cs_opportunity.id =:id', array(':id' => $lead_info))
                ->queryRow();
        }
        return 0; 
        
     }

     public function ExportPhoneSure(){
        return $data = Yii::app()->db->createCommand()
            ->select('cs_raw_lead.phone as phone')
            ->from('cs_raw_lead')
            ->leftJoin('cs_sale', 'cs_sale.id_customer = cs_raw_lead.idlead')
            ->where('cs_sale.id_product_detail =:id_product_detail', array(':id_product_detail' => '2'))
            ->andWhere('cs_raw_lead.status =:status', array(':status' => '1'))
            ->group('cs_raw_lead.idlead')
            ->order('cs_raw_lead.phone ASC')
            ->queryAll(); 
     }
     
     public function ExportPhone(){
        $data = Yii::app()->db->createCommand()
            ->select('cs_raw_lead.idlead as idlead, cs_raw_lead.phone as phone, cs_raw_lead.firstname as firstname, cs_raw_lead.lastname as lastname ')
            ->from('cs_raw_lead')
            ->leftJoin('cs_sale', 'cs_sale.id_customer = cs_raw_lead.idlead')
            ->where('cs_sale.id_product_detail =:id_product_detail', array(':id_product_detail' => '2'))
            ->andWhere('cs_raw_lead.status =:status', array(':status' => '1'))
            ->group('cs_raw_lead.idlead')
            ->order('cs_raw_lead.phone ASC')
            ->queryAll(); 
         if($data){
            $rs = array();
            foreach( $data as $key => $value){
                $order = $this->orderphone($value['idlead']);
                if($order){
                    $rs[$key] = array('phone'=>$value['phone'],'fullname'=>$value['firstname'].' '.$value['lastname'],'date'=>$order['date']);
                }
            }
            return $rs;
         }   
     }
     public function orderphone($idlead){
        return $data = Yii::app()->db->createCommand()
                ->select('*')
                ->from('cs_sale')
                ->where('cs_sale.id_customer =:id_customer', array(':id_customer' => $idlead))
                ->andWhere('cs_sale.id_product_detail =:id_product_detail', array(':id_product_detail' => '2'))
                ->order('cs_sale.date DESC')
                ->queryRow();
     }

    public function money_format($format, $number){
        
        $format = "$ ".number_format($number,2,".",",");
        
        return $format;
        
    }

    public function getMinDateTimeSchedule($id){

        $result = array();
        $data = CsOpportunitySchedule::model()->findAllByAttributes(array("id_opportunity"=>$id));        
        if($data && count($data) > 0){        
            $min_value = $data[0]['datetime_schedule'];            
            foreach ($data as $key => $value) {                
                if (strtotime($value['datetime_schedule']) < strtotime($min_value)) {                
                    $min_value = $value['datetime_schedule'];                    
                }
            }
            return $min_value;  
        }
    }

    public function editTitle($id,$title){
        
        $con = Yii::app()->db;
        $sql="UPDATE cs_opportunity SET title = '$title' WHERE id='$id'";
        $data=$con->createCommand($sql)->execute();
        if($data)
            return 1;      
        else
            return 0;       
       
    }

    public function editValue($id,$value,$currency){
        
        $con = Yii::app()->db;
        $sql="UPDATE cs_opportunity SET deal_value = '$value',currency='$currency' WHERE id='$id'";
        $data=$con->createCommand($sql)->execute();
        if($data)
            return 1;      
        else
            return 0;       
       
    }

    public function editOrganization($id,$organization){
        
        $con = Yii::app()->db;
        $sql="UPDATE cs_opportunity SET organization_name = '$organization' WHERE id='$id'";
        $data=$con->createCommand($sql)->execute();
        if($data)
            return 1;      
        else
            return 0;       
       
    }

    public function editContactPerson($id,$contact_person){
        
        $con = Yii::app()->db;
        $sql="UPDATE cs_opportunity SET contact_person_name = '$contact_person' WHERE id='$id'";
        $data=$con->createCommand($sql)->execute();
        if($data)
            return 1;      
        else
            return 0;       
       
    }

    public function editFinishDate($id,$finish_date){
        
        $con = Yii::app()->db;
        $sql="UPDATE cs_opportunity SET finish_date = '$finish_date' WHERE id='$id'";
        $data=$con->createCommand($sql)->execute();
        if($data)
            return 1;      
        else
            return 0;       
       
    }

    public function deleteDeal($id){
        
        $con = Yii::app()->db;
        $sql="UPDATE cs_opportunity SET st = -1 WHERE id='$id'";
        $data=$con->createCommand($sql)->execute();
        if($data)
            return 1;      
        else
            return 0;       
       
    }

    public function getVnPhone($phone){
         $phone =preg_replace("/[^0-9]/", "", $phone);//remove none numberic
         if(strlen($phone)==0)
             return "";
        if(strlen($phone)>16)
            $phone = substr($phone,0,16);
        if(substr( $phone, 0, 1 ) === "0"){
            $phone ="84". substr($phone,1,strlen($phone));
        } else if(substr( $phone, 0, 3 ) == "840"){
            $phone ="84".substr( $phone, 3, strlen($phone) );
        }
        else if(substr( $phone, 0, 2 ) != "84"){
            $phone ="84".$phone;
        }
        return $phone;
    }
	
	public function addNewDealOpportunity($data = array('contact_person_name' => '', 'title' => '', 'email' => '', 'phone' => '', 'deal_value' => '', 'currency' => '', 'finish_date' => '')){ 
        
        if(!$data['contact_person_name']){
            return -1; 
        }

        if(!$data['title']){
            return -2; 
        }

        if(!$data['email']){
            return -3; 
        }

        if(!$data['phone']){
            return -4; 
        }

        if(!$data['deal_value']){
            return -5; 
        }

        if(!$data['currency']){
            return -6; 
        }

        if(!$data['finish_date']){
            return -7; 
        }

        $cs_opportunity             = new CsOpportunity; 
        $cs_opportunity->attributes = $data;

        if($cs_opportunity->validate() && $cs_opportunity->save()){  

            return $cs_opportunity->id;   

        }else{

            return 0; 

        }

    }

    public function updateDealOpportunity($data = array('id' => '', 'title' => '', 'deal_value' => '', 'currency' => '', 'contact_person_name' => '')){ 
         
        if(!$data['id']){
            return -1; 
        }
                   
        if(!$data['title']){
            return -2; 
        }

        if(!$data['deal_value']){
            return -3; 
        }

        if(!$data['currency']){
            return -4; 
        }

        if(!$data['contact_person_name']){
            return -5; 
        }       


        $cs_opportunity             = CsOpportunity::model()->findByPk($data['id']);  
        $cs_opportunity->attributes = $data;

        if($cs_opportunity->validate() && $cs_opportunity->save()){  

            return 1;   

        }else{

            return 0; 

        }

    }

    public function addNewScheduleActivity($data = array('id_opportunity' => '', 'datetime_schedule' => '', 'time_schedule' => '', 'duration' => '')){ 
         
        if(!$data['id_opportunity']){
            return -1; 
        } 

        if(!$data['datetime_schedule']){
            return -2; 
        }

        if(!$data['time_schedule']){
            return -3; 
        }

        if(!$data['duration']){
            return -4; 
        }       


        $cs_opportunity_schedule                = new CsOpportunitySchedule;         
        $cs_opportunity_schedule->attributes    = $data;
        $cs_opportunity_schedule->type_schedule = 2; 
        $cs_opportunity_schedule->name_schedule = "Hẹn gặp"; 

        if($cs_opportunity_schedule->validate() && $cs_opportunity_schedule->save()){  

            return 1;   

        }else{

            return 0; 

        }

    }
	
}
