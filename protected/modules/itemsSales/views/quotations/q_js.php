<script>
function customer() {
    $('#quote_customer').select2({
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
function loadQuotation(page,id,time,branch,customer,code_quote) {
    $('.cal-loading').fadeIn('fast');
    $.ajax({ 
        type:"POST",
        url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/loadQuotation')?>",
        dataType: 'html',
        data: {
            page        : page,
            id          : id,
            quote_time        : time,
            quote_branch      : branch,
            quote_customer    : customer,
            quote_code  : code_quote,
        },
        success:function(data){
            if(data){
                $("#QuotationList").html(data);
                $('.cal-loading').fadeOut('slow');
            }
        },
        error: function(data) {
            alert("Error occured.Please try again!");
        },
    });
}

function deleteQuotation(id_quotation,order) {
    if(order == 1) {
        alert("Báo giá đã có đơn hàng! Bạn không được xóa!");
        return false;
    }
    if(confirm("Bạn có thực sự muốn xóa?")) {
        $.ajax({ 
            type:"POST",
            url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/deleteQuotation')?>",
            data: {
               id_quotation: id_quotation,
            },
            success:function(data){
                if(data == 0)
                    alert("Mã báo giá không tồn tại!");
                else if(data == 1){
                    alert("Xóa thành công!");
                    loadQuotation(1,'');
                }
                else if(data == -1)
                    alert(data);
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
        });
    }
}

function exportQuote(idQuote) {
       
    var url="<?php echo CController::createUrl('quotations/exportQuatation')?>?id_quote="+idQuote;
    window.open(url,'name');
}

$( document ).ready(function() {
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    customer();
    id_branch = <?php echo Yii::app()->user->getState('user_branch'); ?>;
    $('#quote_branch').val(id_branch);
    loadQuotation(1,'','',id_branch);

    $('#QuotationList').on('show.bs.collapse','.collapse', function () {
        $('.collapse.in').collapse('hide');
    });
    
    $('#oAdds').click(function (e) {
        e.preventDefault();
        x = 1;
        $('.group').html('');
        $('.currentRow').nextAll('tr').remove();
        $('.sNote').show();
        $('#sAddNote').addClass('hidden');
        $('.DisPop').hide();
        $('#Quotation_note').val('');
        $('#Quotation_id_customer').html('');
        $('.showSeg').hide();
        $('.cal_ans').val(0);
        $('#QuotationService_1_id_user').html('');
        resizeTable();
        $('.upsbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
    });

    
/*search quotations*/
    // search time
    $('#quote_time').change(function(e){
        quote_time = $('#quote_time').val();
        quote_branch = $('#quote_branch').val();
        quote_customer = $('#quote_customer').val();

        loadQuotation(1, '', quote_time, quote_branch, quote_customer, '');
    })

    // search branch
    $('#quote_branch').change(function(e){
        quote_time = $('#quote_time').val();
        quote_branch = $('#quote_branch').val();
        quote_customer = $('#quote_customer').val();

        loadQuotation(1, '', quote_time, quote_branch, quote_customer, '');
    })

    // search customer
    $('#quote_customer').change(function(e){
        quote_time = $('#quote_time').val();
        quote_branch = $('#quote_branch').val();
        quote_customer = $('#quote_customer').val();

        loadQuotation(1, '', quote_time, quote_branch, quote_customer, '');
    })

    // search customer
    $('#quote_srch').click(function(e){
       quote_code = $('#quote_code').val();

        loadQuotation(1, '', '', '', '', quote_code);
    })

    /*create new quotations*/
    if($('#quote_modal div').length == 0){
        $('.cal-loading').fadeIn('fast');
        $.ajax({ 
            type:"POST",
            url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/create')?>",
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
            cache: false,
            contentType: false,
            processData: false
        });
    };

    /*update quotations*/
    $('#QuotationList').on('click','.qUpdate',function(e){
        var id_quotation = $(this).parents('tr').find('input:hidden[name=id_quotation]').val();

        if(!id_quotation)
            return;

        var update = $(this).parents('tr').find('#quoteUp').val();
        $('.cal-loading').fadeIn('fast');
        $.ajax({ 
            type:"POST",
            url:"<?php echo Yii::app()->createUrl('itemsSales/quotations/updateQuotation')?>",
            datatype:'json',
            data: {
                id_quotation: id_quotation,
            },
            success:function(data){
                if(data){
                    $("#update_quote_modal").html(data);
                   
                    $('.cal-loading').fadeOut('slow');
                    itemValue = $('.sItem tr:last .group').val();

                    if(itemValue)
                        $('.upsbtnAdd').removeClass('btn_unactive').addClass('btn_bookoke');
                    else
                        $('.upsbtnAdd').addClass('btn_unactive').removeClass('btn_bookoke');
                }
            },
            error: function(data) {
                alert("Error occured.Please try again!");
            },
           
        });
    });
});

</script>