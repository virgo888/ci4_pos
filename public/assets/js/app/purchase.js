/**
 | 
 | LIST PURCHASE
 | 
 */
var elem_purchase = $('#purchase');
// declare datatable purchase
var table = $('#purchase').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: 
    [{
        text: '<i class="fas fa-plus"> ADD</i>',
        action: function ( e, dt, node, config ) 
        {
            var url = elem_purchase.data('url_add');
            $(location).attr('href',url);
        }
    }]
});

// adding button ADD on datatable purchase
table.buttons().container().appendTo($('#purchase_filter:eq(0)')).addClass('float-left').children().removeClass('btn-secondary').addClass('btn-success');


/**
 |
 | DETAIL PURCHASE
 |
 */
// onclick button modal in datatable detail product
$('#detail_product tbody').on('click', 'td .btn-modal', function (e){
    e.preventDefault();

    var btn = $(this);
    $('#purchase_modal').on('show.bs.modal', function (e) 
    {
        // declare variable
        var button = $(e.relatedTarget);
        var modal = $(this);
        var dataTemp = btn.data('product');
        var dataSplit = dataTemp.split('#');

        // declare JSON Data
        var data = {
            'id_purchase': dataSplit[0],
            'id_product': dataSplit[1],
            'qty': dataSplit[2]
        }

        // load modal from value of data-remote ajax
        $.ajax({
            type: "POST",
            url: btn.attr('href'),
            data: data,
            // dataType: 'JSON',
            success: function(res) 
            {
                // set content into modal
                $('#purchase_modal').html(res);

                // show modal
                $('#purchase_modal').modal('show');
            },
            error:function(request, status, error) {
              console.log("ajax call went wrong: " + request.responseText);
          }
      });

    });
});

// declare datatatable detail product
// options : responsive
$('#detail_product').DataTable({
    responsive: true,
});

/**
 |
 | ADD PURCHASE
 |
 */
var elem_payment_type = $("#payment_type");
my_select(elem_payment_type);

var elem_supplier = $("#id_supplier");
my_select_ajax(elem_supplier, elem_supplier.data("url"));

var elem_supplier = $("#id_product");
my_select_ajax(elem_supplier, elem_supplier.data("url_select"));
elem_supplier.on('select2:select', function(){
    var id_product = $(this).val();
    $.ajax({
        url : elem_supplier.data("url_data"),
        method : "POST",
        data : {search : id_product},
        success :function(data){
            var dataParse = JSON.parse(data);
            $("#product_name").val(dataParse.name);
            $("#product_price_buy").val(dataParse.price_buy);
            $("#product_hpp").val(dataParse.hpp);
            $("#product_price_sell").val(dataParse.price_sell);
            $("#product_qty").focus();
        }
    });
});

/**
 | 
 | CART
 | 
 */
// Add to cart
$('.add_cart').click(function(){
    var elem               = $(this);
    var id_product         = $("#id_product").val();
    var product_name       = $("#product_name").val();
    var product_price_buy  = $("#product_price_buy").val();
    var product_hpp        = $("#product_hpp").val();
    var product_price_sell = $("#product_price_sell").val();
    var product_qty        = $("#product_qty").val();

    var data = {
        id_product: id_product,
        product_name: product_name, 
        product_price_buy: product_price_buy, 
        product_hpp: product_hpp, 
        product_price_sell: product_price_sell,
        product_qty: product_qty
    };

    $.ajax({
        url : elem.data('url'),
        method : "POST",
        data : data,
        success: function(data){
            $('#detail_cart').html(data);
        }
    });

    $('#id_product').val(null).trigger('change');
    $('#product_name').val("");
    $("#product_price_buy").val("");
    $("#product_hpp").val("");
    $('#product_price_sell').val("");
    $('#product_qty').val("");
});

// Load shopping cart
if($('#detail_cart').length)
{
    $('#detail_cart').load($('#detail_cart').data("url_load"));
}

//Hapus Item Cart
$(document).on('click','.hapus_cart',function(){
    var row_id=$(this).attr("id"); //mengambil row_id dari artibut id
    var url = $(this).data("url_delete");
    $.ajax({
        url : url,
        method : "POST",
        data : {row_id : row_id},
        success :function(data){
            $('#detail_cart').html(data);
        }
    });
});

/**
 | 
 | FORM ADD PURCHASE
 | 
 */
$("#form_purchase").validate({
    ignore: 'input[type=hidden]',
    rules: {
        // reference:{
        //     required: true
        // },
        id_supplier:{
            required: true
        },
        payment_type:{
            required: true
        }
    },
    messages: {
        // reference: {
        //     required: "Silahkan isi data reference",
        // },
        id_supplier: {
            required: "Silahkan pilih supplier",
        },
        payment_type: {
            required: "Silahkan pilih tipe pembayaran",
        }
    },
    submitHandler: function(form) {
        var form_elem = $(form);

        if(confirm("Yakin akan menyimpan data pembelian?"))
        {
            $.ajax({
                url : form_elem.data("url_save"),
                type : "POST",
                data : form_elem.serialize(),
                dataType: 'json',
                success: function(datas){
                    if(datas.success == true)
                    {
                        alert(datas.message);
                        window.location.href = form_elem.data("url_href");
                    }
                    else
                    {
                        alert(data.message);
                    }
                }
            });
        }
        return false;
    }
});