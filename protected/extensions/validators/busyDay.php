<?php

class busyDay extends CValidator{

    protected $error = 'You can\'t pick this day';


    protected function validateAttribute($object, $attribute)
    {
        $bDays = array();

        foreach(Orders::model()->getBusy($object->cam_id) as $b)
            $bDays[] = strtotime($b->date);

        if(in_array(strtotime($object->$attribute), $bDays))
        {
            $this->addError($object,$attribute, $this->error);
        }
    }

}
