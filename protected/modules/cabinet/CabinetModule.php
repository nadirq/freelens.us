<?php

class CabinetModule extends CWebModule
{

	public function init()
	{



		$this->setImport(array(
			'cabinet.models.*',
			'cabinet.components.*',
		));
	}
}
