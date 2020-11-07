<div class="card mt-3">
	<div class="card-header">
		<h4><?=$content_title?></h4>
	</div>
	<div class="card-body">
		<?php
			$success = session()->getFlashdata('success');
			$error = session()->getFlashdata('error');
			
			if(!empty($success))
			{
		?>
				<div class="alert alert-success" role="alert">
                    <?=$success?>
                </div>
        <?php
        	}

			if(!empty($error)) 
        	{
		?>
				<div class="alert alert-danger" role="alert">
                    <?=$error?>
                </div>
        <?php
        	} 
        ?>
		<div class="container py-3">
			<table id="category" class="display" style="width:100%">
				<thead>
					<tr>
						<th>NAMA</th>
						<th>EMAIL</th>
						<th>PHONE</th>
						<th>TERSEDIA</th>
						<th>AKTIF</th>
						<th>AKSI</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<div class="card-footer">
	</div>
</div>