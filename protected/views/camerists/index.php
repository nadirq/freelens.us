<?php
/* @var $this CameristsController */

$this->breadcrumbs=array(
	'Camerists',
);
?>
<h1>Our photographers</h1>

<p>
    <?php //TODO: Add checkbox 'online' ?>
    <?php foreach($camerists->getAll() as $c){ ?>
        <div class = "row" >
            <?php echo $c->login; ?>
            <?php /* echo $c->rate; */ ?>
        </div>
        <br />
    <?php } ?>
</p>
