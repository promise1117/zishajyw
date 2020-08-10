layui.use('layer', function() {

	var layer = layui.layer;

})
const vm = new Vue({
	el: '#app',
	data: {


	},
	methods: {
		lazyload() {
			$(".lazy").lazyload({
				threshold: 200, //设置临界点
				effect: "fadeIn", //使用特效
				failure_limit: 20, //当图片不连续时,通过 failurelimit 选项来控制加载行为.
				skip_invisible: false //加载隐藏图片
			});
		},
		submit() {
			telphone2()
		}



	},
	created() {

	},
	mounted() {
		this.lazyload();
	}

});
layui.use('layer', function() {

	var layer = layui.layer;

})

function telphone2() {

	const name = $("#name").val();
	const telphone = $("#tel").val();
	const regCode = /^1\d{10}$/;

	if (name == "") {

		layer.close(layer.index);

		layer.msg('请输入您的名字', {
			icon: 5,
			time: 1000
		})

		return false;
	} else if (regCode.test(telphone) === false) {

		layer.close(layer.index);

		layer.msg('请输入您的手机号,手机号码不正确', {
			icon: 5,
			time: 1000
		})


		return false;

	} else {

		var demand = [];
		demand.push($('#name').val());
		demand.push($('#tel').val());
		demand = JSON.stringify(demand)
		console.log(demand)

		$.ajax({

			type: 'post',

			url: 'https://www.zishajyw.com/pot_add',

			data: {
				'telphone': telphone,
				'demand': demand
			},

			dataType: 'json', //跨域请求

			success: function(data) {

				layer.msg('提交成功', {
					icon: 6,
					time: 2000
				})

			},

			error: function() {

				layer.close(layer.index);

				layer.msg('提交成功', {
					icon: 6,
					time: 2000
				})

			}

		})

	}

}
