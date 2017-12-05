<!-- VIEW FORM SEARCH -->
<form class="form-horizontal frm-search-aipac" id="yw0" action="/nhakhoa2000/index.php/Admin/index" method="get">

    <div class="col-md-5  clearfix">
        <div class="form-group">
            <label class="col-sm-4 control-label required" for="Quotation_code_number">QO Number</label>
            <div class="col-sm-8"><input class="form-control" placeholder="number" name="Quotation[code_number]" id="Quotation_code_number" type="text"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label" for="Quotation_type">QO Type</label>
            <div class="col-sm-8"><input maxlength="255" class="form-control" placeholder="type" name="Quotation[type]" id="Quotation_type" type="text"></div>
        </div>
    </div>

    <div class="col-md-5  clearfix">
        <div class="form-group">
            <label class="col-sm-4 control-label " for="Quotation_createdate">QO Date</label>
            <div class="col-sm-8"><input class="form-control hasDatepicker" placeholder="Createdate" name="Customer[createdate]" id="Customer_createdate" type="text"></div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label " for="Quotation_customer">Customer</label>
            <div class="col-sm-8"><input class="form-control" name="Quotation[customer]" id="Quotation_customer" type="text"></div>
        </div>
    </div>
    <!-- SUPMIT -->
    <div class="col-md-2 text-align-center clearfix">
        <div><button type="button" class="btn btn-success btn-aipac">Search</button></div>
        <div style="margin-top: 18px;"><button type="button" class="btn btn-success btn-aipac">New</button></div>
    </div>
    <div class="clearfix"></div>
</form>

<!-- VIEW TABLE LIST -->
<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr class="table_title" >
                <th class="text-center"><input type="checkbox" value="" id="checkall_info"  name="row_info"/> No.</th>
                <th class="text-center">QO No.</th>
                <th class="text-center">Account</th>
                <th class="text-center">User</th>
                <th class="text-center">Product</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Promotion</th>
                <th class="text-center">Discount</th>
                <th class="text-center">Created Date</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td  style="text-align: center;color: #000;" colspan="11">No recode display!</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- VIEW FORM INFORMATION -->
<hr style="background-color: #003366; opacity:0.9;margin: 40px auto;" />
<div class="box-information margin-bottom-50">
    <h4 class="text-align-center margin-bottom-35">QUOTATION</h4>
    <form class="form-horizontal frm-info" id="yw0" action="/nhakhoa2000/index.php/Admin/index" method="get">
        <!-- INFO DATA -->
        <div class="box-info-data">
            <!-- FRM-LEFT -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_customer">Customer</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[customer]" id="Quotation_customer" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_address">Address</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[address]" id="Quotation_address" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_address">Phone</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[address]" id="Quotation_address" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_address">Status</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[address]" id="Quotation_address" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_address">Payment</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[address]" id="Quotation_address" type="text"></div>
                </div>
            </div>
            <!-- FRM-RIGHT -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_code_number">Quote Number</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[code_number]" id="Quotation_code_number" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_type">Quote Type</label>
                    <div class="col-sm-6"><input maxlength="255" class="form-control" name="Quotation[type]" id="Quotation_type" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_type">Account Manager</label>
                    <div class="col-sm-6"><input maxlength="255" class="form-control" name="Quotation[type]" id="Quotation_type" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_createdate">Created Date</label>
                    <div class="col-sm-6"><input class="form-control hasDatepicker" name="Customer[createdate]" id="Customer_createdate" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_createdate">Schedule Date</label>
                    <div class="col-sm-6"><input class="form-control hasDatepicker" name="Customer[createdate]" id="Customer_createdate" type="text"></div>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>

        <!-- SUP LIST -->
        <div class="table-responsive margin-bottom-20">
            <table class="table table-striped table-hover">
                <thead>
                <tr class="table_title" >
                    <th class="text-center">No.</th>
                    <th class="text-center">Product</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Promotion</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td><input class="form-control" name="sub[product]"  type="text"></td>
                    <td><input class="form-control" name="sub[price]"  type="text"></td>
                    <td>
                        <select class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </td>
                    <td><input class="form-control" name="sub[promotion]"  type="text"></td>
                    <td><input class="form-control" name="sub[amount]"  type="text"></td>
                    <td><button type="button" class="btn btn-success btn-aipac">Add</button></td>
                </tr>
                </tbody>
            </table>
        </div>

        <!-- INFO DATA TOTAL-->
        <div class="box-info-data ">
            <!-- FRM-LEFT -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_code_number">Notes</label>
                    <div class="col-sm-6"><textarea class="form-control" rows="10"></textarea></div>
                </div>
            </div>
            <!-- FRM-RIGHT -->
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_code_number">Discount</label>
                    <div class="col-sm-6"><input class="form-control" name="Quotation[code_number]" id="Quotation_code_number" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_type">Shipping Fee</label>
                    <div class="col-sm-6"><input maxlength="255" class="form-control" name="Quotation[type]" id="Quotation_type" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_type">SubTotal</label>
                    <div class="col-sm-6"><input maxlength="255" class="form-control" name="Quotation[type]" id="Quotation_type" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_createdate">Tax</label>
                    <div class="col-sm-6"><input class="form-control hasDatepicker" name="Customer[createdate]" id="Customer_createdate" type="text"></div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label text-align-right" for="Quotation_createdate"><strong>TOTAL</strong></label>
                    <div class="col-sm-6"><input class="form-control hasDatepicker" name="Customer[createdate]" id="Customer_createdate" type="text"></div>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>

        <!-- SUPMIT -->
        <div class="box-btn-submit">
            <div><button type="button" class="btn btn-success btn-aipac">Edit</button></div>
            <div class="margin-top-10"><button type="button" class="btn btn-success btn-aipac">Copy</button></div>
            <div class="margin-top-10"><button type="button" class="btn btn-success btn-aipac">Print</button></div>
            <div class="margin-top-10"><button type="button" class="btn btn-success btn-aipac">Export</button></div>
            <div class="margin-top-10"><button type="button" class="btn btn-success btn-aipac">Create PO</button></div>
            <div class="margin-top-10"><button type="button" class="btn btn-danger btn-aipac">Delete</button></div>
        </div>
        <div class="clearfix"></div>
    </form>
</div>
