<did class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-bell"></span> Earn Free Coins!</h3>
			</div>
			<p>You and your friend get 25 and 50 coins when you use the link bellow!</p>
			<label for="refcode">Choose Your Referal URL!</label>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon3">www.csgoaced.xyz/?r=</span>
				<input type="text" class="form-control ref_code" id="refcode" aria-describedby="basic-addon3" placeholder="<?php if (isset($_GET['c'])){ echo $_GET['c']; } ?>">
				<span class="input-group-btn"> <button class="btn btn-default refbtn" type="button" data-clipboard-target="#refcode"><span class="glyphicon glyphicon-copy"></span></button> </span>
			</div>
			<?php
				$sth = $conn->prepare("SELECT Count(*) AS IsRefered FROM ReferedUsersHistory WHERE ReferedUsersHistory.UserID = :UID;");
				$sth->execute(array(':UID' => $_SESSION['UID']));
				$UsedCode = $sth->fetchAll();

				if ($UsedCode[0]['IsRefered'] == 0){ ?>
					<br />
					<label for="referal">Please enter your referral code!</label>
					<div class="input-group">
						<input type="text" class="form-control" id="referal" placeholder="Referal">
							<span class="input-group-btn">
							<button class="btn btn-default submit-referal" type="button">Confirm!</button>
						</span>	
					</div>
					<script>
						$('.submit-referal').on('click', function () {
							var referal = $('#referal').val();

							if (referal.length == 0 || referal.length > 7){
								return $.SendAlert("Invalid Referal", "Please insert a valid referal code!");
							}

							$.confirm({
								title: '',
								content: 'url:index.php?p=referal&referal=' + referal + '&m=',
								columnClass: 'medium col-md-12',
								closeIcon: true,
								closeIconClass: 'fa fa-close',
								backgroundDismiss: true,
								buttons: {
									formSubmit: {
										text: 'Ok',
										btnClass: 'btn-green'
									}
								}
							});
						});
					</script>
				<?php }
			?>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-gift"></span> Users You Refered</h3>
			</div>
			<table class="table table-hover table-striped table-bordered fixed_headers">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Code</th>
						<th>Date</th>
						</tr>
					</thead>
				<tbody>
					<?php
						$sth = $conn->prepare("SELECT ReferedUsersHistory.ID AS ID, (SELECT Name FROM Users WHERE Users.ID = ReferedUsersHistory.UserID) AS Name, ReferedUsersHistory.ReferalCode AS Code, ReferedUsersHistory.RegistrationTimestamp AS Date FROM ReferedUsersHistory INNER JOIN Users ON ReferedUsersHistory.ReferalID = Users.ID AND Users.ID = :UID ORDER BY ReferedUsersHistory.ID;");
						$sth->execute(array(':UID' => $_SESSION['UID']));
						$referals = $sth->fetchAll();

						foreach ($referals as $refered) {
							?>
								<tr>
									<td><?php echo $refered['ID'];?></td>
									<td><?php echo $refered['Name'];?></td>
									<td><?php echo $refered['Code'];?></td>
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