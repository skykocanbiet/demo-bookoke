<?php

/**
 * This is the model class for table "p_news".
 *
 * The followings are the available columns in table 'p_news':
 * @property integer $id
 * @property integer $id_news_line
 * @property integer $id_news_type
 * @property integer $id_user
 * @property string $title
 * @property string $image
 * @property string $description
 * @property string $content
 * @property string $createdate
 * @property string $postdate
 * @property integer $total_view
 * @property integer $status_hiden
 * @property integer $status
 */
class News extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'p_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_news_line, id_news_type, id_user, createdate', 'required'),
			array('id_news_line, id_news_type, id_user, total_view, status_hiden, status', 'numerical', 'integerOnly'=>true),
			array('title, image, description', 'length', 'max'=>255),
			array('content, postdate', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_news_line, id_news_type, id_user, title, image, description, content, createdate, postdate, total_view, status_hiden, status', 'safe', 'on'=>'search'),
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
			'id_news_line' => 'Id News Line',
			'id_news_type' => 'Id News Type',
			'id_user' => 'Id User',
			'title' => 'Title',
			'image' => 'Image',
			'description' => 'Description',
			'content' => 'Content',
			'createdate' => 'Createdate',
			'postdate' => 'Postdate',
			'total_view' => 'Total View',
			'status_hiden' => 'Status Hiden',
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
		$criteria->compare('id_news_line',$this->id_news_line);
		$criteria->compare('id_news_type',$this->id_news_type);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('createdate',$this->createdate,true);
		$criteria->compare('postdate',$this->postdate,true);
		$criteria->compare('total_view',$this->total_view);
		$criteria->compare('status_hiden',$this->status_hiden);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return News the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
