 
 <div class="row">
    <div class="customerListContainer col-sm-3 col-md-3">
        <div style="margin:0px 2em;">
                <div class="customersActionHolder">
                        <h3>Chi nhánh</h3>
                        <a class="btn_plus" id="newCustomer" data-delay="0" data-placement="right" data-original-title="Thêm khách hàng"></a>
                        <div id="importExportLabel" class="importLabel fr importAndSort blue_glowb hide">
                            Import/Export
                            <ul id="importExportOptionList">
                                <li id="import"> Import </li>
                                <li id="export"> Export All </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                </div>

                <div id="addnewCustomerPopup" class="popover bottom" style="display: none;">
                    <form id="frm-add-customer" onsubmit="return false;" class="form-horizontal">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="background-color: #f8f8f8;font-size: 15px;padding: 8px 14px;">Thêm chi nhánh</h3>
                        <div class="popover-content" style="width:225px;">
                            <input type="text" required oninvalid="this.setCustomValidity('Vui lòng nhập tên chi nhánh.')" oninput="setCustomValidity('')" class="form-control" id="customerNewName" name="customerNewName" placeholder="Tên chi nhánh" style="margin-bottom:10px;">
                           
                            <button id="addnewCustomer" type="submit" class="btn btn_bookoke btn_bookoke_w">Tạo mới</button>
                            <button id="cancelNewCustomer" type="reset" class="btn btn_cancel" style="min-width: 94px;margin-right: 0px;">Hủy</button>
                        </div>
                    </form>
                </div>

                <div class="customerSearchHolder">
                    <div id="customer-search-textbox">
                        <input type="text" onkeypress="runScript_search(event);" id="searchNameCustomer" class="customerSearch fl blue_focus " value="" placeholder="Tìm kiếm...">
                        <input type="hidden" id="searchSortCustomer" value="1">
                        <i class="icon-sort-down fr noDisplay" id="advanced-search-PopUp" style="position:absolute;left:227px;margin-top: 7px;cursor: pointer;"></i>
                    </div>
                    
                    <div id="sortLabel" class="sortLabel fr importAndSort">
                        <i class="fa fa-list"></i>
                        <ul id="sortOptionList" style="padding:0px;">
                            <li class="SortBy" class="sort-customers-option" style="list-style: none;"><input type="hidden" value="1">Theo Tên </li>                                           
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
                    <ul id="customerList" style="padding:0px;list-style:none;">
                           
                               
                    </ul>
                   
                </div>

            </div>
    </div>
    <div class="col-sm-7 col-md-9" id="detailContent">
        <?php /* include("detail_branch.php");*/?>
    </div>

</div>

<script type="text/javascript">
    
$(window).resize(function() {
    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();  
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);     

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});
$( document ).ready(function() {

    var windowHeight =  $( window ).height();
    var header       = $("#headerMenu").height();
    var tab_menu     = $("#tabcontent .menuTabDetail").height();
    var customer_action = $(".customersActionHolder").height();    
    var customer_search = $(".customerSearchHolder").height();

    $('#profileSideNav').height(windowHeight-header);

    $('.statsTabContent').height(windowHeight-header-tab_menu-45);   

    $('#customerList').css('max-height', windowHeight-header-customer_action-customer_search-80);

});
$( document ).ready(function() { 
    searchBranchs();
});
</script>
<?php include('_style.php'); ?>
<?php include('_js.php'); ?>