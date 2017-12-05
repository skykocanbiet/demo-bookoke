<?php
if (!isset($model))
{
    $model = '';
}
$this->widget('CTabView', array(
    'tabs' => array(
        'tab1' => array(
            'title' => 'THÔNG TIN CÁ NHÂN',
            'view' => 'tab_personal_information',
            'data' => $model,
            ),
        'tab2' => array(
            'title' => 'HỒ SƠ BỆNH ÁN',
            'view' => 'tab_medical_record',
            'data' => $model,
            ),
        'tab3' => array(
            'title' => 'LỊCH SỬ ĐIỀU TRỊ',
            'view'=>'tab_personal_information',
            'data'=>$model,
            ),
        'tab4' => array(
            'title' => 'THÔNG TIN BẢO HIỂM',
            'view' => 'tab_personal_information',
            'data' => $model,
            ),
        ),
    'activeTab' => 'tab1',
    'htmlOptions' => array('style' => 'margin-left:1px'),
    'id' => 'Tab-Id',
    ));
?>