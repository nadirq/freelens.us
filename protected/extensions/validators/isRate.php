<?php


class isRate extends CValidator{

    protected $error = 'Вы уже ставили оценку этому фотографу';


    protected function validateAttribute($object, $attribute)
    {
        $criteria = new CDbCriteria;
        $criteria->select = 'rate';
        $criteria->condition = 'cam_id = :c_id AND user_id = :u_id';
        $criteria->params = array(':c_id' => $object->cam_id, ':u_id'=> $object->user_id);

        if(Rating::model()->find($criteria))
        {
            $this->addError($object,$attribute, $this->error);
        }


    }

}
