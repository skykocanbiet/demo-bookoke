<?php

/**
 * This is the model class for table "mini_website_info".
 *
 * The followings are the available columns in table 'mini_website_info':
 * @property integer $id
 * @property integer $id_website
 * @property string $logo
 * @property integer $logo_status
 * @property string $cover_photo
 * @property integer $cover_photo_status
 */
class MiniWebsiteInfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mini_website_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_website, logo, logo_status, cover_photo, cover_photo_status', 'required'),
			array('id_website, logo_status, cover_photo_status', 'numerical', 'integerOnly'=>true),
			array('logo, cover_photo', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_website, logo, logo_status, cover_photo, cover_photo_status', 'safe', 'on'=>'search'),
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
			'id_website' => 'Id Website',
			'logo' => 'Logo',
			'cover_photo' => 'Cover Photo',
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
		$criteria->compare('id_website',$this->id_website);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('cover_photo',$this->cover_photo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MiniWebsiteInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getMiniWebsiteInfo($idWebsite){
		$rs = MiniWebsiteInfo::model()->findAllByAttributes(array('id_website' => $idWebsite));
		if ($rs != NULL) {
			return $rs[0];
		}else{
			return NULL;
		}
	}
}
