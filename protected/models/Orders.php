<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $cam_id
 * @property integer $user_id
 * @property integer $price
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Camerists $cam
 * @property Users $user
 */
class Orders extends CActiveRecord
{


    // For date convert
    protected function beforeSave() {
        if(parent::beforeSave()) {
            $this->date = date('Y-m-d H:i:s', strtotime($this->date));
            return true;
        } else {
            return false;
        }
    }




	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orders';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cam_id, user_id, price, date', 'required'),
			array('cam_id, user_id, price', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cam_id, user_id, price, date', 'safe', 'on'=>'search'),
            array('date', 'ext.validators.busyDay', 'on'=>'insert'),
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
			'price' => 'Price',
			'date' => 'Date',
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
		$criteria->compare('price',$this->price);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    // Get all active orders
    public function getBusy($cam)
    {
        $criteria = new CDbCriteria();

        $criteria->condition = 'cam_id = :id AND status = "In progress"';

        $criteria->params = array(':id'=>$cam);

        return Orders::model()->findAll($criteria);

    }


    public function findOrders($cam)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'cam_id = :id AND status != :status';
        $criteria->params = array(':id'=>$cam, ':status' => 'closed');

        return Orders::model()->findAll($criteria);
    }

    public function acceptOrder()
    {

    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Orders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function setAccept($accept = true)
    {
        $this->accpeted = $accept; // True or false, look in controller's methods
    }


}
