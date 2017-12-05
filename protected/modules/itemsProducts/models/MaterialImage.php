<?php

/**
 * This is the model class for table "material_image".
 *
 * The followings are the available columns in table 'material_image':
 * @property integer $id
 * @property integer $id_material
 * @property string $name
 * @property string $url_action
 * @property string $name_upload
 * @property string $update_time
 * @property integer $kind
 * @property integer $size
 * @property integer $status
 */
class MaterialImage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'material_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_material', 'required'),
			array('id_material, kind, size, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>765),
			array('url_action', 'length', 'max'=>150),
			array('name_upload', 'length', 'max'=>300),
			array('update_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_material, name, url_action, name_upload, update_time, kind, size, status', 'safe', 'on'=>'search'),
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
			'id_material' => 'Id Material',
			'name' => 'Name',
			'url_action' => 'Url Action',
			'name_upload' => 'Name Upload',
			'update_time' => 'Update Time',
			'kind' => 'Kind',
			'size' => 'Size',
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
		$criteria->compare('id_material',$this->id_material);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url_action',$this->url_action,true);
		$criteria->compare('name_upload',$this->name_upload,true);
		$criteria->compare('update_time',$this->update_time,true);
		$criteria->compare('kind',$this->kind);
		$criteria->compare('size',$this->size);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MaterialImage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function saveImageScaleAndCrop($fileImageUpload,$w='1000',$h='1000',$imageUploadSource,$imageNameUpload){

            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w, $h);
            $image->save($imageUploadSource."lg/".$imageNameUpload);

            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w/2, $h/2);
            $image->save($imageUploadSource."md/".$imageNameUpload);

            $image = new EasyImage($fileImageUpload);
            $image->scaleAndCrop($w/4, $h/4);
            $image->save($imageUploadSource."sm/".$imageNameUpload);

            return true;
    }
    public function deleteImageScaleAndCrop($fileImageDelete){

    	   unlink("upload/material_image/lg/".$fileImageDelete);
		   unlink("upload/material_image/md/".$fileImageDelete);
		   unlink("upload/material_image/sm/".$fileImageDelete);
    }

}
