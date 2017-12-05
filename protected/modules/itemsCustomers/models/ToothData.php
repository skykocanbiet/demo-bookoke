<?php

/**
 * This is the model class for table "tooth_data".
 *
 * The followings are the available columns in table 'tooth_data':
 * @property integer $id
 * @property integer $id_customer
 * @property integer $id_group_history
 * @property integer $tooth_number
 * @property integer $tooth_data
 */
class ToothData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tooth_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_customer, id_group_history, tooth_number, tooth_data', 'required'),
			array('id_customer, id_group_history, tooth_number, tooth_data', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_customer, id_group_history, tooth_number, tooth_data', 'safe', 'on'=>'search'),
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
			'id_customer' => 'Id Customer',
			'id_group_history' => 'Id Group History',
			'tooth_number' => 'Tooth Number',
			'tooth_data' => 'Tooth Data',
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
		$criteria->compare('id_customer',$this->id_customer);
		$criteria->compare('id_group_history',$this->id_group_history);
		$criteria->compare('tooth_number',$this->tooth_number);
		$criteria->compare('tooth_data',$this->tooth_data);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ToothData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getListToothData($id_customer,$id_mhg){

		if(!$id_customer || !$id_mhg){
			return -1; 
 		} 

		$result = array();
		$data = ToothData::model()->findAllByAttributes(array("id_customer"=>$id_customer,"id_group_history"=>$id_mhg));
		if($data && count($data) > 0){
			foreach ($data as $key => $value) {
				$result[$value['tooth_number']] = $value['tooth_data'];
			}
		}
		return $result;
	}

	public function getListFaceTooth($id_customer,$id_mhg){

		if(!$id_customer || !$id_mhg){
			return -1; 
 		} 

		return ToothData::model()->findAllByAttributes(array("id_customer"=>$id_customer,"id_group_history"=>$id_mhg));	
	}

	public function getListToothImage($id_customer,$id_mhg,$tooth_number,$type_image){
		
		if(!$id_customer || !$id_mhg || !$tooth_number || !$type_image){
			return -1; 
 		} 

		return ToothImage::model()->findAllByAttributes(array("id_customer"=>$id_customer,"id_group_history"=>$id_mhg,"tooth_number"=>$tooth_number,"type_image"=>$type_image));	
	}	

	public function getListTooth($id_customer,$id_mhg) 
	{
		if($id_customer || $id_mhg){
   
		   $listToothData = Yii::app()->db->createCommand()
		       ->select('tooth_data.*, tooth_note.note')   
		       ->from('tooth_data')
		       ->where('tooth_data.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
		       ->andwhere('tooth_data.id_group_history=:id_group_history', array(':id_group_history' => $id_mhg)) 
		       ->leftJoin('tooth_note', 'tooth_note.id_customer = tooth_data.id_customer and tooth_note.id_group_history = tooth_data.id_group_history and tooth_note.tooth_number = tooth_data.tooth_number')			       	     	     
		       ->queryAll();

		   if($listToothData){
		             $data = array();
		             foreach($listToothData as $key => $value){
		                $listToothImage = Yii::app()->db->createCommand()
		              ->select('tooth_image.id_image, tooth_image.src_image, tooth_image.type_image')
		              ->from('tooth_image')
		              ->where('tooth_image.id_customer=:id_customer', array(':id_customer' => $value['id_customer']))
		              ->andWhere('tooth_image.id_group_history=:id_group_history', array(':id_group_history' => $value['id_group_history'])) 
		              ->andWhere('tooth_image.tooth_number=:tooth_number', array(':tooth_number' => $value['tooth_number'])) 		       
		              ->queryAll();   
		         
		                 $data[$key] = array('tooth_number'=>$value['tooth_number'],'tooth_data'=>$value['tooth_data'],'note'=>$value['note'],'listToothImage'=>$listToothImage);
		              
		             }
		             return $data;
		         }
		}
		return; 

	}

	public function saveTooth($id_customer, $id_mhg, $tooth_data, $tooth_image, $tooth_conclude, $tooth_note) 
	{	

		if(!$id_customer || !$id_mhg){
			return -1; 
 		} 

		ToothData::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));	

		if($tooth_data){

			$data_number = array();

			for ($i=0;$i<count($tooth_data);$i++) 
			{	

				if (!in_array($tooth_data[$i]->tooth_number, $data_number, false)) {	

					$data_number[]=$tooth_data[$i]->tooth_number;

				    $td=new ToothData;				
					$td->id_customer=$id_customer;
					$td->id_group_history=$id_mhg;
					$td->tooth_number=$tooth_data[$i]->tooth_number;
					$td->tooth_data=$tooth_data[$i]->tooth_data;					
					$td->save();
					
				}			
						
			}			

		}	

		ToothImage::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));			

		if($tooth_image){

			for ($i=0;$i<count($tooth_image);$i++) 
			{		
				$ti=new ToothImage;				
				$ti->id_customer=$id_customer;
				$ti->id_group_history=$id_mhg;
				$ti->tooth_number=$tooth_image[$i]->tooth_number;
				$ti->id_image=$tooth_image[$i]->id_image;
				$ti->src_image=$tooth_image[$i]->src_image;
				$ti->type_image=$tooth_image[$i]->type_image;
				$ti->style_image=$tooth_image[$i]->style_image;
				$ti->save();		
			}	

		}	

		ToothConclude::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));		

		if($tooth_conclude){

			for ($i=0;$i<count($tooth_conclude);$i++) 
			{		
				$tc=new ToothConclude;				
				$tc->id_customer=$id_customer;
				$tc->id_group_history=$id_mhg;
				$tc->tooth_number=$tooth_conclude[$i]->tooth_number;		
				$tc->id_i=$tooth_conclude[$i]->id_i;
				$tc->conclude=$tooth_conclude[$i]->conclude;
				$tc->id_user=$tooth_conclude[$i]->id_user;
				$tc->save();		
			}

		}

		ToothNote::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));		

		if($tooth_note){

			$note_number = array();

			for ($i=0;$i<count($tooth_note);$i++) 
			{

				if (!in_array($tooth_note[$i]->tooth_number, $note_number, true)) {	

					$note_number[]=$tooth_note[$i]->tooth_number;

					$tn=new ToothNote;				
					$tn->id_customer=$id_customer;
					$tn->id_group_history=$id_mhg;
					$tn->tooth_number=$tooth_note[$i]->tooth_number;			
					$tn->note=trim($tooth_note[$i]->note);					
					$tn->save();		

				}

			}

		}		

		return 1;

	}

	public function saveToothService($id_customer, $id_mhg, $tooth_data, $tooth_image, $tooth_conclude, $tooth_note) 
	{	

		if(!$id_customer || !$id_mhg){
			return -1; 
 		} 

		ToothData::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));	

		if($tooth_data){

			$data_number = array();

			for ($i=0;$i<count($tooth_data);$i++) 
			{	

				if (!in_array($tooth_data[$i]['tooth_number'], $data_number, false)) {		

					$data_number[]=$tooth_data[$i]['tooth_number'];

					$td=new ToothData;				
					$td->id_customer=$id_customer;
					$td->id_group_history=$id_mhg;
					$td->tooth_number=$tooth_data[$i]['tooth_number'];
					$td->tooth_data=$tooth_data[$i]['tooth_data'];
					$td->save();	

				}	

			}	

		}	

		ToothImage::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));			

		if($tooth_image){

			for ($i=0;$i<count($tooth_image);$i++) 
			{		
				$ti=new ToothImage;				
				$ti->id_customer=$id_customer;
				$ti->id_group_history=$id_mhg;
				$ti->tooth_number=$tooth_image[$i]['tooth_number'];
				$ti->id_image=$tooth_image[$i]['id_image'];
				$ti->src_image=$tooth_image[$i]['src_image'];
				$ti->type_image=$tooth_image[$i]['type_image'];
				$ti->style_image=$tooth_image[$i]['style_image'];
				$ti->save();		
			}	

		}	

		ToothConclude::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));		

		if($tooth_conclude){

			for ($i=0;$i<count($tooth_conclude);$i++) 
			{		
				$tc=new ToothConclude;				
				$tc->id_customer=$id_customer;
				$tc->id_group_history=$id_mhg;
				$tc->tooth_number=$tooth_conclude[$i]['tooth_number'];		
				$tc->id_i=$tooth_conclude[$i]['id_i'];
				$tc->conclude=$tooth_conclude[$i]['conclude'];
				$tc->id_user=$tooth_conclude[$i]['id_user'];
				$tc->save();		
			}

		}

		ToothNote::model()->deleteAllByAttributes(array('id_customer'=>$id_customer, 'id_group_history'=>$id_mhg));		

		if($tooth_note){

			$note_number = array();

			for ($i=0;$i<count($tooth_note);$i++) 
			{		

				if (!in_array($tooth_note[$i]['tooth_number'], $note_number, true)) {	

					$note_number[]=$tooth_note[$i]['tooth_number'];

					$tn=new ToothNote;				
					$tn->id_customer=$id_customer;
					$tn->id_group_history=$id_mhg;
					$tn->tooth_number=$tooth_note[$i]['tooth_number'];			
					$tn->note=trim($tooth_note[$i]['note']);
					$tn->save();	

				}

			}

		}		

		return 1;

	}

	public function getListToothStatus($id_customer,$id_mhg) 
	{

		if($id_customer || $id_mhg){
   
		   $listToothData = Yii::app()->db->createCommand()
		       ->select('tooth_data.id_customer,tooth_data.id_group_history,tooth_data.tooth_number,tooth_note.note')   
		       ->from('tooth_data')
		       ->where('tooth_data.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
		       ->andwhere('tooth_data.id_group_history=:id_group_history', array(':id_group_history' => $id_mhg)) 	
		       ->leftJoin('tooth_note', 'tooth_note.id_customer = tooth_data.id_customer and tooth_note.id_group_history = tooth_data.id_group_history and tooth_note.tooth_number = tooth_data.tooth_number')			       	     	     	       	     	     		      	     
		       ->queryAll();

		   if($listToothData){
		             $data = array();
		             foreach($listToothData as $key => $value){
		                $listToothConclude = Yii::app()->db->createCommand()
		              ->select('tooth_conclude.tooth_number,tooth_conclude.id_i,tooth_conclude.conclude,tooth_conclude.id_user')
		              ->from('tooth_conclude')
		              ->where('tooth_conclude.id_customer=:id_customer', array(':id_customer' => $value['id_customer']))
		              ->andWhere('tooth_conclude.id_group_history=:id_group_history', array(':id_group_history' => $value['id_group_history'])) 
		              ->andWhere('tooth_conclude.tooth_number=:tooth_number', array(':tooth_number' => $value['tooth_number'])) 		       
		              ->queryAll();   
		         
		                $data[$key] = array('id_group_history'=>$value['id_group_history'],'tooth_number'=>$value['tooth_number'],'note'=>$value['note'],'listToothConclude'=>$listToothConclude);
		              
		             }
		             return $data;
		         }
		}
		return; 

	}

	public function getListOnlyToothNote($id_customer,$id_mhg) 
	{

		if($id_customer || $id_mhg){
   
		   $listToothNote = Yii::app()->db->createCommand()
		       ->select('tooth_note.tooth_number,tooth_note.note,tooth_data.tooth_data')   
		       ->from('tooth_note')
		       ->where('tooth_note.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
		       ->andwhere('tooth_note.id_group_history=:id_group_history', array(':id_group_history' => $id_mhg)) 	
		       ->leftJoin('tooth_data', 'tooth_data.id_customer = tooth_note.id_customer and tooth_data.id_group_history = tooth_note.id_group_history and tooth_data.tooth_number = tooth_note.tooth_number')			       	     	     	       	     	     		      	     
		       ->queryAll();


		       if($listToothNote){
		             $data = array();
		             foreach($listToothNote as $key => $value){

		             	if (!$value['tooth_data']) {
		             		 $data[$key] = array('tooth_number'=>$value['tooth_number'],'note'=>$value['note']);
		             			                 
		             	}		 
		              
		             }
		             return $data;
		         }	       

		}
		return; 

	}

	public function getListToothConcludeAndNote($id_customer,$id_mhg) 
	{

		if($id_customer || $id_mhg){
   
		   $listToothNote = Yii::app()->db->createCommand()
		       ->select('tooth_note.id_customer,tooth_note.id_group_history,tooth_note.tooth_number,tooth_note.note')   
		       ->from('tooth_note')
		       ->where('tooth_note.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
		       ->andwhere('tooth_note.id_group_history=:id_group_history', array(':id_group_history' => $id_mhg)) 
		     	       	     	     		      	     
		       ->queryAll();

		   if($listToothNote){
		             $data = array();
		             foreach($listToothNote as $key => $value){
		                $listToothConclude = Yii::app()->db->createCommand()
		              ->select('tooth_conclude.tooth_number,tooth_conclude.id_i,tooth_conclude.conclude,tooth_conclude.id_user')
		              ->from('tooth_conclude')
		              ->where('tooth_conclude.id_customer=:id_customer', array(':id_customer' => $value['id_customer']))
		              ->andWhere('tooth_conclude.id_group_history=:id_group_history', array(':id_group_history' => $value['id_group_history'])) 
		              ->andWhere('tooth_conclude.tooth_number=:tooth_number', array(':tooth_number' => $value['tooth_number'])) 		       
		              ->queryAll();   
		         
		                $data[$key] = array('id_group_history'=>$value['id_group_history'],'tooth_number'=>$value['tooth_number'],'note'=>$value['note'],'listToothConclude'=>$listToothConclude);
		              
		             }
		             return $data;
		         }
		}
		return; 

	}

	public function getDentalStatus($id_customer,$id_mhg,$tooth_number) 
	{

		if(!$id_customer || !$id_mhg || !$tooth_number){
			return -1; 
		}
   
		$listSrcImage = Yii::app()->db->createCommand()
		       ->select('tooth_image.src_image,tooth_image.type_image')   
		       ->from('tooth_image')		
		       ->where('tooth_image.id_customer=:id_customer', array(':id_customer' => $id_customer)) 
		       ->andwhere('tooth_image.id_group_history=:id_group_history', array(':id_group_history' => $id_mhg)) 
		       ->andwhere('tooth_image.tooth_number=:tooth_number', array(':tooth_number' => $tooth_number)) 			     	     
		       ->queryAll();		   		   
		
		if($listSrcImage){
    
            foreach($listSrcImage as $key => $value){

            	if ($value['type_image'] == 'matngoai') {   

	                $src_image = preg_replace('#\d.*$#', '', $value['src_image']);

	                switch ($src_image) {		
					    case 'maokimloai':
					        return 'Mão kim loại';
					    case 'maokimloaissc':
					        return 'Mão kim loại SSC';    			
					    case 'maosukimloai':
					        return 'Mão sứ kim loại';					 			   
					    case 'crown':
					        return 'Mão toàn sứ';
					    case 'maonhua':
					        return 'Mão nhựa';    					          
					    case 'veneercomposite':
					        return 'Veneer composite';					        
					    case 'veneersu':
					        return 'Veneer sứ';	
					    case 'pontickimloai':
					        return 'Pontic kim loại';	   
					    case 'ponticsukimloai':
					        return 'Pontic sứ kim loại';  
					    case 'pontic':
					        return 'Pontic toàn sứ';        
					    case 'residualcrownroot':
					        return 'Residual Crown';					         
					    case 'residualcrown':
					        return 'Residual Crown';					              				        
					    case 'missing':
					        return 'Missing';					        
					    case 'residualroot':					        
					    	return 'Residual Root';	
					    case 'implantmao':
					        return 'Implant + mão';		
					    case 'implanthealing':
					        return 'Implant + healing';		    				        
					    case 'implant':
					        return 'Implant';					        				    
					    default:
	        				return 'Disease';               
					} 

				}	
              
            }

            return 'Disease';  
            
        }        

        return;

	}

}
