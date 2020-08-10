layui.use('layer', function() {

	var layer = layui.layer;

})
const vm = new Vue({
	el: '#app',
	data: {
		submit_information: {},
		shipiao_goods: [{
			id: 1,
			img: 'img/works/shipao/mgoods_01.jpg',
			goods_name: '松针石瓢',
			artist_name: '曹志刚',
			slurry: '紫泥',
			title: '高工',
			capacity: '150cc-200cc'
		}, {
			id: 2,
			img: 'img/works/shipao/mgoods_02.jpg',
			goods_name: '福禄石瓢',
			artist_name: '程新凤',
			slurry: '底槽青 ',
			title: '国工',
			capacity: '200cc-250cc'
		}, {
			id: 3,
			img: 'img/works/shipao/mgoods_03.jpg',
			goods_name: '四方石瓢',
			artist_name: '杨军保',
			slurry: '段泥',
			title: '高工',
			capacity: '150cc以下'
		}, {
			id: 4,
			img: 'img/works/shipao/mgoods_04.jpg',
			goods_name: '子冶石瓢',
			artist_name: '吴文彩',
			slurry: '段泥',
			title: '高工',
			capacity: '150cc-200cc'
		}, {
			id: 5,
			img: 'img/works/shipao/mgoods_05.jpg',
			goods_name: '牛盖石瓢',
			artist_name: '吴文彩',
			slurry: '茄泥',
			title: '高工',
			capacity: '300cc-350cc'
		}, {
			id: 6,
			img: 'img/works/shipao/mgoods_06.jpg',
			goods_name: '大口石瓢',
			artist_name: '常月红',
			slurry: '大红袍',
			title: '高工',
			capacity: '150cc以下'
		}],
		xishi_goods: [{
			id: 1,
			img: 'img/works/xishi/mgoods_01.jpg',
			goods_name: '龙纹西施',
			artist_name: '王镇学',
			slurry: '大红袍 ',
			title: '高工',
			capacity: '300cc-350cc'
		}, {
			id: 2,
			img: 'img/works/xishi/mgoods_02.jpg',
			goods_name: '龙纹西施',
			artist_name: '周丽华',
			slurry: '大红袍 ',
			title: '国工',
			capacity: '200cc-250cc'
		}, {
			id: 3,
			img: 'img/works/xishi/mgoods_03.jpg',
			goods_name: '仙桃西施',
			artist_name: '吴文彩',
			slurry: '黑泥',
			title: '高工',
			capacity: '250cc-300cc'
		}, {
			id: 4,
			img: 'img/works/xishi/mgoods_04.jpg',
			goods_name: '牡丹西施',
			artist_name: '曹志刚',
			slurry: '黑泥',
			title: '高工',
			capacity: '200cc-250cc'
		}, {
			id: 5,
			img: 'img/works/xishi/mgoods_05.jpg',
			goods_name: '如意西施',
			artist_name: '曹志刚',
			slurry: '紫泥 ',
			title: '高工',
			capacity: '200cc-250cc'
		}, {
			id: 6,
			img: 'img/works/xishi/mgoods_06.jpg',
			goods_name: '扁西施',
			artist_name: '吴飞华',
			slurry: '紫泥',
			title: '高工',
			capacity: '250cc-300cc'
		}],
		fanggu_goods: [{
			id: 1,
			img: 'img/works/fanggu/mgoods_01.jpg',
			goods_name: '金莲仿古',
			artist_name: '李烈华',
			slurry: '黑泥 ',
			title: '高工',
			capacity: '200cc-250cc'
		}, {
			id: 2,
			img: 'img/works/fanggu/mgoods_02.jpg',
			goods_name: '仿古竹节',
			artist_name: '陈顺根',
			slurry: '绿泥  ',
			title: '国工',
			capacity: '200cc-250cc'
		}, {
			id: 3,
			img: 'img/works/fanggu/mgoods_03.jpg',
			goods_name: '仿古壶',
			artist_name: '蒋升',
			slurry: '玉砂',
			title: '高工',
			capacity: '300cc-350cc'
		}, {
			id: 4,
			img: 'img/works/fanggu/mgoods_04.jpg',
			goods_name: '仿古壶',
			artist_name: '戚志君',
			slurry: '紫泥',
			title: '高工',
			capacity: '200cc-250cc'
		}, {
			id: 5,
			img: 'img/works/fanggu/mgoods_05.jpg',
			goods_name: '仿古壶',
			artist_name: '许晓云',
			slurry: '紫泥 ',
			title: '高工',
			capacity: '300cc-350cc'
		}, {
			id: 6,
			img: 'img/works/fanggu/mgoods_06.jpg',
			goods_name: '经典仿古',
			artist_name: '李烈华',
			slurry: '大红袍',
			title: '高工',
			capacity: '150cc-200cc'
		}]

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
		inquiry(item, flag) {
			this.submit_information = item;
			$('#damand').text('咨询' + item.artist_name + '【' + item.goods_name + '】价格');
			console.log(item)
			if (flag == 1) {
				$('#damand').text('咨询' + item);
			}
			$('.footer-k,.foot-xunjia').show();

			$('.foot-xunjia').stop().animate({

				bottom: 0

			}, 200);

			$('#fbtn').hide();
			$('#xjTel').select();
		},
		onClickXunjia() {
			layer.load();

			telphone();

		},
		close() {
			$('.footer-k,.foot-xunjia').hide();

			$('#fbtn').show();
		},



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

function telphone() {

	const telphone = $("#xjTel").val();

	var regCode = /^1\d{10}$/;

	if (regCode.test(telphone) === false) {

		layer.close(layer.index);

		layer.msg('请输入您的手机号,手机号码不正确', {
			icon: 5,
			time: 1000
		})

		return false;

	} else {
		vm.close();
		const artist = vm.submit_information.artist_name || '';
		const goods = vm.submit_information.goods_name || '';
		const capacity = vm.submit_information.capacity || vm.submit_information;
		var demand = [artist, goods, capacity];
		console.log(demand)
		demand = JSON.stringify(demand)
		
		$.ajax({

			type: 'post',

			url: 'https://www.zishajyw.com/pot_add',

			data: {
				'telphone': telphone,
				'demand': demand
			},

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
				});

			}

		});

	}

}



