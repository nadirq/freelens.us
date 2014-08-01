<?php

/**
 * This is the model class for table "camerists".
 *
 * The followings are the available columns in table 'camerists':
 * @property integer $user_id
 * @property string $rate
 *
 * The followings are the available model relations:
 * @property Albums[] $albums
 * @property Users $user
 * @property Orders[] $orders
 * @property Rating[] $ratings
 * @property Schedule[] $schedules
 */
class Camerists extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'camerists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('rate', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, rate', 'safe', 'on'=>'search'),
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
			'albums' => array(self::HAS_MANY, 'Albums', 'cam_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'orders' => array(self::HAS_MANY, 'Orders', 'cam_id'),
			'ratings' => array(self::HAS_MANY, 'Rating', 'cam_id'),
			'schedules' => array(self::HAS_MANY, 'Schedule', 'cam_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'rate' => 'Rate',
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

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('rate',$this->rate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



    // return all camwerists form user table
    public function getAll(){

        $criteria = new CDbCriteria;
        $criteria->with = 'camerists';
        $criteria->condition ='role = \'camerist\'';
        return Users::model()->findAll($criteria);
    }

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Camerists the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}