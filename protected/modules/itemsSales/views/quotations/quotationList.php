<style>
    #oListT .autoNum{text-align: right; padding-right:  25px !important;}
</style>
<div class="col-md-12 tableList"> 
        <table class="table table-condensed table-hover" id="oListT" style="border-collapse:collapse;">
            <thead>
                <tr>
                    <th class="w1">Mã báo giá</th>
                    <th class="w2">Khách hàng</th>
                    <th class="w3">Văn phòng</th>
                    <th class="w4">Người tạo</th>
                    <th class="w5">Ngày tạo báo giá</th>
                    <th class="w6">Ngày hết hạn</th>
                    <th class="w7">Tổng tiền</th>
              </tr>
           </thead>
           <tbody>

    <?php if ($quotationList == -1): ?>
        <tr><td colspan="8" rowspan="" headers="">Không có dữ liệu!</td></tr>
    <?php else: ?>

    <?php foreach ($quotationList as $key => $v): 
    $id = $v['id']; ?>
    
        <tr data-toggle="collapse" data-target="#q<?php echo $key;?>" class="accordion-toggle <?php if($key%2!=0) echo "tr_col"; ?>">
            <td class="w1"><?php echo $v['code']; ?></td>
            <td class="w2"><?php echo $v['customer_name']; ?></td>
            <td class="w3"><?php echo $v['branch_name']; ?></td>
            <td class="w4"><?php echo $v['author_name']; ?></td>
            <td class="w5"><?php echo date_format(date_create($v['create_date']),'d/m/Y'); ?></td>
            <td class="w6"><?php echo date_format(date_create($v['complete_date']),'d/m/Y'); ?></td>
            <td class="w7 autoNum"><?php echo $v['sum_amount']; ?></td>
        </tr>
        <tr >
            <input type="hidden" name="id_quotation" value="<?php echo $id; ?>">
    		<td colspan="7" class="hiddenRow">
    			<div class="accordian-body collapse oView col-md-12" id="q<?php echo $key;?>">
    				<div class="oViewDetail col-md-12">
        <div id="oInfo" class="col-md-12">
        <div class="col-md-6 text-left">
            <div class="row">
            	<table>
            		<tbody>
            			<tr>
            				<th class="text-right">Văn phòng:</th>
            				<td class="text-left"><?php echo $v['branch_name']; ?></td>
            			</tr>
            			<tr>
            				<th class="text-right">Mã báo giá: </th>
            				<td class="text-left"><?php echo $v['code']; ?></td>
            			</tr>
            			<tr>
            				<th class="text-right">Khách hàng: </th>
            				<td class="text-left"><?php echo $v['customer_name']; ?></td>
            			</tr>
            		</tbody>
            	</table>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="row">
            	<table class="pull-right">
            		<tbody>
            			<tr>
            				<th class="text-right">Ngày tạo báo giá: </th>
            				<td class="text-left"><?php echo date_format(date_create($v['create_date']),'d/m/Y'); ?></td>
            			</tr>
            			<tr>
            				<th class="text-right">Ngày hết hạn: </th>
            				<td class="text-left"><?php echo date_format(date_create($v['complete_date']),'d/m/Y'); ?></td>
            			</tr>
            		</tbody>
            	</table>
            </div>
        </div>
        </div>
            <table class="table oViewB">
                <thead>
                    <tr>
                        <th style="border-left: 0;">Người thực hiện</th>
                        <th>Sản phẩm và Dịch vụ</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thuế</th>
                        <th style="border-right: 0">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
    	<?php $quoteDetail = array_filter($quotationDetail,function($v) use ($id){
    			if($v['id_quotation'] == $id)
    				return true;
    		});
    	?>
    	<?php 
            $order = 0;
            $update = 1;
            foreach ($quoteDetail as $key => $value): 
                $order = ($order == 1) ? $order : $value['status'];
                if ($update != 0 && $value['status'] == 1) {
                    $update = 0;
                }
                
        ?>
                    <tr class="deta">
                        <td><?php echo $value['user_name']; ?></td>
                        <td><?php echo $value['description']; ?> </td>
                        <td><?php echo $value['qty']; ?></td>
                        <td class="autoNum"><?php echo $value['unit_price']; ?></td>
                        <td class="autoNum"><?php echo $value['tax']; ?></td>
                        <td class="autoNum"><?php echo $value['amount']; ?></td>
                    </tr>
    		
    	<?php endforeach ?>
                    <tr>
                        <td colspan="3"></td>
                        <td colspan="3">
                            <table class="table sum">
                                <tbody>
                                    <tr>
                                        <td class="text-right"><b>Bao gồm thuế</b></td>
                                        <td class="text-right"><span class="autoNum"><?php echo $v['sum_tax']; ?></span> <?php echo $v['currency_use']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right"><b>Tổng cộng</b></td>
                                        <td class="text-right"><span class="autoNum"><?php echo $v['sum_amount']; ?></span> <?php echo $v['currency_use']; ?></td>
                                    </tr>                               
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div id="pBtn" class="text-left">
                                <input type="hidden" value="<?php echo $update; ?>" id="quoteUp">
                                <a type="" class="btn btn_bookoke qUpdate" title="">Cập nhật</a>
                                <button type="button" class="btn btn_bookoke" onclick="exportQuote(<?php echo $id; ?>);">In báo giá</button>
                                <button type="button" class="btn btn_bookoke">Gửi email</button>
                                <?php if ($roleDel): ?>
                                <span class="pull-right"><button type="button" class="btn btn_cancel" onclick="deleteQuotation(<?php echo $id; ?>,<?php echo $order; ?>);">Xóa</button></span>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
    </div>
    			</div>
    		</td>
        </tr>
    <?php endforeach ?>
    <?php endif ?>
           </tbody>
        </table>
    </div>

<div style="clear:both"></div>
<div id="" class="row fix_bottom">
    <?php if($page_list) echo $page_list;?> 
</div>

<script>
$(function(){
    win = $(window).height();
    head = $('#headerMenu').height();
    srch = $('#oSrchBar').height();    
    $('.tableList .table>tbody').css('max-height',win - head - srch - 120);
    
    var numberOptions = {aSep: '.', aDec: ',', mDec: 3, aPad: false};
    $('.autoNum').autoNumeric('init',numberOptions);

    $('.qUpdate').click(function(e) {
        $('#update_quote_modal').modal('show');
    });
})
</script>