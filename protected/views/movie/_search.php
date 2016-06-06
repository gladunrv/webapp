<?php
/* @var $this MovieController */
/* @var $model Movie */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="row">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'title'); ?>
        <?php echo $form->textArea($model,'title',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'original_title'); ?>
        <?php echo $form->textArea($model,'original_title',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'release_date'); ?>
        <?php echo $form->textArea($model,'release_date',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'runtime'); ?>
        <?php echo $form->textField($model,'runtime'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'overview'); ?>
        <?php echo $form->textArea($model,'overview',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'genres'); ?>
        <?php echo $form->textArea($model,'genres',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'poster_path'); ?>
        <?php echo $form->textArea($model,'poster_path',array('rows'=>6, 'cols'=>50)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->