<style type="text/css">
    
.table {
  -moz-box-shadow:    2px 2px 5px 2px #ccc;
  -webkit-box-shadow: 2px 2px 5px 2px #ccc;
  box-shadow:         2px 2px 5px 2px #ccc;
  height: 520px;
  overflow: auto;
  overflow-x: hidden;
}
.table-quote>thead>tr>th{
    font-weight: normal;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
vertical-align: top !important;
padding: 10px 15px !important;
text-align: left;
font-size: 14px;
}
.table-quote thead tr {
    background-color: #95aaaf;
}
.table-quote thead tr th { 
    color: #fff !important;
}
.table-quote thead tr th {
    text-align: left;
    border: 1px solid #f5f5f5 !important;
} 
.table-quote tbody {
    color: #5e5e5e;
    background-color: #f1f5f6;
}
.table-quote tbody tr td {
    border: 1px solid #f1f0f0 !important;
    text-align: center;
}
.td{
text-align: left !important;
}
</style>
<?php $string  = ""; ?>
<div style=" height:1000px; overflow: auto;">

    <table class="table table-quote table-striped" style="margin-top:30px; " >
            <thead>
                <tr>
                    <th>Chức năng</th>
                    <th width="20%">Thao tác</th>
                    <?php  $listGroup = GpGroup::model()->findAll();
                    foreach ($listGroup as $key => $gp) { ?>
                    <th><?php echo $gp['group_name'];?></th>
                    <?php $string .= "<td><input type='checkbox' /></td>"; ?>
                    <?php } ?>
                    <th width="15%">Chú thích</th>
                    <?php $string .= "<td></td>" ?>
                </tr>
            </thead>
            <tbody>
            <?php 
                $manager_funtion = ManagerFuntion::model()->findAll();
                $manager_manipulate = ManagerManipulate::model()->findAll();

            foreach ($manager_funtion as $key => $fun) { ?>
                <tr>
                    <?php 
                         $id_ManagerFuntion = $fun['id'];
                        $manager_manipulate_1 = array_filter($manager_manipulate, function($v) use($id_ManagerFuntion){
                            return $v['id_funtion'] == $id_ManagerFuntion;
                        }); 
                        $count = count($manager_manipulate_1);
                    ?>

                    <td rowspan="<?php echo $count; ?>"><?php echo $fun['name'];?></td>
                    <?php
                        foreach ($manager_manipulate_1 as $key => $value) { ?>
                            <td class="td"><?php echo $value['name'];?></td>
                            <?php echo $string; ?>
                            </tr>
                    <?php } ?>
                
            <?php } ?>
            
            </tbody>
    </table>
</div>