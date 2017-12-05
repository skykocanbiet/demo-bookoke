<style type="text/css">
    
    .checkbox label{
     line-height: 21px !important;
}
</style>
<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
    'Login',
);
?>


<div>

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
    ); ?>

    <?php
        echo $form->textFieldGroup($model, 'username',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required','placeholder'=>'Tài khoản')),'labelOptions' => array("label" => false)));

        echo $form->passwordFieldGroup($model, 'password',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required','placeholder'=>'Mật khẩu')),'labelOptions' => array("label" => false)));

        echo $form->checkboxGroup($model, 'rememberMe',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'lg-rememberme'))));
    ?>

    <?php 

    $this->widget(
        'booster.widgets.TbButton',
        array('buttonType' => 'submit',
            'label' => 'ĐĂNG NHẬP',
            'htmlOptions' => array('class'=> 'btn btn-success btn-login-admin')
        )
    );

    $this->endWidget();
    unset($form);
    ?>
    <div id="login-form-info">
        <p><a href="http://bookoke.com/forget-pass" style="color: #74bb3d">Quên mật khẩu</a></p>
        <p style="color: #ccc">Bạn chưa có tài khoản? <a href="http://bookoke.com/register"  style="color: #056105; padding-left: 5px;">Đăng ký</a></p>
    </div>
</div>


