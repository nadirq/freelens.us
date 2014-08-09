<?php

/**
 * This is the model class for table "rating".
 *
 * The followings are the available columns in table 'rating':
 * @property integer $cam_id
 * @property integer $user_id
 * @property string $rate
 *
 * The followings are the available model relations:
 * @property Camerists $cam
 * @property Users $user
 */
class Rating extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    public function tableName()
    {
        return 'rating';
    }


    public function remove($rt)
    {
        var_dump($rt);
        exit;
        $this->deleteByPk($rt);

    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cam_id, user_id, rate', 'required'),
			array('cam_id, user_id', 'numerical', 'integerOnly'=>true),
			array('rate', 'length', 'max'=>2),
			array('cam_id, user_id, rate', 'safe', 'on'=>'search'),
            array('user_id', 'unique'), // Only one user can set rating
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
			'cam' => array(self::BELONGS_TO, 'Camerists', 'cam_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cam_id' => 'Cam',
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
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('cam_id',$this->cam_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('rate',$this->rate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Rating the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
