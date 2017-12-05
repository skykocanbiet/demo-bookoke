<?php

/**
 * This is the model class for table "v_notification".
 *
 * The followings are the available columns in table 'v_notification':
 * @property integer $id
 * @property integer $id_author
 * @property string $name_author
 * @property integer $id_dentist
 * @property string $name_dentist
 * @property string $action
 * @property integer $flag
 * @property string $data
 * @property string $creatdate
 * @property integer $status
 */
class VNotification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'v_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, id_author, id_dentist, flag, status', 'numerical', 'integerOnly'=>true),
			array('name_author, name_dentist', 'length', 'max'=>128),
			array('action', 'length', 'max'=>255),
			array('data, creatdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_author, name_author, id_dentist, name_dentist, action, flag, data, creatdate, status', 'safe', 'on'=>'search'),
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
			'id_author' => 'Id Author',
			'name_author' => 'Name Author',
			'id_dentist' => 'Id Dentist',
			'name_dentist' => 'Name Dentist',
			'action' => 'Action',
			'flag' => 'Flag',
			'data' => 'Data',
			'creatdate' => 'Creatdate',
			'status' => 'Status',
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
		$criteria->compare('id_author',$this->id_author);
		$criteria->compare('name_author',$this->name_author,true);
		$criteria->compare('id_dentist',$this->id_dentist);
		$criteria->compare('name_dentist',$this->name_dentist,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('flag',$this->flag);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('creatdate',$this->creatdate,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return VNotification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// paging and search notification
	public function searchNotification($curpage,$limit)
    {
        $start_point=$limit*($curpage-1);
      
        $p = new VNotification;           
        $q = new CDbCriteria(array(
        'condition'=>'published="true"'
        ));
        $v = new CDbCriteria(); 
        $v->addCondition('t.status >= 0');

        $count=count($p->findAll($v));
      
        $v->order= 'id DESC';
        $v->limit = $limit;
        $v->offset = $start_point;
        $q->mergeWith($v);

        $data = $p->findAll($v);

        return array('count'=>$count,'data'=>$data);
    }
}
