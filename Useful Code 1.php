				<h4>Reports</h4>
				<div class="panel" style="padding: 20px;">
					<div class="table-responsive">
						<table class="table table-hover">
						<tr>
							<th>Borrower</th>
							<th>Address</th>
							<th>Equipment Borrowed</th>
							<th>Qty</th>
							<th>Transaction Date</th>
							<th>Price</th>
						</tr>
						<tr>
							<td><a href='#'>Joey Lorenzo</a></td>
							<td>Barotac Nuevo</td>
							<td>Photocopier Machine</td>
							<td>1</td>
							<td>3/21/2017</td>
							<td>500 Pesos</td>
						</tr>
						</table>
					</div>
					<p class="text-right" style="margin-top: 20px; margin-right: 10px;"><strong>Total Profit:</strong> 500 Pesos</p>
				</div>

					<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Add Inventory Item</h4>
	      	</div>
	      	<div class="modal-body">
		   	 	<form class="form-horizontal">
		   	 		<div class="form-group">
					    <label class="control-label col-sm-2" for="product">Product:</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="product" required placeholder="Enter Desired Product Name">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="quantity">Quantity:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="quantity" required placeholder="Enter the specified quantity of the said product">
					    </div>
					</div>
					<div class="form-group">
					    <label class="control-label col-sm-2" for="price">Price:</label>
					    <div class="col-sm-10">
					      <input type="number" class="form-control" id="price" required placeholder="Set the price of the product per item">
					    </div>
					</div>
		   	 	</form>
		    </div>
		    <div class="modal-footer">
		        <button class="btn btn-primary add">Add</button>
	        </div>
	    </div>
	  </div>
	</div>