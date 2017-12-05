
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row">
    <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Please Sign In</h3>
            </div>
            <div class="panel-body">
                <?php 
                /** @var TbActiveForm $form */
                    $form = $this->beginWidget(
                        'booster.widgets.TbActiveForm',
                        array(
                            'id' => 'login-form',
                            'enableAjaxValidation'=>false,
                            'clientOptions' => array(
                                'validateOnSubmit'=>true,
                                'validateOnChange'=>true,
                                'validateOnType'=>true,
                            ),
                        )
                    );
                     
                    echo $form->textFieldGroup($model, 'username');
                    echo $form->passwordFieldGroup($model, 'password');
                    echo $form->checkboxGroup($model, 'rememberMe');
                    $this->widget(
                        'booster.widgets.TbButton',
                        array('buttonType' => 'submit', 
                        'label' => 'Login',
                        'htmlOptions' => array('class'=> 'btn btn-lg btn-success btn-block')
                        )
                    );
                     
                    $this->endWidget();
                    unset($form);
                ?>
            </div>
        </div>
    </div>
</div>