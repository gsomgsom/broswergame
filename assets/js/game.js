$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

var date = new Date();
timer_correction = current_time - parseInt(Math.round(date.getTime()/1000));

// ServerTime
function serverTimeUpdate() {
	var date = new Date();
	var time = (Math.round(date.getTime()/1000) - day_time) + timer_correction;
	if (time >= 86400) {
		time = time % 86400;
	}

	hours = Math.floor(time / 3600);
	time -= hours * 3600;
	minutes = Math.floor(time / 60);
	time -= minutes * 60;
	seconds = time;

	if (hours < 10) {
		hours = '0' + hours;
	}
	if (hours == 24) {
		hours = '00';
	}
	if (minutes < 10) {
		minutes = '0' + minutes;
	}
	if (seconds < 10) {
		seconds = '0' + seconds;
	}

	$('.server-time').html(hours + ':' + minutes + ':' + seconds);
	setTimeout(serverTimeUpdate, 1000);
}
serverTimeUpdate();

// bTimer
var globalTitle = '';
var timerList = [];
var timerRedirect = false;
mailWorkRequest = 'timerTick';

function timerTick() {
	timerList.forEach(function(timer, index){
		timer.updateTimer();
	})
	setTimeout("timerTick()", 1000);
}
timerTick()

var functionUpdateOneTimer = function(){
	if (this.hasOwnProperty('time') && this.hasOwnProperty('id') && (!this.hasOwnProperty('expired') || this.expired == false)) {
		var time = this.time,
			callback = this.callback;

		var date = new Date();
		var currentTime = Math.round(date.getTime()/1000) + timer_correction;
		var counter = $(this.id);

		var timeLeft = this.time - currentTime;

		time -= currentTime;
		if (time <= 0) {
			if (!this.expired) {
				if (this.expireText && this.expireText != '') {
					counter.html(this.expireText).addClass('expired');
					counter.parent().find('.i_clock').remove();
				} else {
					if (this.format == "dhm"){
						counter.html('00дн 00:00:00').addClass('expired');
					} else if (this.format == "hm"){
						counter.html('00:00:00').addClass('expired');
					} else if (this.format == "m"){
						counter.html('00:00').addClass('expired');
					}
				}

				if (typeof callback == "function") {
					callback();
				}

				this.expired = true;
			}
		} else {
			if (this.format == "dhm"){
				var days = Math.floor(time / 86400);
				time -= days * 86400;
				if (days < 10) {
					days = '0' + days;
				}
				var hours = Math.floor(time / 3600);
				time -= hours * 3600;
				if (hours < 10) {
					hours = '0' + hours;
				}
			}
			if (this.format == "hm"){
				var hours = Math.floor(time / 3600);
				time -= hours * 3600;
				if (hours < 10) {
					hours = '0' + hours;
				}
			}
			var minutes = Math.floor(time / 60);
			time -= minutes * 60;
			if (minutes < 10) {
				minutes = '0' + minutes;
			}
			if (time < 10) {
				time = '0' + time;
			}
			if (this.format == "dhm"){
				counter.html(days + ' дн ' + hours + ':' + minutes + ':' + time);
			}
			if (this.format == "hm"){
				counter.html(hours + ':' + minutes + ':' + time);
			}
			if (this.format == "m"){
				counter.html(minutes + ':' + time);
			}
			if (this.format == "s"){
				counter.html(time);
			}
		}
		if (this.global && this.global != '') {
			if (globalTitle == '') {
				globalTitle = $('title').text();
			}
			$('title').text('|' + counter.html() + '| ' + globalTitle);
		} else {
			this.global = '';
		}
		if (!this.expireText || this.expireText == ''){
			this.expireText = '';
		}
		if (!timerRedirect && timeLeft <= 0 && this.location != "none") {
			timerRedirect = true;
			setTimeout("window.location = this.location", 2000);
		}
	}
}

function bTimer(id, time, format, location, global, expireText, callback) {
	var timer = {
		id: id,
		time: time,
		format: format,
		location: location,
		global: global,
		expireText: expireText,
		callback: callback,
		expired: false
	};
	timer.updateTimer = functionUpdateOneTimer;
	timerList.push(timer);


	timer.updateTimer();
}

function removeTimer(id) {
	for (var key in timerList) {
		if (timerList[key].id == id) {
			timerList.splice(key, 1);
		}
	}
}

function bTimerBlink(id){
var tagStyle = $(id).css('visibility');
if (tagStyle == 'hidden') {
	$(id).css('visibility', 'visible');
} else {
	$(id).css('visibility', 'hidden');
}
setTimeout("bTimerBlink('" + id + "')", 500);
}
