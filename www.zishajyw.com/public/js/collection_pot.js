Vue.use(VueLazyload, {
	preLoad: 1.3,
	error: 'img/pot/pseudo_graph.jpg',
	loading: 'img/pot/pseudo_graph.jpg',
	attempt: 1
})

const vm = new Vue({
	el: '#app',
	data: {
		goods_name: '',
		goods_index: 0,
		collection_goods: [{
			img: 'img/collection/mgoods_01.jpg',
			goods_name: '伏羲',
			artist_name: '顾冶培',
			slurry: '紫泥',
			title: '高工',
			capacity: '500cc'

		}, {

			img: 'img/collection/mgoods_02.jpg',
			goods_name: '石瓢',
			artist_name: '李昌鸿',
			slurry: '拼紫泥',
			title: '高工',
			capacity: '280cc上'

		}, {
			img: 'img/collection/mgoods_03.jpg',
			goods_name: '浩然正气',
			artist_name: '季益顺',
			slurry: '绿泥',
			title: '高工',
			capacity: '300cc'

		}, {
			img: 'img/collection/mgoods_04.jpg',
			goods_name: '玉兰富贵',
			artist_name: '季益顺',
			slurry: '底槽青',
			title: '高工',
			capacity: '385cc'

		}],





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
		inquiry(name, flag) {
			$('#damand').text('咨询【' + name + '】价格');
			this.goods_name = name;
			if (flag == 1) {
				$('#damand').text('咨询' + name);
			}
			$('.footer-k,.foot-xunjia').show();

			$('.foot-xunjia').stop().animate({

				bottom: 0

			}, 200);

			$('#fbtn').hide();
		},
		onClickXunjia() {
			layer.load();

			telphone2();

		},
		close() {
			$('.footer-k,.foot-xunjia').hide();
			$('#fbtn').show();
		}


	},
	created() {

	},
	mounted() {
		this.lazyload();
	},


})

layui.use('layer', function() {

	var layer = layui.layer;

})

function telphone2() {

	const telphone = $("#xjTel").val();

	var regCode = /^1\d{10}$/;

	if (regCode.test(telphone) == false) {

		layer.close(layer.index);

		layer.msg('请输入您的手机号,手机号码不正确', {
			icon: 5,
			time: 1000
		})

		return false;

	} else {
		vm.close();

		var demand = [];
		demand.push($('#damand').text().trim());
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



$(function() {



})
