<div class="modal-dialog" style="margin-top: 10%">
    <div class="loginmodal-container">
        <h1>Nha Khoa 2000</h1><br>

            <?php 
			$form = $this->beginWidget(
                    'booster.widgets.TbActiveForm',
                    array(
                        'id' => 'frm-login-customer',
                        'enableAjaxValidation'=>false,
                        'clientOptions' => array(
                            'validateOnSubmit'=>true,
                            'validateOnChange'=>true,
                            'validateOnType'=>true,
                        ),
                    )
                );
                 
                echo $form->textFieldGroup($model, 'username',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required','placeholder'=>'Phone')),'labelOptions' => array("label" => false)));
                echo $form->passwordFieldGroup($model, 'password',array('widgetOptions'=>array('htmlOptions'=>array('required'=>'required')),'labelOptions' => array("label" => false)));
                echo $form->checkboxGroup($model, 'rememberMe');
				
                $this->widget(
                    'booster.widgets.TbButton',
                    array(
					'buttonType' => 'submit', 
                    'label' => 'Đăng nhập',
                    'htmlOptions' => array('class'=> 'login loginmodal-submit btn-success')
                    )
                );
                 
                $this->endWidget();
                unset($form);
				
			?>

            <div class="login-help">
                <a href="#">Đăng ký</a> - <a href="#">Quên mật khẩu</a>
            </div>
    </div>
</div>

<script>

$('#frm-login-customer').submit(function(e) {
    //Prevent the default action, which in this case is the form submission.
    e.preventDefault();

    //Serialize the form data and store to a variable.
    var formData = new FormData($("#frm-login-customer")[0]);

    var urlProfile = "<?php echo Yii::app()->getBaseUrl(); ?>";

    var urlC = location.pathname;


    if (!formData.checkValidity || formData.checkValidity()) {
        jQuery.ajax({ type:"POST",
            url:"<?php echo CController::createUrl('home/login')?>",
            data:formData,
            datatype:'json',

            success:function(data){
              
                if(data == 'success'){
                    if(urlC.search("book") == -1)
                        location.href = '<?php echo Yii::app()->getBaseUrl(); ?>/profile';
                    else
                        location.href= '<?php echo Yii::app()->getBaseUrl(); ?>/book/register_info';
                    return false;
                }
				$("#login-customer-modal").html(data);
				
				
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    }
    return false;

});
    
</script>