<script type="text/javascript">
	$(document).ready(function(){
	    var table = $('#category').DataTable({
	    	ajax: "<?php echo base_url('admin/users/list'); ?>",
	        columns: [
	            { "data" : "<?=USERNAME?>" },
	            { "data" : "<?=EMAIL?>" },
	            { "data" : "<?=PHONE?>" },
	            { "data" : "<?=ENABLE?>" },
	            { "data" : "<?=ACTIVE?>" },
	            { 
	            	"data" : "<?=ID?>", render : function ( data, type, row, meta ) 
	            	{
              			return type === 'display'  ? '<button type="button" class="btn btn-sm btn-warning btn-edit" data-id="'+ data +'"><i class="fas fa-edit text-dark"></i> Edit</button><button type="button" class="btn btn-sm btn-danger btn-delete" data-id="'+ data +'"><i class="far fa-trash-alt text-dark"></i> Delete</button>' : data;
            		}
        		}
	        ],
	    	dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
	    	responsive: true,
	        buttons: [
	            {
	            	className: 'btn btn-sm btn-success',
	                text: '<i class="fas fa-plus"></i> TAMBAH',
	                action: function ( e, dt, node, config ) {
	                    var url = "<?php echo BASE_URL('admin/users/add'); ?>";
	                    $(location).attr('href',url);

	                    // $('#supplierModal').modal();
	                }
	            }
	        ]
	    });

	    $('#category tbody').on('click', '.btn-edit', function(){
	    	var id = $(this).data("id");

	    	window.location = "<?php echo BASE_URL(ADMIN_PATH.'/users/update'); ?>/" + id;
    	});

	    $('#category tbody').on('click', '.btn-delete', function(){
	    	if(confirm("Yakin akan menghapus data ?"))
	    	{	
		    	var id = $(this).data("id");

	    		window.location = "<?php echo BASE_URL(ADMIN_PATH.'/users/delete'); ?>/" + id;
	    	}
    	});
	});

	$('.back').click(function(){
		$(location).attr('href', '<?php echo BASE_URL('admin/users'); ?>')
	});
</script>