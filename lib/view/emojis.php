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
				<tbody class="emoji-table">
					
				</tbody>
			</table>
			<script>
				jQuery(document).ready(function($){
					$('tr').each(function(){
						$(this).click(function (e) {
							$('.message_input').val($('.message_input').val() + ($(this).find('.code').text()));
						});
					});
					output = "";
					$.emotes.forEach(function(emote) {
						output += '<tr>' +
									'<td>' + emote.code + '</td>' +
									'<td>' + emote.url + '</td>' +
								'</tr>';
					}, this);

					$('.emoji-table').html(output);
				});
			</script>
		</div>
	</div>
</div>