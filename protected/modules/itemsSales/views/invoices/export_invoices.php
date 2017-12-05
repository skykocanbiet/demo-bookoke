
<style>
p, a, td {
	word-wrap: break-word;
    font-size: 10.5pt;
}

table.tLeft td{padding-right: 15pt;}

.ivDt {
	width: 100%;
	border-collapse: collapse;
}
.ivDt thead tr{
	background: #8FAAB1;
}
.ivDt thead th, .ivDt tbody td{
	padding: 8px auto;
	text-align: center;
	color: #fff;
	border: 1px solid #ccc;
}
.ivDt tbody td{
	color: #000;	
}
.num {
	padding-right: 10pt;
	text-align: right;
}
.ivS {
	background: #f8f0e4;
}
.ivF td {
	text-align: center;
}

</style>

<page style="font: arial;font-family:freeserif ;">

<div style="padding-left: 10pt;padding-right: 10pt;">
    <!-- header -->
	<div style="width: 100%">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="color: #222; padding-right: 120pt">
                   		<?php echo CHtml::image('images/logo_vi.png', 'Logo', array('width'=>100)); ?>
                    </td>

                    <td style="color: #222; padding-top: 25pt;">
						<strong style="font-size: 23pt;">PHIẾU THU</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> <!-- end table-->
	
	<!-- info customer -->
    <div style=" margin-top: 15pt;">
    	<div style="width: 100%;">
	    	<table>
	    		<tbody>
	    			<tr>
	    				<td style="width: 140mm;">
					        <table class="tLeft" style="width: 100%;">
					            <tbody>
					                <tr>
					                    <td>Khách hàng:</td>
					                    <td><?php echo $invoice['customer_name']; ?></td>
					                </tr>
					                <tr>
					                    <td>Ngày tháng năm sinh:</td>
					                    <td>
					                    <?php if (strtotime($cus['birthdate'])): ?>
					                    	<?php echo $cus['birthdate']; ?>
					                    <?php endif ?>
					                    </td>
					                </tr>
					                <tr>
					                    <td>Địa chỉ:</td>
					                    <td><?php echo $cus['address']; ?></td>
					                </tr>
					                <tr>
					                    <td>Hình thức thanh toán:</td>
					                    <td>
                                            <?php if (count($rpt) == 1 && isset($rpt['id_invoice'])): ?>
                                                <?php echo $this->invoice_type[$rpt['pay_type']]; ?>        
                                            <?php endif ?>
                                        </td>
					                </tr>
					              </tbody>
					        </table>
	    				</td>
	    				<td style="width: 50mm;">
					        <table class="tLeft">
					            <tbody>
					                <tr>
					                    <td>Ngày:</td>
					                    <td>
                                            <?php if (count($rpt) == 1 && isset($rpt['id_invoice'])): ?>
                                                <?php echo $rpt['pay_date']; ?> 
                                            <?php else: ?>      
                                                <?php echo $invoice['create_date']; ?>
                                            <?php endif ?>    
                                        </td>
					                </tr>
					                <tr>
					                    <td>Số hồ sơ:</td>
					                    <td><?php echo $cus['code_number']; ?></td>
					                </tr>
					              </tbody>
					        </table>
	    				</td>
	    			</tr>
	    		</tbody>
	    	</table>
    		
    	</div>
    </div> 

    <div style="margin-top: 10pt;" >
        <table class="ivDt">
            <thead>
                <tr>
                    <th style="width: 5%;"><strong>#</strong></th>
                    <th style="width: 40%;"><strong>Dịch vụ</strong></th>
                    <th style="width: 15%;"><strong>Đơn giá</strong></th>
                    <th style="width: 10%;"><strong>Thuế</strong></th>
                    <th style="width: 10%;"><strong>Số lượng</strong></th>
                    <th style="width: 15%;"><strong>Tổng tiền</strong></th>
            	</tr>
            </thead>
            <tbody>
            <?php if ($ivDetail): ?>
        		<?php foreach ($ivDetail as $key => $value): ?>
        		<tr>
                    <td style="width: 5%;"><?php echo $key + 1; ?></td>
                    <td style="width: 40%;"><?php echo $value['description']; ?></td>
                    <td class="num" style="width: 15%;"><?php echo number_format($value['unit_price'],0,'','.'); ?></td>
                    <td class="num" style="width: 10%;"><?php echo number_format($value['tax'],0,'','.'); ?></td>
                    <td style="width: 10%;"><?php echo $value['qty']; ?></td>
                    <td class="num" style="width: 15%;;"><?php echo number_format($value['amount'],0,'','.'); ?></td>
            	</tr>
        		<?php endforeach ?>
            <?php endif ?>
                <?php $pay_sum = 0; $pay_promotion = 0; ?>
                <?php if (count($rpt) != 0 && !isset($rpt['id_invoice']) ): ?>
                    <?php foreach ($rpt as $key => $value) {
                        $pay_sum += $value['pay_sum'];
                        $pay_promotion += $value['pay_promotion'];
                    } ?>
                <?php endif ?>
            	<tr>
                    <td class="ivS" colspan="4">TỔNG CHI PHÍ ĐIỀU TRỊ</td>
                    <td></td>
                    <td class="num"><?php echo number_format($invoice['sum_amount'],0,'','.'); ?></td>
            	</tr>
            	<tr>
                    <td class="ivS" colspan="4">ƯU ĐÃI %</td>
                    <td></td>
                    <td class="num">
                        <?php if (count($rpt) == 1 && isset($rpt['id_invoice'])): ?>
                            <?php echo number_format($rpt['pay_promotion'],0,'','.'); ?>
                        <?php else: ?>
                            <?php echo number_format($pay_promotion,0,'','.'); ?>
                        <?php endif ?>
                    </td>
            	</tr>
            	<tr>
                    <td class="ivS" colspan="4">ĐÃ THANH TOÁN</td>
                    <td></td>
                    <td class="num">
                        <?php if (count($rpt) == 1 && isset($rpt['id_invoice'])): ?>
                            <?php echo number_format($rpt['pay_sum'],0,'','.'); ?>
                        <?php else: ?>
                            <?php echo number_format($pay_sum,0,'','.'); ?>
                        <?php endif ?>
                     </td>
            	</tr>
            	<tr>
                    <td class="ivS" colspan="4">CÒN LẠI</td>
                    <td></td>
                    <td class="num">
                        <?php if (count($rpt) == 1 && isset($rpt['id_invoice'])): ?>
                            <?php echo number_format($invoice['sum_amount'] - ($rpt['pay_sum'] + $rpt['pay_promotion']),0,'','.'); ?>

                        <?php else: ?>
                            <?php echo number_format($invoice['balance'],0,'','.'); ?>
                        <?php endif ?>
                    </td>
            	</tr>
            </tbody>
            <tfoot class="ivF">
            
                <?php if (count($rpt) != 0 && !isset($rpt['id_invoice']) ): ?>
                    <tr>
                        <td style="text-align: left;" colspan="5" style="padding-top: 20pt;">Lịch sử thanh toán</td>    
                    </tr>
                    <?php foreach ($rpt as $k => $pay): ?>
                        <tr>
                            <td style="text-align: left;" colspan="5">
                            <?php echo $pay['pay_date']; ?> | <?php echo number_format($pay['pay_sum'],0,'','.'); ?> VNĐ + <?php echo number_format($pay['pay_promotion'],0,'','.'); ?> VNĐ | <?php echo $this->invoice_type[$pay['pay_type']]; ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            	<tr>
            		<td colspan="5" style="padding-top: 20pt;">Cảm ơn Quý khách đã sử dụng dịch vụ!</td>
            	</tr>
            	<tr>
            		<td colspan="5"><?php echo $branch['address']; ?> <?php echo $branch['hotline1']; ?></td>
            	</tr>
            </tfoot>
        </table>
    </div>  
</div>
</page>
