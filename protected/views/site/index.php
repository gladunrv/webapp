<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<table>
	<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Release Date</th>
		<th>Link</th>
	</tr>
<? foreach ($data as $k => $v) { ?>
	<tr>
		<td><?=$v['id'];?></td>
		<td><?=$v['title'];?></td>
		<td><?=$v['release_date'];?></td>
		<td><a href="<?=$this->createUrl('movie/index',array('id'=>$v['id']));?>">read more</a></td>
	</tr>
<? } ?>

</table>


 <?
//Вывод постраничного навигатора
$this->widget('CLinkPager', array(
    'pages' => $pagination,
    'maxButtonCount' => 4
));
 

