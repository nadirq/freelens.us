<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $login
 * @property string $pass
 * @property string $email
 * @property string $tel
 * @property string $fio
 * @property string $activation
 * @property string $about
 * @property string $reg_date
 * @property string $last_login
 * @property string $role
 *
 * The followings are the available model relations:
 * @property Camerists[] $camerists
 */
class Users extends CActiveRecord
{


    public $rememberMe;

    private $_identity;

    public $type; // Is user or camerist



    // Crypt password
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->pass = CPasswordHelper::hashPassword($this->pass);
                $this->role = $this->type;
            }
            return true;
        }
        else
            return false;
    }


    // If role == camerist then make entity in camerists table
    protected function afterSave()
    {
        if (parent::beforeSave())
        {
            // Is it good place for functionality like this?
            if($this->role == 'camerist')
            {
                // Create new camersits model and add user to it
                $camerist = new Camerists;
                $camerist->user_id = $this->id;
                $camerist->rate = 0;
                $camerist->save();
            }
            return true;
        }

        return false;
    }




    /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.

        // Uncomment when will do full version
		return array(
			//array('login, pass, cpass, email, fio, activation, reg_date, role', 'required'),
            array('login, pass', 'required'),
            array('login, role', 'length', 'max'=>30),
            array('login', 'match', 'pattern' => '/^[A-Za-z0-9_-А-Яа-я\s,]+$/u','message'  => 'Login contains bad symbols.'),
            array('pass', 'compare', 'compareAttribute'=>'cpass', 'on'=>'registration'),
			//array('email, fio', 'length', 'max'=>50),
			//array('tel', 'length', 'max'=>20),
			//array('activation', 'length', 'max'=>32),
			//array('about, last_login', 'safe'),
            //array('email', 'match', 'pattern' => '/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', 'message' => 'Wrong email address.'),
            //array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, login, pass, email, tel, fio, activation, about, reg_date, last_login, role', 'safe', 'on'=>'search'),
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
			'camerists' => array(self::HAS_MANY, 'Camerists', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'login' => 'Login',
			'pass' => 'Password',
            'cpass' => 'Confirm password',
			'email' => 'Email',
            // Not needed yet
            /*
			'tel' => 'Tel',
			'fio' => 'Fio',
			'activation' => 'Activation',
			'about' => 'About',
			'reg_date' => 'Reg Date',
			'last_login' => 'Last Login',
			'role' => 'Role',
            */
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
		$criteria->compare('login',$this->login,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('activation',$this->activation,true);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('reg_date',$this->reg_date,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


    public function safeAttributes()
    {
        return array('login', 'pass', 'cpass', /*'verifyCode'*/);
    }



    public function authenticate($attribute,$params)
    {
        if(!$this->hasErrors())
        {

            $this->_identity=new UserIdentity($this->login,$this->pass);
            if(!$this->_identity->authenticate())
                $this->addError('pass','Incorrect username or password.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentity($this->login, $this->pass);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
            return false;
    }
}