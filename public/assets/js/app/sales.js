/**
 | 
 | LIST SALES
 | 
 */
var elem_sales = $('#sales');
// declare datatable sales
var table = $('#sales').DataTable({
    dom: 'Bfrtip',
    responsive: true,
    buttons: 
    [{
        text: '<i class="fas fa-plus"> ADD</i>',
        action: function ( e, dt, node, config ) 
        {
            var url = elem_sales.data('url_add');
            $(location).attr('href',url);
        }
    }]
});

// adding button ADD on datatable sales
table.buttons().container().appendTo($('#sales_filter:eq(0)')).addClass('float-left').children().removeClass('btn-secondary').addClass('btn-success');


/**
 |
 | DETAIL SALES
 |
 */
// onclick button modal in datatable detail product
$('#detail_product tbody').on('click', 'td .btn-modal', function (e){
    e.preventDefault();

    var btn = $(this);
    $('#sales_modal').on('show.bs.modal', function (e) 
    {
        // declare variable
        var button = $(e.relatedTarget);
        var modal = $(this);
        var dataTemp = btn.data('product');
        var dataSplit = dataTemp.split('#');

        // declare JSON Data
        var data = {
            'id_sales': dataSplit[0],
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
                $('#sales_modal').html(res);

                // show modal
                $('#sales_modal').modal('show');
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
 | ADD SALES
 |
 */
var elem_payment_type = $("#payment_type");
my_select(elem_payment_type);

var elem_customer = $("#id_customer");
my_select_ajax(elem_customer, elem_customer.data("url"));

var elem_customer = $("#id_product");
my_select_ajax(elem_customer, elem_customer.data("url_select"));
elem_customer.on('select2:select', function(){
    var id_product = $(this).val();
    $.ajax({
        url: elem_customer.data("url_data"),
        method: "POST",
        data: {search : id_product},
        dataType: "JSON",
        success :function(data){
            // var dataParse = JSON.parse(data);
            $("#product_name").val(data.name);
            $("#product_price").val(data.price_sell);
            $("#product_hpp").val(data.hpp);
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
    var elem          = $(this);
    var id_product    = $("#id_product").val();
    var product_name  = $("#product_name").val();
    var product_price = $("#product_price").val();
    var product_hpp   = $("#product_hpp").val();
    var product_qty   = $("#product_qty").val();

    var data = {
        id_product: id_product,
        product_name: product_name, 
        product_price: product_price, 
        product_hpp: product_hpp, 
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
    $("#product_price").val("");
    $("#product_hpp").val("");
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
 | FORM ADD SALES
 | 
 */
$("#form_sales").validate({
    ignore: 'input[type=hidden]',
    rules: {
        // reference:{
        //     required: true
        // },
        id_customer:{
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
        id_customer: {
            required: "Silahkan pilih customer",
        },
        payment_type: {
            required: "Silahkan pilih tipe pembayaran",
        }
    },
    submitHandler: function(form) {
        var form_elem = $(form);

        if(confirm("Yakin akan menyimpan data penjualan?"))
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