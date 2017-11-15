<div class="form">

<? $form=$this->beginWidget('CActiveForm', [
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
]); ?>

	<div class="alert alert-info">Поля, помеченные <span class="required">*</span> обязательны к заполнению.</div>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-12">
				<?= $form->labelEx($model,'title'); ?>
				<?= $form->textField($model,'title',['class' => 'form-control','size'=>60,'maxlength'=>200]); ?>
				<?= $form->error($model,'title'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-12">
				<?= $form->labelEx($model,'alias'); ?>
				<?= $form->textField($model,'alias',['class' => 'form-control','size'=>60,'maxlength'=>200]); ?>
				<?= $form->error($model,'alias'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-12">
				<?= $form->labelEx($model,'dt'); ?>
				<?= $form->textField($model,'dt',['class' => 'form-control','size'=>60,'maxlength'=>200]); ?>
				<?= $form->error($model,'dt'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-12">
				<?= $form->labelEx($model,'publicated'); ?>
				<?= $form->textField($model,'publicated',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'publicated'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-12">
				<?= $form->labelEx($model,'content'); ?>
				<?= $form->textarea($model,'content',['class' => 'form-control wysiwyg']); ?>
				<?= $form->error($model,'content'); ?>
			</div>
		</div>
	</div>

	<div class="row buttons">
		<div class="form-group" style="width: 100%;">
			<div class="col-12">
				<?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']); ?>
			</div>
		</div>
	</div>

<? $this->endWidget(); ?>

</div>