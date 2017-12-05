<div id="content" style="padding-right: 0;">
    <ul id="menuk" class="menuk">
    <?php
        include_once(Yii::app()->theme->basePath.'/views/layouts/tab.php');
        MyTab::getTab('dashboard', 'Dashboard', 'lead/dashboard');
        MyTab::getTab('key_performance_indicators', 'KPI', 'CsTarget/KeyPerformanceIndicators','active');
        MyTab::getTab('task', 'Task', 'lead/task');
        MyTab::getTab('calendar', 'Calendar', 'lead/calendar');
        MyTab::getTab('voc', 'VOC', 'lead/voc');
        $group_no = Yii::app()->user->getState('group_no');
        if($group_no=="admin" ||$group_no=="superadmin" ||$group_no=="manager")
        {
            MyTab::getTab('report_sys', 'Report', 'lead/report_sys');
            MyTab::getTab('balance', 'Balance', 'lead/balance');
        }
        
        ?>
    </ul>
    <div id="box_task_total">
        <script>
        view_task_new_total();
        </script>
    </div>
    <style>
        .title_kpi{
            background-color: #8B71A7;
            text-align: center;
        }
        .title_kpi h3{
            color: #fff !important;
            padding: 14px 16px;
            font-size: 15px;
        }
        .label-kpi{
            border: none;
            background-color: #F2F2F2;
            line-height: 30px;
            color: #000;
            font-size: 13px;
            text-align: center;
        }
        #kpi_info_row{
            line-height: 35px;
            color: #333;  
        }
        #kpi_info_row .measures{
             text-indent: 15px;
             font-size: 13px;
             
        }
        #kpi_info_row .current{
             text-align: center;
             font-size: 13px;
        }
        #kpi_info_row .target{
             text-align: center;
             font-size: 13px;
        }
        #kpi_info_row .variance{
             text-align: center;
             font-size: 14px;
        }
        #kpi_info_row .trend{
             text-align: center;
             font-size: 13px;
        }
        .row_info_key_acctivities{
            position: relative;
            background-color: #F2F2F2;
            width: 94%;
            float: right;
            margin: 23px 0px 0px 0px;
            font-size: 14px;
            color: #333;
            height: 42px;
        }
        .round-key-acctivities{
            position: absolute;
            top: -10px;
            left: -17px;
            width: 60px;
            color: #000;
            border-radius: 50% 50%;
            height: 60px;
            background: #fff;
        }
        .round-key-acctivities .round-center-key-acctivities{
            position: absolute;
            top: 7px;
            left: 7px;
            width: 45px;
            color: #000;
            border-radius: 50% 50%;
            height: 45px;
            color: #fff;
            line-height: 44px;
            text-align: center;
            font-size: 15px;
        }
    </style>
    <div id="description" class="contentk">
    	<div class="bg_popup"  style="padding: 5px;" > 
            <div style="position:absolute;top:138px;right:50px" id="idloading_main"></div> 
            <div id="keyperformanceindicators" style="margin-top: 20px;">
                <div class="group-kpi">
                    <div class="title_kpi">
                        <h3>Key Performance Indicators (KPIs)</h3>
                    </div>
                    <div class="content_kpi">
                        <table>
                            <tr>
                                <th class="label-kpi" style="width: 25%;text-indent: 35px;text-align: left;">Measures</th>
                                <th class="label-kpi" style="width: 15%;">Current</th> 
                                <th class="label-kpi" style="width: 15%;">Target</th>
                                <th class="label-kpi" style="width: 15%;">Variance</th>
                                <th class="label-kpi" style="width: 30%;">Trend</th>
                            </tr>
                            <tr id="kpi_info_row">
                                <td class="measures" style="padding-top: 15px;">Gia tăng doanh thu bán hàng.</td>
                                <td class="current" style="padding-top: 15px;">$1.650</td>
                                <td class="target" style="padding-top: 15px;">$3.195</td>
                                <td class="variance" style="padding-top: 15px;">
                                    <span style="padding: 8px 18px;background-color: #63bb4a;color: #fff;">52%</span>
                                </td>
                                <td class="trend" style="padding-top: 15px;">
                                    uppdatting!
                                </td>
                            </tr>
                            <tr id="kpi_info_row">
                                <td class="measures">Phát triển khách hàng mới.</td>
                                <td class="current">07</td>
                                <td class="target">35</td>
                                <td class="variance">
                                    <span style="padding: 8px 18px;background-color: #ee432e;color: #fff;">20%</span>
                                </td>
                                <td class="trend">
                                    uppdatting!
                                </td>
                            </tr>
                            <tr id="kpi_info_row">
                                <td class="measures" style="padding-bottom: 15px;">Số lần liên lạc với Khách hàng.</td>
                                <td class="current" style="padding-bottom: 15px;">1100</td>
                                <td class="target" style="padding-bottom: 15px;">2400</td>
                                <td class="variance" style="padding-bottom: 15px;">
                                    <span style="padding: 8px 18px;background-color: #FFDA3B;color: #fff;">46%</span>
                                </td>
                                <td class="trend" style="padding-bottom: 15px;">
                                    uppdatting!
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="group-kpi">
                    <div class="title_kpi">
                        <h3>Key Activities</h3>
                    </div>
                    <div class="content_kpi" style="padding-right: 30px;">
                        <div class="row_info_key_acctivities">
                            <div class="number_key_acctivities"></div>
                            <span style="padding: 1px 65px 1px 70px;display: inline-block;">Liên lạc chăm sóc Khách hàng hiệu hữu, mời chào các sản phẩm đang sử dụng và các sản phẩm mới đang có chương trình khuyến mãi đặt biệt.</span>
                            <span style="position: absolute;top: -3px; right: 10px;font-size: 27px;color: #8DC641;">
                                <i class="fa fa-sort-desc"></i>
                            </span>
                            <div class="round-key-acctivities">
                                <div class="round-center-key-acctivities" style="background: #ee432e;">50%</div>
                            </div>
                        </div>
                        
                        <div class="row_info_key_acctivities" style="line-height: 33px;">
                            <div class="number_key_acctivities"></div>
                            <span style="padding: 4px 65px 4px 70px;display: inline-block;">Liên lạc với Khách hàng tiềm năng theo danh sách đã chuẩn bị, ghi chú các phản hồi, các cơ hội bán hàng mới.</span>
                            <span style="position: absolute;top: -3px; right: 10px;font-size: 27px;color: #8DC641;">
                                <i class="fa fa-sort-desc"></i>
                            </span>
                            <div class="round-key-acctivities">
                                <div class="round-center-key-acctivities" style="background: #FFDA3B;">30%</div>
                            </div>
                        </div>
                        
                        <div class="row_info_key_acctivities" style="line-height: 33px;">
                            <div class="number_key_acctivities"></div>
                            <span style="padding: 4px 65px 4px 70px;display: inline-block;">Tìm kiếm, đánh giá thông tin các khách hàng tiềm năng, các cơ hội bán hàng mới.</span>
                            <span style="position: absolute;top: -3px; right: 10px;font-size: 27px;color: #8DC641;">
                                <i class="fa fa-sort-desc"></i>
                            </span>
                            <div class="round-key-acctivities">
                                <div class="round-center-key-acctivities" style="background: #FDD2B2;">10%</div>
                            </div>
                        </div>
                        
                        <div class="row_info_key_acctivities" style="margin-bottom: 20px;line-height: 33px;">
                            <div class="number_key_acctivities"></div>
                            <span style="padding: 4px 65px 4px 70px;display: inline-block;">Thực hiện các báo cáo định kỳ.</span>
                            <span style="position: absolute;top: -3px; right: 10px;font-size: 27px;color: #8DC641;">
                                <i class="fa fa-sort-desc"></i>
                            </span>
                            <div class="round-key-acctivities">
                                <div class="round-center-key-acctivities" style="background:rgba(250 , 213, 187,.6)">10%</div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="group-kpi">
                    <div class="title_kpi">
                        <h3>Notes</h3>
                    </div>
                    <div class="content_kpi" style="height: 150px;">
                        <div style="padding: 30px 52px;font-size: 14px;">
                            <p style="color: #333;">
                                Nhân viên bán hàng cần biết chủ động phân chia thời gian và nguồn lực thực hiện công việc theo tỷ trong phân bổ để có kết quả tốt có gắn kết với các chỉ tiêu kinh doanh.
                            </p>
                            <p style="color: #333;">
                                Tập trung thực hiện nhất quán các công việc cộng với việc tự trau dồi để nâng cao kỹ năng cá nhân sẽ dẫn đến khả năng hoàn thành các chỉ tiêu cao nhất.
                            </p>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>  