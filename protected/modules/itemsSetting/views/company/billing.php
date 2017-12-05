<div class="customerProfileContainer">

<div id="accout" class="customerProfileHolder" style="display: block;margin:30px auto;">
<h3 style="font-size: 20px;
">1. Choose your plan and billing period</h3>
<div class="plan-select">
    <div class="rg-row">
        <div class="col-md-12">
            <div class="form-group">
                <div>
                    <div class="radio">
                        <label>
                            <input class="billing-monthly" name="BillingType" style="height: auto;" type="radio" checked>&nbsp;&nbsp;
                            Monthly billing
                        </label>
                    </div>
                    <div class="radio"  >
                        <label>
                            <input class="billing-annual" name="BillingType" style="height: auto;" type="radio" >&nbsp;&nbsp;
                            Annual billing (Get 1 month free)
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rg-row">
        <div class="col-sm-12">
            <div class="plan-details plan-schedule">
                <div class="plan-header">
                    <h3>Schedule</h3>
                </div>
                <div class="billing-monthly-details">
                    <h1>
                        $15
                        <span class="billing-period-description">/mo</span>
                        <span class="tax-description"></span>
                    </h1>
                    <p><span class="light">per staff calendar</span></p>
                        <p>You have <strong>1 staff</strong>
                        </p>
                    <p><span class="plan-total-cost">$15</span><span class="tax-description"></span> billed per month
                    </p>

                </div>
                <div class="rg-row billing-annual-details hide">
                    <h1>
                        $165
                        <span class="billing-period-description">/year</span>
                        <span class="tax-description"></span>
                    </h1>
                    <p><span class="light">per staff calendar</span></p>
                    <p>You have <strong>1 staff</strong>
                    </p>
                    <p><span class="plan-total-cost">$165</span><span class="tax-description"></span> billed annually
                    </p>
                </div>
                <div class="plan-select">
                    <a href="javascript:void(0);" onclick="selected()" data-plan-id="-1" class=" f3">Select</a>
                    <span class=" f3 hide"><i class="fa fa-check fa-fw"></i>Selected</span>
                </div>
            </div>
            <div class="plan-details plan-schedule-sell selected">
                <div class="plan-header">
                    <h3>Schedule &amp; Sell</h3>
                </div>
                <div class="billing-monthly-details">
                    <h1>
                        $20
                        <span class="billing-period-description">/mo</span>
                        <span class="tax-description"></span>
                    </h1>
                    <p><span class="light">per staff calendar</span></p>
                        <p>You have <strong>1 staff</strong>
                        </p>
                    <p><span class="plan-total-cost">$20</span><span class="tax-description"></span> billed per month
                    </p>
                </div>
                <div class="rg-row billing-annual-details hide">
                    <h1>
                        $220
                        <span class="billing-period-description">/year</span>
                        <span class="tax-description"></span>
                    </h1>
                    <p><span class="light">per staff calendar</span></p>
                    <p>You have <strong>1 staff</strong>
                    </p>
                    <p><span class="plan-total-cost">$220</span><span class="tax-description"></span> billed annually
                    </p>
                </div>
                <div class="plan-select">
                    <a href="javascript:void(0);" onclick="selected()" data-plan-id="-1" class="f3 hide">Select</a>
                    <span class="f3"><i class="fa fa-check fa-fw"></i>Selected</span>
                </div>
            </div>
        </div>
    </div>
    <div class="rg-row">
        <div class="col-sm-12">
            <br>
            See what's included: <a href="#" class="modal-open">Compare plans</a>
        </div>
    </div>
        <div class="rg-row plan-schedule-downgrade-warning hide">
            <div class="col-sm-12">
                <br>
                <div class="alert alert-block alert-warning">
                    <p>
                        By choosing the <strong>Schedule</strong> plan you will lose access to sales, online payments, products, packages and discounts. You will still be able to access any sales you've raised.
                    </p>
                </div>
            </div>
        </div>
</div>
</div>
</div>
<style type="text/css">
.plan-select .plan-details {
    display: inline-block;
    width: 280px;
    border: 2px solid #ddd;
    border-radius: 4px;
    text-align: center;
    margin-right: 20px;
    cursor: pointer;
}
.plan-select .plan-details .plan-header {
    padding: 5px 0;
    border-bottom: 2px solid #ddd;
}
.plan-select .plan-details {
    display: inline-block;
    width: 280px;
    border: 2px solid #ddd;
    border-radius: 4px;
    text-align: center;
    margin-right: 20px;
    cursor: pointer;
}
.plan-select .plan-details {
    display: inline-block;
    width: 280px;
    border: 2px solid #ddd;
    border-radius: 4px;
    text-align: center;
    margin-right: 20px;
    cursor: pointer;
}
.rg-row {
    margin-left: -20px;
    margin-right: -20px;
}
.plan-select .plan-details .plan-select {
    padding: 5px 0;
    border-top: 2px solid #ddd;
    margin: 0;
}
.plan-select .plan-details.selected {
    border-color: #3fb760;
    cursor: default;
}
.plan-select .plan-details.selected .plan-header {
    border-color: #3fb760;
}
.plan-select .plan-details.selected .plan-select {
    border-color: #3fb760;
    /*//background: #00b3f0;*/
    background-image: url("<?php echo yii::app()->request->baseUrl; ?>/images/bg_cl.jpg");
}
.plan-select{
    padding-left: 34px;
}
.billing-monthly-details {
    color: #464646;
}
.billing-monthly-details > h1 {
    color: #6ec4a1;
}
.billing-annual-details > h1 {
    color: #6ec4a1;
}
</style>
<script type="text/javascript">
    
$('.billing-annual').click(function(){
    $('.billing-annual-details').removeClass('hide');
    $('.billing-monthly-details').addClass('hide');
})
$('.billing-monthly').click(function(){
    $('.billing-annual-details').addClass('hide');
    $('.billing-monthly-details').removeClass('hide');
});
 function selected(){
    $('.f3').toggleClass('hide');
    $('.plan-details').toggleClass('selected');
 } 
</script>