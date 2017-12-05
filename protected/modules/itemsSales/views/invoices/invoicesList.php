<style>
.ivLang {
    -moz-border-radius   : 0 4px 4px 0;
    -webkit-border-radius: 0 4px 4px 0;
    border-radius        : 0 4px 4px 0;
}
</style>
<div class="col-md-12 tableList"> 
    <table class="table table-condensed table-hover" style="border-collapse:collapse;">
        <thead>
            <tr>
                <th>Mã hóa đơn</th>
                <th>Khách hàng</th>
                <th>Văn phòng</th>
                <th>Người tạo</th>
                <th>Ngày thanh toán</th>
                <th>Ngày hoàn tất</th>
                <th>Tổng tiền</th>
                <th>Công nợ</th>
          </tr>
       </thead>
       <tbody>
<?php if ($invoice_id): ?>

    <?php foreach ($invoice_id as $key => $v): 
$id = $v['id']; ?>
    <tr aria-expanded="true" data-toggle="collapse" data-target="#q<?php echo $v['id'];?>" class="accordion-toggle <?php if($key%2!=0) echo "tr_col"; ?>">
        <td class="text-left" style="padding: 8px 20px;"><?php echo $v['code']; ?>
            <?php if ($v['vat']): ?>
                <span class="label" style="background: #f1b51b;">VAT</span>
            <?php endif ?>
        </td>
        <td><?php echo $v['customer_name']; ?></td>
        <td><?php echo $v['branch_name']; ?></td>
        <td><?php echo $v['author_name']; ?></td>
        <td><?php echo date_format(date_create($v['create_date']),'d/m/Y'); ?></td>
        <td><?php echo date_format(date_create($v['complete_date']),'d/m/Y'); ?></td>
        <td class="autoNum"><?php echo $v['sum_amount']; ?></td>
        <td class="autoNum"><?php echo $v['balance']; ?></td>
    </tr>
    <tr >
        <input type="hidden" name="id_invoice" value="<?php echo $v['id']; ?>">
        <td colspan="7" class="hiddenRow">
            <div aria-expanded="true" class="accordian-body collapse in oView col-md-12" id="q<?php echo $v['id'];?>"    >
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
                        <th class="text-right">Mã hóa đơn: </th>
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
                        <th class="text-right">Ngày tạo hóa đơn: </th>
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
    <div class="col-md-12 text-right"><span>Đơn vị: <?php echo $v['currency_use']; ?></span></div>
        <table class="table oViewB">
            <thead>
                <tr>
                    <th style="border-left: 0;">Người thực hiện</th>
                    <th>Sản phẩm và Dịch vụ</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thuế</th>
                    <th style="border-right: 0;">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
    
    <?php $InvoiceDetails = array_filter($InvoiceDetail,function($v) use ($id){
            if($v['id_invoice'] == $id)
                return true;
        });
    ?>
    <?php foreach ($InvoiceDetails as $key => $value): ?>
                <tr class="deta">
                    <td><?php echo $value['user_name']; ?></td>
                    <td><?php echo $value['description']; ?></td>
                    <td><?php echo $value['qty']; ?></td>
                    <td class="autoNum"><?php echo $value['unit_price']; ?></td>
                    <td class="autoNum"><?php echo $value['tax']; ?></td>
                    <td class="autoNum"><?php echo $value['amount']; ?></td>
                </tr>
        
    <?php endforeach; ?>
        <?php $sum = 0;
            $paymentDetails = array_filter($paymentDetail,function($v) use ($id,&$sum){
                if($v['id_invoice'] == $id){
                    $sum += (int)$v['pay_amount'] + (int)$v['pay_insurance'] + (int)$v['pay_promotion'];
                    return true;
                }
            });
        ?>
            <tr>
                <td colspan="3">
                <?php if ($paymentDetails): ?>
                    <div class="col-md-12 text-left" style="margin-bottom: 10px;">
                        <h5>Lịch sử thanh toán</h5>
               
                        <?php foreach ($paymentDetails as $paykey => $pay): 
                        $pay_type = ($pay['pay_type']) ? $pay['pay_type'] : 0;?>
                            <div class="col-md-12">
                                <?php echo $pay['pay_date']; ?> | 
                                <span class="autoNum"><?php echo $pay['pay_amount']; ?></span> <?php echo $v['currency_use']; ?> + <?php echo number_format($pay['pay_promotion']); ?></span> <?php echo $v['currency_use']; ?> | <?php echo $invoice_type[$pay_type]; ?> | In phiếu thu <a href="" onclick="exportRpt(event,<?php echo $id; ?>,<?php echo $pay['id']; ?>,'vi')"> VN</a> | <a href="" onclick="exportRpt(event,<?php echo $id; ?>,<?php echo $pay['id']; ?>,'en')"> EN</a>
                            </div>
                        <?php endforeach ?> 
                        
                    </div>
                <?php endif ?>
                </td>
                <td colspan="3">
                    <table class="table sum">
                        <tbody>
                            <tr>
                                <td class="text-right"><b>Bao gồm thuế</b></td>
                                <td class="text-left"><b class="autoNum"><?php echo $v['sum_tax']; ?></b> <?php echo $v['currency_use']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-right"><b>Tổng cộng</b></td>
                                <td class="text-left"><b class="autoNum"><?php echo $v['sum_amount']; ?></b> <?php echo $v['currency_use']; ?></td>
                            </tr>
                             <tr class="line">
                                <td class="text-right"><b>Đã trả</b></td>
                                <td class="text-left"><b class="autoNum"><?php echo $v['sum_amount'] - $v['balance']; ?></b> <?php echo $v['currency_use']; ?></td>
                            </tr>
                             <tr>
                                <td class="text-right"><b>Còn lại</b></td>
                                <td class="text-left"><b class="autoNum"><?php echo $v['balance']; ?></b> <?php echo $v['currency_use']; ?></td>
                            </tr>                                     
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                 <td colspan="6">
                    <div id="pBtn" class="text-left">
                        <div class="form-inline">
                            <div class="btn-group">
                              <button type="button" class="btn btn_bookoke oBtnDetail">&nbsp;In hóa đơn</button> 
                              <button type="button" class="btn btn_bookoke oBtnDetail dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu menu-export">
                                <li><a href="#" class="ivLang langVi" data-val="vi">&nbsp;VI</a></li>
                                <li><a href="#" class="ivLang langEn" data-val="en">&nbsp;EN</a></li>
                              </ul>
                            </div>
                           
                            <button type="button" class="btn btn_bookoke">Gửi email</button>
                            <a class="btn <?php echo ($v['balance']>0) ? 'btn_bookoke iPay' : 'btn_unactive'; ?>">Thanh toán</a>
                        </div>
                        <span class="pull-right"><button type="button" class="btn btn_cancel">Xóa</button></span>
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

<?php if ($InvoiceList == -1): ?>
    <tr><td colspan="8" rowspan="" headers="">Không có dữ liệu!</td></tr>
<?php else: ?>

<?php foreach ($InvoiceList as $key => $v): 
$id = $v['id']; ?>
    <tr data-toggle="collapse" data-target="#q<?php echo $v['id'];?>" class="accordion-toggle <?php if($key%2!=0) echo "tr_col"; ?>">
        <td class="text-left" style="padding: 8px 20px;"><?php echo $v['code']; ?>
            <?php if ($v['vat']): ?>
                <span class="label" style="background: #f1b51b;">VAT</span>
            <?php endif ?>
        </td>
        <td><?php echo $v['customer_name']; ?></td>
        <td><?php echo $v['branch_name']; ?></td>
        <td><?php echo $v['author_name']; ?></td>
         <td><?php echo date_format(date_create($v['create_date']),'d/m/Y'); ?></td>
        <td><?php echo date_format(date_create($v['complete_date']),'d/m/Y'); ?></td>
        <td class="autoNum"><?php echo $v['sum_amount']; ?></td>
        <td class="autoNum"><?php echo $v['balance']; ?></td>
    </tr>
    <tr >
        <input type="hidden" name="id_invoice" value="<?php echo $v['id']; ?>">
		<td colspan="7" class="hiddenRow">
			<div class="accordian-body collapse oView col-md-12" id="q<?php echo $v['id'];?>"    >
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
        				<th class="text-right">Mã hóa đơn: </th>
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
                        <th class="text-right">Ngày tạo hóa đơn: </th>
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
    <div class="col-md-12 text-right"><span>Đơn vị: <?php echo $v['currency_use']; ?></span></div>
    <div class="col-md-12 oViewB">
        <table class="table">
            <thead>
                <tr>
                    <th style="border-left: 0;">Người thực hiện</th>
                    <th>Sản phẩm và Dịch vụ</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thuế</th>
                    <th style="border-right: 0;">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
        

    <?php $InvoiceDetails = array_filter($InvoiceDetail,function($v) use ($id){
            if($v['id_invoice'] == $id)
                return true;
        });

    ?>
	<?php foreach ($InvoiceDetails as $key => $value): ?>
                <tr class="deta">
                    <td><?php echo $value['user_name']; ?></td>
                    <td ><?php echo $value['description']; ?></td>
                    <td><?php echo $value['qty']; ?></td>
                    <td class="autoNum"><?php echo $value['unit_price']; ?></td>
                    <td class="autoNum"><?php echo $value['tax']; ?></td>
                    <td class="autoNum"><?php echo $value['amount']; ?></td>
                </tr>
		
	<?php endforeach; ?>
     <?php $sum = 0;
            $paymentDetails = array_filter($paymentDetail,function($v) use ($id,&$sum){
                if($v['id_invoice'] == $id){
                    $sum += (int)$v['pay_amount'] + (int)$v['pay_insurance'] + (int)$v['pay_promotion'];
                    return true;
                }
            });
        ?>  
    <tr>
        <td colspan="3">
            <?php if ($paymentDetails): ?>
                <div class="col-md-12 text-left" style="margin-bottom: 10px;">
                    <h5>Lịch sử thanh toán</h5>
           
                    <?php foreach ($paymentDetails as $paykey => $pay): 
                    $pay_type = ($pay['pay_type']) ? $pay['pay_type'] : 0;?>
                        <div class="col-md-12">
                            <?php echo $pay['pay_date']; ?> | 
                            <span class="autoNum"><?php echo $pay['pay_amount']; ?></span> <?php echo $v['currency_use']; ?> + <?php echo number_format($pay['pay_promotion']); ?></span> <?php echo $v['currency_use']; ?> | <?php echo $invoice_type[$pay_type]; ?> | In phiếu thu <a href="" onclick="exportRpt(event,<?php echo $id; ?>,<?php echo $pay['id']; ?>,'vi')"> VN</a> | <a href="" onclick="exportRpt(event,<?php echo $id; ?>,<?php echo $pay['id']; ?>,'en')"> EN</a>
                        </div>
                    <?php endforeach ?>
                    
                </div>
            <?php endif ?>
        </td>
        <td colspan="3">
            <table class="table sum">
                <tbody>
                    <tr>
                        <td class="text-right"><b>Bao gồm thuế</b></td>
                        <td class="text-left"><b class="autoNum"><?php echo $v['sum_tax']; ?></b> <?php echo $v['currency_use']; ?></td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>Tổng cộng</b></td>
                        <td class="text-left"><b class="autoNum"><?php echo $v['sum_amount']; ?></b> <?php echo $v['currency_use']; ?></td>
                    </tr>
                     <tr class="line">
                        <td class="text-right"><b>Đã trả</b></td>
                        <td class="text-left"><b class="autoNum"><?php echo $v['sum_amount'] - $v['balance']; ?></b> <?php echo $v['currency_use']; ?></td>
                    </tr>
                     <tr>
                        <td class="text-right"><b>Còn lại</b></td>
                        <td class="text-left"><b class="autoNum"><?php echo $v['balance']; ?></b> <?php echo $v['currency_use']; ?></td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="6">
            <div id="pBtn" class="text-left">
            <div class="form-inline">
               <div class="btn-group">
                  <button type="button" class="btn btn_bookoke oBtnDetail">&nbsp;In hóa đơn</button> 
                  <button type="button" class="btn btn_bookoke oBtnDetail dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu menu-export">
                    <li><a href="#" class="ivLang langVi" data-val="vi">&nbsp;VI</a></li>
                    <li><a href="#" class="ivLang langEn" data-val="en">&nbsp;EN</a></li>
                  </ul>
                </div>
                
                <button type="button" class="btn btn_bookoke">Gửi email</button>
                <a class="btn <?php echo ($v['balance']>0) ? 'btn_bookoke iPay' : 'btn_unactive'; ?>">Thanh toán</a>
            </div>
            <span class="pull-right"><button type="button" class="btn btn_cancel">Xóa</button></span>
        </div>
        </td>
    </tr>
            </tbody>
        </table>
        
    </div>
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
})
</script>