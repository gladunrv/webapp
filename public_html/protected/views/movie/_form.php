<?php
/* @var $this MovieController */
/* @var $model Movie */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'movie-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textArea($model,'title',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'original_title'); ?>
        <?php echo $form->textArea($model,'original_title',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'original_title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'release_date'); ?>
        <?php echo $form->textArea($model,'release_date',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'release_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'runtime'); ?>
        <?php echo $form->textField($model,'runtime'); ?>
        <?php echo $form->error($model,'runtime'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'overview'); ?>
        <?php echo $form->textArea($model,'overview',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'overview'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'genres'); ?>
        <?php echo $form->textArea($model,'genres',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'genres'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'poster_path'); ?>
        <?php echo $form->textArea($model,'poster_path',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'poster_path'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->