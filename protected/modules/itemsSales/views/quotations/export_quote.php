
<style>
p, a, td {
	word-wrap: break-word;
    font-size: 14pt;
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

.qP1 {width: 20%;}
.qP2 {width: 27%;}
.qP3 {width: 11%;}
.qP4 {width: 15%;}
.qP5 {width: 8%;}
.qP6 {width: 15%;}

</style>

<page style="font: arial;font-family:freeserif ;">

<div style="padding-left: 10pt;padding-right: 10pt;">
    <!-- header -->
	<div style="width: 100%">
        <table style="width: 100%;margin-top: 15pt;">
            <tbody>
                <tr>
                    <td style="color: #222; padding-right: 120pt">
                   		<?php echo CHtml::image('images/logo_vi.png', 'images', array('width'=>100)); ?>
                    </td>

                    <td style="color: #222; padding-top: 25pt;">
						<strong style="font-size: 23pt;">BÁO GIÁ</strong>
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
	    				<td style="width: 120mm;">
					        <table class="tLeft" style="width: 100%;">
					            <tbody>
					                <tr>
					                    <td>Khách hàng:</td>
					                    <td><?php echo $quotation['customer_name']; ?></td>
					                </tr>
					                <tr>
					                    <td>Ngày tháng năm sinh:</td>
					                    <td>
					                    <?php if (strtotime($cus['birthdate'])): ?>
					                    	<?php echo $cus['birthdate']; ?>
					                    <?php endif ?>
					                    </td>
					                </tr>
					              </tbody>
					        </table>
	    				</td>
	    				<td style="width: 70mm;">
					        <table class="tLeft">
					            <tbody>
					                <tr>
					                    <td>Ngày:</td>
					                    <td><?php echo $quotation['create_date']; ?></td>
					                </tr>
					                <tr>
					                    <td>Mã báo giá:</td>
					                    <td><?php echo $quotation['code']; ?></td>
					                </tr>
					              </tbody>
					        </table>
	    				</td>
	    			</tr>
                    <tr>
                        <td colspan="2">Địa chỉ:
                            <span style="margin-left: 33mm;"><?php echo $cus['address']; ?></span>
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
                    <th class="qP1"><strong>Người thực hiện</strong></th>
                    <th class="qP2"><strong>Sản phẩm và Dịch vụ</strong></th>
                    <th class="qP3"><strong>Răng số</strong></th>
                    <th class="qP4"><strong>Đơn giá</strong></th>
                    <th class="qP5"><strong>Thuế</strong></th>
                    <th class="qP6"><strong>Tổng tiền</strong></th>
            	</tr>
            </thead>
            <tbody>
            <?php if ($quoteDetail): ?>
        		<?php foreach ($quoteDetail as $key => $value): ?>
        		<tr>
                    <td class="qP1"><?php echo $value['user_name']; ?></td>
                    <td class="qP2"><?php echo $value['description']; ?></td>
                    <td class="qP3"><?php echo str_replace(',',' ',$value['teeth']); ?></td>
                    <td class="num qP4"><?php echo number_format($value['unit_price'],0,'','.'); ?></td>
                    <td class="qP5"><?php echo number_format($value['tax'],0,'','.'); ?></td>
                    <td class="num qP6"><?php echo number_format($value['amount'],0,'','.'); ?></td>
            	</tr>
        		<?php endforeach ?>
            <?php endif ?>
            	<tr>
                    <td class="ivS" colspan="4">Bao gồm thuế</td> 
                    <td class="num" colspan="2"><?php echo number_format($quotation['sum_tax'],0,'','.'); ?></td>
            	</tr>
            	<tr>
                    <td class="ivS" colspan="4">Tổng cộng</td>
                    <td class="num" colspan="2">
                       <?php echo number_format($quotation['sum_amount'],0,'','.'); ?>
                    </td>
            	</tr>
            </tbody>
            <tfoot class="ivF">
            	<tr>
            		<td colspan="1" style="text-align: left; padding-top: 10pt;">Ghi chú:</td>
            		<?php if ($quotation['note'] == '') 
            				$pad = '30pt';
            			else
            				$pad = '20pt';
            		 ?>
            		<td colspan="5"  style="text-align: left; padding-top: 10pt;"><?php echo $quotation['note']; ?></td>
            	</tr>
                <tr>
                    <td colspan="6" style="text-align: left; padding-top: 10pt; padding-bottom: 50pt;">Khách hàng ký tên:</td>
                </tr>
            	<tr>
            		<td style="font-size: 12pt;" colspan="6">Cảm ơn Quý khách đã sử dụng dịch vụ!</td>
            	</tr>
            	<tr>
            		<td style="font-size: 12pt;" colspan="6"><?php echo $branch['address']; ?> <?php echo $branch['hotline1']; ?></td>
            	</tr>
            </tfoot>
        </table>
    </div>  
</div>
</page>
