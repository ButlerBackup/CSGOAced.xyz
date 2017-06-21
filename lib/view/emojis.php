<did class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="page-header">
				<h3><i class="fa fa-smile-o fa-lg" aria-hidden="true"></i> Emojis!</h3>
			</div>
			<table class="table table-hover table-striped table-bordered fixed_headers">
				<thead>
					<tr>
						<th>Emoji</th>
						<th>Code</th>
						</tr>
					</thead>
				<tbody>
					<tr>
						<td><img src="https://www.csgoaced.xyz/img/emotes/aced.png"></td>
						<td class="code">:aced:</td>
					</tr>
					<tr>
						<td><img src="https://www.csgoaced.xyz/img/emotes/kappa.png"></td>
						<td class="code">:kappa:</td>
					</tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/rip.png"></td>
                        <td class="code">:rip:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/ezskins.png"></td>
                        <td class="code">:ezskins:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/hype.png"></td>
                        <td class="code">:hype:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/money.png"></td>
                        <td class="code">:money:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/snipe.png"></td>
                        <td class="code">:snipe:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/gg.png"></td>
                        <td class="code">:gg:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/gaben.png"></td>
                        <td class="code">:gaben:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/pigeon.png"></td>
                        <td class="code">:pigeon:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/trump.png"></td>
                        <td class="code">:trump:</td>
                    </tr>
					<tr>
                        <td><img src="https://www.csgoaced.xyz/img/emotes/wall.png"></td>
                        <td class="code">:wall:</td>
                    </tr>
				</tbody>
			</table>
			<script>
				jQuery(document).ready(function($){
					$('tr').each(function(){
						$(this).click(function (e) {
							$('.message_input').val($('.message_input').val() + ($(this).find('.code').text()));
						});
					});
				});
			</script>
		</div>
	</div>
</div>