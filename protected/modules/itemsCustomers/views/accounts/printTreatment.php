<style>
p, a, td {
    word-wrap: break-word;
    font-size: 11pt;
    word-break: break-all;
}

.title {
    font-size: 16pt;
    font-weight: bold;
}
.title-sub {
    font-size: 13pt;
    font-weight: bold;
}

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
    vertical-align: middle;
}
.num {
    padding-right: 1pt;
    text-align: right;
}
.ivS {
    background: #f8f0e4;
}

.tm1 {width: 8mm;}
.tm2 {width: 19mm;}
.tm3 {width: 43mm;}
.tm4 {width: 14mm;}
.tm5 {width: 40mm;}
.tm6 {width: 25mm;}
.tm7 {width: 13mm;}
.tm8 {width: 25mm;}

</style>

<page backtop="7mm" backbottom="7mm" backleft="8mm" backright="8mm" style="font: arial;font-family:freeserif ;">

<div>
    <!-- header -->
    <div style="width: 100%">
        <table style="width: 100%;margin-top: 15pt;">
            <tbody>
                <tr>
                    <td style="color: #222; padding-right: 50pt">
                        <?php echo CHtml::image('images/logo_vi.png', 'EliteDental', array('width'=>200)); ?>
                    </td>

                    <td style="color: #222;">
                        <div><?php echo $branch['name']; ?></div>
                        <div>Add: <?php echo $branch['address']; ?></div>
                        <div>Tel: <?php echo $branch['hotline1']; ?></div>
                        <div>Website: www.elitedental.com.vn</div>
                        <div> Email: <?php echo $branch['email']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div> <!-- end table-->

    <div style="margin-top: 1mm;">
        <table>
            <tbody>
                <tr>
                    <td style="width: 30mm; padding-left: 60mm;">
                        <div class="title" style="padding-left: 50pt;">ĐIỀU TRỊ</div>
                        <div class="title">(TREATMENT SERVICES)</div>
                    </td>
                    <td style="width: 20mm; padding-top: 7mm;">ID: <?php echo $id_group_history; ?></td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                 <tr>
                    <td style="padding-left: 15mm; padding-top: 3mm;">Ngày Khám / Examination:</td>
                    <td style="width: 10mm; padding-top: 3mm; padding-left: 20mm;"><?php echo date_format(date_create($quote['create_date']),'d/m/Y'); ?></td>
                </tr>
                <tr>
                    <td style="padding-left: 15mm;">Bác Sĩ Khám / Doctor:</td>
                    <td style="width: 50mm; padding-left: 20mm;"><?php echo $quote['author_name']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 5mm;" class="tableInfo">
        <table>
            <tbody>
                <tr>
                    <td colspan="2" class="title-sub">A. THÔNG TIN/ INFORMATION</td>
                    <td style="width: 60mm;" class="if3">Mã/ Patient Code: <?php echo $cus['code_number']; ?> </td>
                </tr>
                <tr>
                    <td style="width: 90mm;">Họ Tên/ Name: <?php echo $cus['fullname']; ?></td>
                    <td style="width: 40mm;">G.Tính/ Sex: <?php echo ($cus['gender'] == 1) ? "Nữ" : "Nam"; ?></td>
                    <td class="if3">N.S/ YOB: <?php echo date_format(date_create($cus['birthdate']),'d/m/Y'); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Đ.Chỉ/ Add: <?php echo $cus['address']; ?></td>
                </tr>
                <tr>
                    <td>Email: <?php echo $cus['email']; ?></td>
                    <td colspan="2">Đ.Thoại/ Tel: <?php echo $cus['phone']; ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 5mm;">
        <div class="title-sub">B. DỊCH VỤ ĐIỀU TRỊ/ TREATMENT SERVICES</div>
        <table class="ivDt" style="margin-top: 3mm;">
            <thead>
                <tr>
                    <th class="tm1"><strong>TT<br>No</strong></th>
                    <th class="tm2"><strong>Ngày điều trị<br>Date</strong></th>
                    <th class="tm3"><strong>Chẩn đoán<br>Diagnosis</strong></th>
                    <th class="tm4"><strong>Răng số<br>Teeth</strong></th>
                    <th class="tm5"><strong>Dịch vụ<br>Treatment Services</strong></th>
                    <th class="tm6"><strong>Giá<br>Price</strong></th>
                    <th class="tm7"><strong>Số đơn vị<br>Quantity</strong></th>
                    <th class="tm8"><strong>Chi phí<br>Cost</strong></th>
                </tr>
            </thead>
            <tbody>
                <?php $sum = 0;
                    foreach ($treatment as $k => $v): 
                        $sum += $v['amount'];
                ?>
                    <tr>
                        <td class="tm1"><?php echo $k+1; ?></td>
                        <td class="tm2"><?php echo date_format(date_create($v['create_date']),'d/m/Y'); ?></td>
                        <td class="tm3"><?php echo $v['diagnose']; ?></td>
                        <td class="tm4"><?php echo str_replace(',',' ',$v['teeth']); ?></td>
                        <td class="tm5"><?php echo $v['description']; ?></td>
                        <td class="tm6 num"><?php echo number_format($v['unit_price'],0,'','.'); ?></td>
                        <td class="tm7"><?php echo $v['qty']; ?></td>
                        <td class="tm8 num"><?php echo number_format($v['amount'],0,'','.'); ?></td>
                    </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="7" style="text-align: right">Tổng cộng:</td>
                    <td class="num"><?php echo number_format($sum,0,'','.'); ?></td>
                </tr>
            </tbody>
            </table>
            <table style="margin-top: 3mm;">
                <tr>
                    <td style="width: 150mm;"><strong>Bệnh nhân/ Patient</strong><br>(Ký tên/Signature)</td>    
                    <td style="width: 100mm;"><strong>Bác sĩ / Doctor</strong><br>(Ký tên/Signature)</td>      
                </tr>
        </table>
    </div>
</div>
</page>
