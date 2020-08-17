jQuery.validator.setDefaults({
    errorElement: 'span',
    errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
    }
});

function mySelect (elem)
{
    // declare select option for payment type
    var search;
    elem.select2({
        theme: "bootstrap4",
        language: "id",
        placeholder: "Silahkan pilih",
        allowClear: true,
    });
    elem.on('select2:open', function() {
        setTimeout(function() 
        {
            if(search && search.length) {
                $('.select2-search input').val(search).trigger('input');
            }
        }, 0);
    }).on('select2:closing', function() {
        search = $('.select2-search input').prop('value');
    });
}

function mySelectAjax(elem, url)
{
	elem.select2({
        theme: "bootstrap4",
        language: "id",
        placeholder: "Silahkan pilih",
        allowClear: true,
        minimumInputLength: 2,
        ajax: {
            url: url,
            dataType: 'json',
            type: "POST",
            quietMillis: 50,
            data: function (params) 
            {
                // declare variable query
                var query = {
                    search: params.term
                }

                // Query parameters will be ?search=[term]&type=public
                return query;
            },
            // chace: true
        }
    });
    var search;
    elem.on('select2:open', function() {
        setTimeout(function() {
          if(search && search.length) {
            $('.select2-search input').val(search).trigger('input');
        };
    }, 0);
    }).on('select2:closing', function() {
        search = $('.select2-search input').prop('value');
    });
}

function myDatatables(param, start_date, end_date)
{
    var table;
    var selector = $('#'+param['selector']);
    var options = {
        dom: 'Bfrtip',
        responsive: true,
        'ajax': {
            'url': param['url'],
            'type': 'GET',
            'data': {
                'start_date': start_date,
                'end_date': end_date
            },
            'dataSrc': function (json) {
                // $(document).CsrfAjaxGet();
                return json;
            }
        },
        'buttons': param['buttons'],
        'columns': param['columns'],
        'columnDefs': param['columnDefs'],
    };
    return selector.DataTable(options);
    // table = selector.DataTable(options);

    // table.buttons().container().appendTo($('#product_filter:eq(0)')).addClass('float-left').children().removeClass('btn-secondary').addClass('btn-success');

    // table.buttons().container().appendTo($('#product_filter:eq(0)')).addClass('float-left').children().removeClass('btn-secondary').addClass('btn-success btn-modal');
}