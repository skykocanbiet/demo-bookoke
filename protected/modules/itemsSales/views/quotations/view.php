<?php $baseUrl = Yii::app()->baseUrl;?>
<div id="oSrchBar" class="col-md-12">
    <form class="form-inline">
        <div id="oSrchRight" class="pull-left" style="width: 69%">
            <div class="form-group">
                <label >Thời gian</label>
                <select name="" class="form-control" id="quote_time">
                    <option value="1">Tất cả</option>
                    <option value="2">Hôm nay</option>
                    <option value="3">7 ngày trước</option>
                    <option value="4">Tháng trước</option>
                </select>
            </div>
            <div class="form-group">
                <label>Văn phòng</label>
                <?php echo CHtml::dropDownList('branch','',$branch,array('class'=>'form-control' ,'id'=>'quote_branch'));  ?>
            </div>
            <div class="form-group">
                <label>Khách hàng</label>
                <select name="" class="form-control" id="quote_customer"></select>
            </div>
        </div>
        <div id="oSrchLeft" class="pull-right">
            <div class="input-group" style="padding-right: 15px;">
              <input type="text" class="form-control" id="quote_code" placeholder="Tìm kiếm theo mã báo giá">
              <div class="input-group-addon" id="quote_srch"><span class="glyphicon glyphicon-search"></span></div>
           </div>

             <a type="" class="btn_plus" id="oAdds" data-toggle="modal" data-target="#quote_modal" title=""></a>
        </div>
    </form>
</div>
<div id="QuotationList">

</div>
<div class="updateEventAllLayout"></div>

<!-- modal báo giá-->
<div id="quote_modal" class="modal fade">

</div>

<!-- model update quotation -->
<div id="update_quote_modal" class="modal fade">

</div>

<?php include 'q_js.php'; ?>