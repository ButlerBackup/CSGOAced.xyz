<did class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-4">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-transfer"> Your Trade URL</h3>
			</div>
			<form action="" class="formName">
				<div class="form-group">
					<label>Enter Your <a href="http://steamcommunity.com/profiles/76561198391711336/tradeoffers/privacy#trade_offer_access_url" target="_blank">Trade URL</a></label>
					<input type="text" placeholder="Your Trade URl" class="trade_url form-control" required />
				</div>
			</form>
		</div>
		<div class="col-xs-12 col-sm-8">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-random"> Your Trade History</h3>
			</div>
			<table class="table table-hover table-striped table-bordered fixed_headers">
				<thead>
					<tr>
						<th>ID</th>
						<th>Skin</th>
						<th>Type</th>
						<th>Ammount</th>
						<th>Status</th>
						<th>Date</th>
						</tr>
					</thead>
				<tbody>
					<?php
						$sth = $conn->prepare("SELECT Transactions.ID AS ID, TransactionItems.SkinMarketName AS Name, Transactions.Type AS Type, TransactionItems.Coins AS Ammount, TransactionState.Name AS Status, Transactions.OfferTimestamp AS Date FROM TransactionItems INNER JOIN Transactions INNER JOIN Users INNER JOIN TransactionState ON Users.ID = Transactions.UID AND TransactionItems.TransactionID = Transactions.ID AND Transactions.Status = TransactionState.ID ORDER BY Transactions.OfferTimestamp DESC;");
						$sth->execute(array(':UID' => $_SESSION['UID']));
						$referals = $sth->fetchAll();

						foreach ($referals as $refered) {
							?>
								<tr>
									<td><?php echo $refered['ID'];?></td>
									<td><?php echo $refered['Name'];?></td>
									<td><?php echo $refered['Type'];?></td>
									<td><?php echo $refered['Ammount'];?></td>
									<td><?php echo $refered['Status'];?></td>
									<td><?php echo $refered['Date'];?></td>
								</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>