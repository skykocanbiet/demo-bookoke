<?php $baseUrl = Yii::app()->baseUrl;?>
<!--Font Awesome and Bootstrap Main css  -->


<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/jqtransform.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/setting.css" />
<link id="settingCss" rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/customers_new.css" />

<!-- PAINT -->
<link rel="Stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/paint/wPaint.min.css" />
<!-- END PAINT -->

<input type="hidden" id="baseUrl" value="<?php echo Yii::app()->baseUrl?>"/>

<style type="text/css">

#profileSideNav ul li a i{
    font-size:2em;  
}

#profileSideNav ul li a img{
    opacity:.5;  
}

#profileSideNav ul li.active a img{
    opacity:1;  
}
  
#profileSideNav ul li a:hover img{
    opacity:1;  
}
 .slider_holder {
    float: left;
    /* margin-top: 3px; */
    overflow-x: hidden;
    padding-left: 0px;
    position: relative;
    width: 60px;
    height: 25px;
    cursor: pointer;
} 
.btnsearch:hover{
    /* box-shadow: 0 5px 15px rgba(0,0,0,.5);
         height: 109%;*/
}
.delete{
    float: right;
    display: none;
   
    margin-top: 12px;

}
.btn_delete{
      margin-top: -12px;
    margin-bottom: -6px;
    background-color: rgba(255, 255, 255, 0);
    border-color: rgba(204, 204, 204, 0.03);
}
#customerList li:hover .delete{
    display: inline;
}
#customerList .active .delete{
    display: inline;
}

</style>


<div class="row wrapper tab-content full-height">

<div>
    <?php include 'add_list.php'; ?>
</div>
    <!-- Contact Customers -->
    <div id="customers" class="tab-pane full-height active">
        <div class="row-fluid full-height">

            <div id="customerContent" class="content">

                <div  id="leftsidebar" class="col-sm-5 col-md-4 col-lg-4">
                    <div class="row">

                        <div  id="profileSideNav"  class="span1 primary-navbar col-sm-3 col-md-2">

                            <ul class="nav nav-tab nav-stacked" id="myTab">
                                <li id="profile_configure_nav"  class="active">
                                    <a href="" data-toggle="tab">
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/SUPPLIER.png" /> <br>
                                        Providers
                                    </a>
                                </li>

                                <li id="profile_preview_nav">
                                    <a  href="<?php echo Yii::app()->request->baseUrl; ?>/itemsPartner/agents/view">
                                        <img src="<?php echo $baseUrl;?>/images/icon_sb_left/PARTNER.png" />
                                        <br>
                                        Agent
                                    </a>
                                </li>

                                
                                
                            </ul>
                        </div>

                        <div class="customerListContainer col-sm-9 col-md-10 col-lg-9" >
                            <div style="margin:0px 2em;">
                                <div class="customersActionHolder">
                                        <h3>List (<?php echo $model->count() ?>)</h3>
                                        <a class="global_btn" id="newCustomer" data-delay="0" data-placement="right" data-original-title="Thêm khách hàng"> + </a>
                                        <div id="importExportLabel" class="importLabel fr importAndSort blue_glowb hide">
                                            Import/Export
                                            <ul id="importExportOptionList">
                                                <li id="import"> Import </li>
                                                <li id="export"> Export All </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                </div>
                                <div id="addprovider" class="popover bottom" style="display: none;">
                                   
                                </div>

                                <div class="customerSearchHolder">
                                    <div id="customer-search-textbox">
                                        <div class="input-group">
                                          <input type="text" onkeypress="runScript_search(event);" id="searchNameCustomer" class="customerSearch fl blue_focus " value="" placeholder="Search...">
                                          <span class="input-group-btn">
                                            <button class="btn btn-secondary btnsearch" type="button" onclick="searchCustomers();" style="background-color:rgba(255, 255, 255, .15);     position: initial;">
                                                <img src="<?php echo Yii::app()->request->baseUrl;?>/images/icon/search.png" style="width: 20px; height:auto; " onClick="searchNameCustomer">
                                            </button>
                                          </span>
                                        </div>
                                        <input type="hidden" id="searchSortCustomer" value="1">
                                        <i class="icon-sort-down fr noDisplay" id="advanced-search-PopUp" style="position:absolute;left:227px;margin-top: 7px;cursor: pointer;"></i>
                                    </div>
                                    
                                    <div id="sortLabel" class="sortLabel fr importAndSort">
                                        <i class="fa fa-list"></i>
                                        <ul id="sortOptionList">
                                            <li class="SortBy" class="sort-customers-option"><input type="hidden" value="1">sort fullname </li>
                                            <li class="SortBy" class="sort-customers-option"><input type="hidden" value="3">sort phone </li> 
                                            <li class="SortBy" class="sort-customers-option"><input type="hidden" value="4">sort code </li>                                              
                                        </ul>
                                    </div>
                                    
                                    <div class="clearfix"></div>    
                                    <div id="advancePopup-holder">
                                        <div class="advanced-search-popup popover bottom">
                                            <div class="arrow" style="margin-left:82px;"></div>
                                            <h3 style="background-color: #f8f8f8" class="popover-title">Advanced Search</h3>
                                            <div class="advanced-search-textarea-holder" style="padding: 10px 40px 0px 12px;">
                                                <div class="searchByName-input">
                                                    <span><input type="text" placeholder="Search By Name" id="searchByName"></span>
                                                </div>
                                                <div class="searchByTag-input">
                                                    <!-- <input type="text" placeholder="Search By Tag" id="searchByTag"> -->
                                                    <div id="advanced-search-tag-view" class="tag-Search-view">
                                                        <ul class="customertags_list" id="customerTagForSearch" style="padding:0px;"></ul>
                                                        <span>
                                                            <input type="text" id="searchByTag" class="tag-input-text" placeholder="Search By Tag">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div id="tag-customer-search" class="fl" style="margin-top:9px;margin-left:1px;"></div>
                                                <div id="btn-advanced-search" style="margin-bottom: 15px;">
                                                    <button id="search-btn-advanced" class="new-gray-btn new-green-btn" style="min-width:115px">Search</button>
                                                    <button id="cancel-btn-advanced" class="new-gray-btn">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="customerListHolder" class="customerListHolder">
                                    <ul id="customerList" style="max-height: 770px;">
                                            <?php
                                             $model = new Company();
                                            $maps =  $model->getCompany();
                                            foreach ( $maps as $k => $v): 
                                                ?>
                                             <li id="c<?php echo $v['Id']; ?>" onclick="detailprovider(<?php echo $v['Id']; ?>);"  class="n" style="    position: relative;" >
                                                                          
                                                <span class="jqTransformCheckboxWrapper" style="display:none;">
                                                    <a href="#" class="jqTransformCheckbox"></a>
                                                    <input type="checkbox" value="<?php echo $v['Id']; ?>" class="fl" style="display : none;">
                                                </span>
                                                
                                                <img src="<?php echo $baseUrl; ?>/upload/provider/lg/<?php if($v['images'] !="") echo $v['images']; else echo "no_avatar.png";?>" class="fl" style="border-radius:100%;">
                                                <label class="fl" id="name<?php echo $v['Id']; ?>"><?php echo $v['Name']; ?></label>
                                               
                                            <div id="delete">
                                                <span class="delete popup">
                                                    <a href="#" class="btn btn-info  btn_delete" id="" onclick="delete_provider(<?php echo $v['Id']; ?>)">
                                                         <span class="glyphicon glyphicon-trash"></span>
                                                     </a>
                                                        <input type="hidden" value="<?php echo $v['Id']; ?>">
                                                    <div id="deleteProvider<?php echo $v['Id']; ?>" class="popover bottom deleteProvider" style="display: none;">
                                                        <form id="frm-delete-provider" onsubmit="return false;" class="form-horizontal">
                                                            <div class="arrow"></div>
                                                            <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Are you sure delete.?</h3>
                                                            <div class="popover-content" style="width:225px;">
                                                                <label><?php echo $v['Name']; ?></label><br>
                                                                <button id="yes_delete<?php echo $v['Id']; ?>" onclick="deleteprovider(<?php echo $v['Id']; ?>)" class="new-gray-btn new-green-btn">Yes</button>
                                                                <button id="cancelNewCustomer" type="reset" class="cancelNewStaff new-gray-btn" style="min-width: 94px;margin-right: 0px;">Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>                                                    </span> 
                                                </div>
                                                <div class="clearfix"></div>
                                            </li>
                                            <?php endforeach; ?>
                                               
                                    </ul>
                                     <div id="loadding" class="hidden" style="text-align: center;font-weight:bold;">
                                        <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                        <span>Loading...</span>
                                    </div>
                                </div>
                               
                            </div>
                        </div>    

                        <div class="clearfix"></div>
                    </div>   
                </div>
                
                <!-- Detail Customer -->
                <div id="detailCustomer" class="col-sm-7 col-md-8 col-lg-8">
                    <?php  include('provider_default.php'); ?>
                </div>


                <div class="clearfix"></div>
            



        </div>
    </div>


</div>

<?php include('_style.php'); ?>
<?php include('_js.php'); ?>
