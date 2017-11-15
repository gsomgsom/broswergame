<div class="form">

<? $form=$this->beginWidget('CActiveForm', [
	'id'=>'item-form',
	'enableAjaxValidation'=>false,
]); ?>

	<div class="alert alert-info">Поля, помеченные <span class="required">*</span> обязательны к заполнению.</div>

	<?= $form->errorSummary($model); ?>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'name'); ?>
				<?= $form->textField($model,'name',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'name'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'php_class'); ?>
				<?= $form->textField($model,'php_class',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'php_class'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'img'); ?>
				<?= $form->textField($model,'img',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'img'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'description'); ?>
				<?= $form->textField($model,'description',['class' => 'form-control','size'=>60,'maxlength'=>1000]); ?>
				<?= $form->error($model,'description'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'notice'); ?>
				<?= $form->textField($model,'notice',['class' => 'form-control','size'=>60,'maxlength'=>500]); ?>
				<?= $form->error($model,'notice'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'use_text'); ?>
				<?= $form->textField($model,'use_text',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'use_text'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'use_link'); ?>
				<?= $form->textField($model,'use_link',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'use_link'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'bag'); ?>
				<?= $form->textField($model,'bag',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'bag'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'type'); ?>
				<?= $form->textField($model,'type',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'type'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'class'); ?>
				<?= $form->textField($model,'class',['class' => 'form-control','size'=>60,'maxlength'=>128]); ?>
				<?= $form->error($model,'class'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'required_lvl'); ?>
				<?= $form->textField($model,'required_lvl',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'required_lvl'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'stack'); ?>
				<?= $form->textField($model,'stack',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'stack'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'use_stack'); ?>
				<?= $form->textField($model,'use_stack',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'use_stack'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'bag_limit'); ?>
				<?= $form->textField($model,'bag_limit',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'bag_limit'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'variant'); ?>
				<?= $form->textField($model,'variant',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'variant'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'nosell'); ?>
				<?= $form->textField($model,'nosell',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'nosell'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'quality'); ?>
				<?= $form->textField($model,'quality',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'quality'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'price_sell_coins'); ?>
				<?= $form->textField($model,'price_sell_coins',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'price_sell_coins'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'price_sell_nuts'); ?>
				<?= $form->textField($model,'price_sell_nuts',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'price_sell_nuts'); ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= $form->labelEx($model,'price_sell_mushrooms'); ?>
				<?= $form->textField($model,'price_sell_mushrooms',['class' => 'form-control','size'=>11,'maxlength'=>11]); ?>
				<?= $form->error($model,'price_sell_mushrooms'); ?>
			</div>
		</div>
	</div>

	<div class="row buttons">
		<div class="form-group" style="width: 100%;">
			<div class="col-xs-12">
				<?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-success']); ?>
			</div>
		</div>
	</div>

<? $this->endWidget(); ?>

</div>