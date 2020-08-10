let moneyVal = '1500减300';
let flag = null;

let locations = JSON.parse(localStorage.getItem('location')) || [];
for (let s of locations) {
	if (s !== location.href) {
		localStorage.setItem('flag', JSON.stringify(false));

		console.log(s)
	}
}
			
if (localStorage.getItem("flag") !== null) {
	flag = JSON.parse(localStorage.getItem('flag'));
} else {
	localStorage.setItem('flag', JSON.stringify(false));
}
console.log(flag)

function again() {
	$('#title_h').text('输入手机号码获得额外一次抽奖机会');
	$('#lingjiang').hide();
	$('#again').show();
	$('#tel').val('请输入您的手机号码领取');
	showPrize();
}

$(function() {
	var $plateBtn = $('#plateBtn');
	var $result = $('#result');
	var $resultTxt = $('#resultTxt');
	var $resultBtn = $('#resultBtn');

	$plateBtn.click(function() {
		var data = [0, 1, 2, 3, 4, 5, 6];
		data = data[Math.floor(Math.random() * data.length)];
		console.log(data)
		if (flag) {
			again();
			return false;
		}
		switch (data) {
			case 1:
				moneyVal = '公道杯';
				rotateFunc(1, 102, '恭喜你中了九折 <em ><a href="javascript:void(0)" onclick="showPrize()">点击领取</a></em>');
				break;
			case 2:
				moneyVal = '谢谢参与';
				rotateFunc(2, 153, '恭喜你中了六折 <em><a href="javascript:void(0)" onclick="showPrize()">点击领取</a></em>');
				break;
			case 3:
				moneyVal = '1000减100';
				rotateFunc(3, 204, '恭喜你中了八折 <em><a href="javascript:void(0)" onclick="showPrize()">点击领取</a></em>');
				break;
			case 4:
				moneyVal = '建盏';
				rotateFunc(4, 255, '<em>好运连连--加油！！看好你哦</em>');
				break;
			case 5:
				moneyVal = '1000减200';
				rotateFunc(5, 306, '恭喜你中了100 <em><a href="javascript:void(0)" onclick="showPrize()">点击领取</a></em>');
				break;
			case 6:
				moneyVal = '折扣8折';
				rotateFunc(5, 357, '恭喜你中了100 <em><a href="javascript:void(0)" onclick="showPrize()">点击领取</a></em>');
				break;

			default:
				rotateFunc(0, 51, '恭喜你中了七折 <em><a href="javascript:void(0)" onclick="showPrize()">点击领取</a></em>');
		}
	});

	var rotateFunc = function(awards, angle, text) { //awards:奖项，angle:奖项对应的角度
		flag = true;
		localStorage.setItem('flag', JSON.stringify(true));
		console.log(locations)
			for (let s of locations) {
				//该元素在locations内部不存在并且不为空才允许追加
				if ((s.indexOf(location.href) == -1) && (location.href != '')) {
					locations.push(location.href);
					localStorage.setItem('location', JSON.stringify(locations));
				}
			}


		$plateBtn.stopRotate();
		$plateBtn.rotate({
			angle: 0,
			duration: 5000,
			animateTo: angle + 1440, //angle是图片上各奖项对应的角度，1440是让指针固定旋转4圈
			callback: function() {
				$resultTxt.html(text);
				//$result.show();
				if (moneyVal === '谢谢参与') {
					// again();
					alert(moneyVal);
				} else {
					$('#title_h').text('恭喜你获得【' + moneyVal + '】');
					showPrize();
				}
			}
		});
	};

	$resultBtn.click(function() {
		$result.hide();
	});
});

function lingjiang() {
	var telVal = $('#tel').val();
	var regCode = /^1\d{10}$/;

	if (regCode.test(telVal) === false) {
		alert('请输入正确的手机号码');
		return false;

	}

	let demand = ['抽奖优惠', moneyVal];
	demand = JSON.stringify(demand)
	console.log(demand)
	$.post("https://www.zishajyw.com/pot_add", {
			'telphone': telVal,
			'demand': demand
		},
		function(data) {
			console.log('领取成功')
			//alert(data);
			if (data.code == 0) {
				alert(data);

			} else {
				alert('领取成功');
				//                                window.location.reload();
			}
		}, "json");
	alert('领取成功');
	closePrize();

}

function againlingjiang() {
	var telVal = $('#tel').val();
	var regCode = /^1\d{10}$/;

	if (regCode.test(telVal) === false) {
		alert('请输入正确的手机号码');
		return false;

	}
	console.log(typeof telVal, telVal)
	console.log(typeof localStorage.getItem("tel"), localStorage.getItem("tel"))

	if (telVal === localStorage.getItem("tel")) {
		alert('请输入新的手机号码');
		return false;

	}

	let demand = ['领取抽奖'];
	demand = JSON.stringify(demand)
	console.log(demand)
	$.post("https://www.zishajyw.com/pot_add", {
			'telphone': telVal,
			'demand': demand
		},
		function(data) {
			console.log('领取成功')
			//alert(data);
			if (data.code == 0) {
				alert(data);

			} else {
				alert('领取成功');
				//                                window.location.reload();
			}
		}, "json");
	alert('领取成功');
	closePrize();

	localStorage.setItem('tel', telVal);
	flag = false;
	$('#lingjiang').show();
	$('#again').hide();
	$('#tel').val('请输入您的手机号码领取');
}

function closeRule() {
	var ruleDiv = document.getElementById('rule');
	ruleDiv.style.display = 'none';
	var ruleDiv = document.getElementById('mask_rule');
	ruleDiv.style.display = 'none';
}

function showRule() {
	var ruleDiv = document.getElementById('rule');
	ruleDiv.style.display = 'block';
	var ruleDiv = document.getElementById('mask_rule');
	ruleDiv.style.display = 'block';
}

function closeWin() {
	var winDiv = document.getElementById('win');
	winDiv.style.display = 'none';
	var winDiv = document.getElementById('mask_win');
	winDiv.style.display = 'none';
}

function showWin() {
	var winDiv = document.getElementById('win');
	winDiv.style.display = 'block';
	var winDiv = document.getElementById('mask_win');
	winDiv.style.display = 'block';

	$('#zhongjiangmingdan').html('');
	$.ajax({
		type: 'get',
		url: 'http://www.rongtoujinrong.com/api/record2.php',
		//                    data:{},
		dataType: 'json',
		success: function(data) {
			if (data.code == 1) {
				var arr = data.data;
				for (var i = 0; i < arr.length; i++) {
					$('#zhongjiangmingdan').append(arr[i] + '<br/>');
				}

			}
		},
		error: function() {}
	});

}

function closePrize() {
	var awardsDiv = document.getElementById('awards');
	awardsDiv.style.display = 'none';
	var awardsDiv = document.getElementById('mask_awards');
	awardsDiv.style.display = 'none';
}

function showPrize() {
	var awardsDiv = document.getElementById('awards');
	awardsDiv.style.display = 'block';
	var awardsDiv = document.getElementById('mask_awards');
	awardsDiv.style.display = 'block';
}

function closeShare() {
	var shareDiv = document.getElementById('share');
	shareDiv.style.display = 'none';
	var shareDiv = document.getElementById('mask_share');
	shareDiv.style.display = 'none';
}

function showShare() {
	var shareDiv = document.getElementById('share');
	shareDiv.style.display = 'block';
	var shareDiv = document.getElementById('mask_share');
	shareDiv.style.display = 'block';
}
