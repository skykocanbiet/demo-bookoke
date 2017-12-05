<script>
function customer() {
    $('#invoice_customer').select2({
        placeholder: 'Khách hàng',
        width: '150px',
        allowClear: true,
        ajax: {
            dataType : "json",
            url      : '<?php echo CController::createUrl('quotations/getCustomerList'); ?>',
            type     : "post",
            delay    : 50,
            data : function (params) {
                return {
                    q: params.term, // search term
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                
                return {
                    results: data,
                    pagination: {
                        more:true
                    }
                };
            },
            cache: true,
        },
    });
}

function exportRpt(evnt, id, idRct, lang) {
    evnt.preventDefault();
    var url="<?php echo CController::createUrl('invoices/eRpt')?>?id="+id+"&idRpt="+idRct+"&lang="+lang;
    window.open(url,'name');
}

function loadInvoice(page,id,time,branch,customer,invoice_code) {
    $('.cal-loading').fadeIn('fast');
    $.ajax({ 
        type:"POST",
        url:"<?php echo Yii::app()->createUrl('itemsSales/invoices/loadInvoice')?>",
        dataType: 'html',
        data: {
            page        : page,
            id          : id,
            invoice_time    : time,
            invoice_branch  : branch,
            invoice_customer: customer,
            invoice_code    : invoice_code,

        },
        success:function(data){
            if(data){
                $("#InvoiceList").html(data);
                $('.cal-loading').fadeOut('slow');
            }
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
    });
}

$( document ).ready(function() {
$('#InvoiceList').on('show.bs.collapse','.collapse', function () {
    $('.collapse.in').collapse('hide');
});
$.fn.select2.defaults.set( "theme", "bootstrap" );
    id = <?php echo $id? $id: 0; ?>;
    id_branch = <?php echo Yii::app()->user->getState('user_branch'); ?>;
    $('#invoice_branch').val(id_branch);
    loadInvoice(1,id,'',id_branch);

    customer();

    $('#InvoiceList').on('click','.ivLang',function(e){
        lang = $(this).data('val');
        id_invoice = $(this).parents('tr').find('input:hidden[name=id_invoice]').val();

        exportRpt(e, id_invoice, 0, lang);
    })

    $('#oAdds').click(function (e) {
        e.preventDefault();
        x = 1;
        $('.currentRow').nextAll('tr').remove();
        $('.sNote').show();
        $('#sAddNote').addClass('hidden');
    });

    // search time
    $('#invoice_time').change(function(e){
        invoice_time = $('#invoice_time').val();
        invoice_branch = $('#invoice_branch').val();
        invoice_customer = $('#invoice_customer').val();

        loadInvoice(1, '', invoice_time, invoice_branch, invoice_customer, '');
    })

    // search branch
    $('#invoice_branch').change(function(e){
        invoice_time = $('#invoice_time').val();
        invoice_branch = $('#invoice_branch').val();
        invoice_customer = $('#invoice_customer').val();

        loadInvoice(1, '', invoice_time, invoice_branch, invoice_customer, '');
    })

    // search customer
    $('#invoice_customer').change(function(e){
        invoice_time = $('#invoice_time').val();
        invoice_branch = $('#invoice_branch').val();
        invoice_customer = $('#invoice_customer').val();

        loadInvoice(1, '', invoice_time, invoice_branch, invoice_customer, '');
    })

    // search customer
    $('#invoice_srch').click(function(e){
       invoice_code = $('#invoice_code').val();

        loadInvoice(1, '', '', '', '', invoice_code);
    })

    if($('#quote_modal div').length == 0){
        $('.cal-loading').fadeIn('fast');
        $.ajax({ 
            type:"POST",
            url:"<?php echo Yii::app()->createUrl('itemsSales/Quotations/create')?>",
            datatype:'json',
            success:function(data){
                if(data){
                    $("#quote_modal").html(data);
                    $('.cal-loading').fadeOut('slow');
                }
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
            cache      : false,
            contentType: false,
            processData: false
        });
    };

    /*order pay*/
    $('#InvoiceList').on('click','.iPay',function(e){
        var id_invoice = $(this).parents('tr').find('input:hidden[name=id_invoice]').val();
        if(!id_invoice)
            return;
        $('.cal-loading').fadeIn('fast');
        $.ajax({ 
            type    :"POST",
            url     :"<?php echo Yii::app()->createUrl('itemsSales/invoices/invoicesPay')?>",
            datatype:'json',
            data    : {
                id_invoice    :   id_invoice,
            },
            success:function(data){  
                if(data){
                    $("#invoice_pay_modal").html(data);
                    $("#invoice_pay_modal").modal("show");
                }
                $('.cal-loading').fadeOut('slow');
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
        });
    });
});

</script>