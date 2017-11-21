<h3>Чат</h3>
	<form name="chatform" action="/world/chat/message" method="post">
		<div class="row">
			<div class="col-sm-10">
				<input class="form-control form-control-sm" type="text" placeholder="Сообщение" name="ChatForm[message]" id="chat-message" autocomplete="off" value="" maxlength="160">
			</div>
			<div class="col-sm-2">
				<button class="btn btn-outline-success btn-sm btn-block say-btn" type="submit">Сказать</button>
			</div>
		</div>
	</form>
<br>
<div class="row">
	<div class="col-sm-6">
		<p>Использовано <strong id="chat-counter">0</strong> из <strong>160</strong></p>
	</div>
	<div class="col-sm-6">
		<p class="text-right"><a href="#" id="open-chat-online"><strong>0</strong> игроков в чате</a></p>
	</div>
</div>
<div id="chat-error" role="alert" class="alert alert-danger alert-dismissible fade show" style="display: none;" title="Уведомление">
</div>
<div class="row">
	<div class="col-sm-12 chat-online" id="chat-online" style="display: none;">
		<small><a href="/player/look/player/id/1">Gsom <img src="/assets/img/lvl16.png" title="уровень"> <strong>10</strong></a></small>
	</div>
</div>
<hr>

<script>
	$('#open-chat-online').click(function() {
		$('#chat-online').slideToggle();
	});
	var currentChatMessage = '';
	$('#chat-message').focus(function() {
		if ($(this).val() == currentChatMessage) {
			$(this).val('');
		}
	}).keyup(function() {
		var length = $(this).val().length;
		$('#chat-counter').text(length);
			if (length > 160) {
			$('#chat-counter').css('color', 'red');
		} else {
			$('#chat-counter').css('color', 'black');
		}
	});

	$('form[name="chatform"]').submit(function() {
		if ($('#chat-message').val().length > 160) {
			$('#chat-error').html("<br /><p class='center'>Сообщение <b>слишком</b> длинное.</p><p class='center'>Не более <b>166</b> символов.</p>");
			return false;
		}
		if ($('#chat-message').val() == currentChatMessage) {
			$('#chat-error').html("<br /><p class='center'>Ничего нового...</p><p class='center'>Не повторяйтесь!</p>");
			return false;
		}
		currentChatMessage = $('#chat-message').val();
		var form = $(this);
		$.ajax({
			type: 'post',
			url: form.attr('action'),
			dataType: 'json',
			data: form.serialize(),
			success: function(data){
				/*updateMessages(data, true);*/
				$('#chat-message').val('');
			}
		});
		return false;
	});
</script>
