
<div id="" class="popover bottom DisPop addDisPop" style="display: none;">
    <div class="arrow"></div>
    <h3 class="popover-title popHead"><span>Khuyến mãi</span></h3>
    <div class="popover-content">
        <div class="row ProTemp">
            <div class="col-xs-12 proNo">
                <p class="proNoti">Hiện không có chương trình khuyến mãi!</p>
                <button id="cancelDis" type="button" class="cacelPop btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Đóng</button>
                <a href="<?php echo Yii::app()->getBaseUrl(); ?>/itemsSales/Dealselitedental/View" class="btn btn_bookoke">Tạo mới</a>
            </div>

            <div class="col-xs-12 proCt" style="display: none;">
                <select name="" class="form-control choseDisType chosType">                   
                </select>

                <div class="col-xs-12 helpPro" style=" padding-top:10px; display: none;">
                    <div class="helpPro"> <b>Chương trình khuyến mãi:</b> </div> <span class="proName"></span>
                    <div>Khuyến mãi: <span class="proVal autoNum"></span> <span class="proType"></span></div>
                </div>

                <div class="col-xs-12" style="padding-top: 10px;">
                    <button id="cancelDis" type="button" class="cacelPop btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Đóng</button>
                    <button type="button" id="" class="btn btn_bookoke alyDis helpPro" style="display: none;">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.cacelPop').click(function(event) {
        $('.addDisPop').hide();
    });

    $(document).click(function (e) {
        parentCls = e.target.parentNode.className;

        //console.log(parentCls);

        if(parentCls!= 'upAddDis' && parentCls != 'sCDiscount' && parentCls != 'addDis' && (parentCls.indexOf('DisPop') < 0 && parentCls.indexOf('proNo') < 0 && parentCls.indexOf('proCt') < 0 && parentCls.indexOf('ProTemp') < 0 && parentCls.indexOf('helpPro') < 0)){
            $('.DisPop').hide();
        }
       
    })
</script>