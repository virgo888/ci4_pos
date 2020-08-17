<div class="card mt-3">
	<div class="card-header">
		<h4>Data Category</h4>
	</div>
	<div class="card-body">
		<div class="container py-3">
			<table id="category" class="display" style="width:100%">
				<thead>
					<tr>
						<th>PARENT KATEGORI</th>
						<th>NAMA KATEGORI</th>
						<th>ALIAS</th>
						<th>ENABLE</th>
						<th>AKTIF</th>
						<th>AKSI</th>
					</tr>
				</thead>
			</table>

			<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModal" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">New message</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form>
								<div class="form-group">
									<label for="recipient-name" class="col-form-label">Recipient:</label>
									<input type="text" class="form-control" id="recipient-name">
								</div>
								<div class="form-group">
									<label for="message-text" class="col-form-label">Message:</label>
									<textarea class="form-control" id="message-text"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Send message</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer">
	</div>
</div>