<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>
<div id="content">
	<img style="float:right;" src="<?=Yii::app()->params['imageDir'] . $data->poster_path;?>">
	<h1><?=$data->title;?></h1>
	<p>
<?
$this->widget('ext.DzRaty.DzRaty', array(
    'name' => $data->id,
	'attribute' => 'id',
    'value' => 0,
    'options' => array(
    	'click' => "js:function(score, evt) { $.post('". Yii::app()->createUrl('movie/setRate') ."', {id:". $data->id .", score:score}); }", 
		'half' => TRUE
	),
    'data' => array('Awful', 'Bad', 'Poor', 'Regular', 'Decent', 'Interesting', 'Good', 'Very good', 'Great', 'Excellent')
));
?>
	</p>
	<p><b>Title:</b> <?=$data->title;?> </p>
	<p><b>Original Title:</b> <?=$data->original_title;?> </p>
	<p><b>Release Date:</b> <?=$data->release_date;?> </p>
	<p><b>Runtime:</b> <?=$data->runtime;?> </p>
	<p><b>Overview:</b> <?=$data->overview;?> </p>
	<p><b>Genres: <?=$data->genres;?></b>
	</p>
</div>


