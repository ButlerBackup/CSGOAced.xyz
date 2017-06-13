<did class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-bell"> Earn Free Coins!</h3>
			</div>
            <p>You and your friend get 25 and 50 coins when you use the link bellow!</p>
			<label for="refcode">Choose Your Referal URL!</label>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon3">www.csgoaced.xyz/?r=</span>
                <input type="text" class="form-control ref_code" id="refcode" aria-describedby="basic-addon3" placeholder="<?php if (isset($_GET['c'])){ echo $_GET['c']; } ?>">
                <span class="input-group-btn"> <button class="btn btn-default refbtn" type="button" data-clipboard-target="#refcode"><span class="glyphicon glyphicon-copy"></span></button> </span>
            </div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="page-header">
				<h3><span class="glyphicon glyphicon-gift"> Your Refered Users</h3>
			</div>
		</div>
	</div>
</div>