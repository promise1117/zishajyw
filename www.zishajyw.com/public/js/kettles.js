const imgsMobile = [
	[{
		src: '01/0.jpg'
	},{
		src: '01/01.jpg'
	}, {
		src: '01/02.jpg'
	}, {
		src: '01/03.jpg'
	}, {
		src: '02/04.jpg'
	}],
	[ {
		src: '02/0.jpg'
	},{
		src: '02/01.jpg'
	}, {
		src: '02/02.jpg'
	}, {
		src: '02/03.jpg'
	}, {
		src: '02/04.jpg'
	}],
	[{
		src: '03/0.jpg'
	},{
		src: '03/01.jpg'
	}, {
		src: '03/02.jpg'
	}, {
		src: '03/03.jpg'
	}, {
		src: '03/04.jpg'
	}],
	[{
		src: '04/0.jpg'
	}, {
		src: '04/01.jpg'
	}, {
		src: '04/02.jpg'
	}, {
		src: '04/03.jpg'
	}, {
		src: '04/04.jpg'
	}],
	[{
		src: '05/0.jpg'
	}, {
		src: '05/01.jpg'
	}, {
		src: '05/02.jpg'
	}, {
		src: '05/03.jpg'
	}, {
		src: '05/04.jpg'
	}],
		[{
		src: '06/0.jpg'
	}, {
		src: '06/01.jpg'
	}, {
		src: '06/02.jpg'
	}, {
		src: '06/03.jpg'
	}, {
		src: '06/04.jpg'
	}],
	[{
		src: '07/01.jpg'
	}, {
		src: '07/02.jpg'
	}, {
		src: '07/03.jpg'
	}, {
		src: '07/04.jpg'
	},{
		src: '07/05.jpg'
	}],
	[{
		src: '08/0.jpg'
	}, {
		src: '08/01.jpg'
	}, {
		src: '08/02.jpg'
	}, {
		src: '08/03.jpg'
	}, {
		src: '08/04.jpg'
	}, {
		src: '08/05.jpg'
	}]
];

// 预加载
const images = [];
function preload(para) {
	for (i = 0; i < para.length; i++) {
		images[i] = new Image();
		images[i].src = 'img/kettles/details/' + para[i].src;
	}
}

preload(imgsMobile[0]);

const vm = new Vue({
	el: '#app',
	data: {
		paly: false,
		company: '',
		submit_information: {},
		goods: [{
			id: 1,
			img: 'img/kettles/goods_24.jpg',
			goods_name: '汉扁',
			artist_name: '杨卫刚',
			slurry: '老紫泥',
			title: '高工',
			capacity: '260cc'

		}, {
			id: 2,
			img: 'img/kettles/goods_22.jpg',
			goods_name: '掇樂',
			artist_name: '陈顺根',
			slurry: '紫泥',
			title: '高工',
			capacity: '250cc-300cc'

		}, {
			id: 3,
			img: 'img/kettles/goods_31.jpg',
			goods_name: '六方仿古',
			artist_name: '刘浩',
			slurry: '嫩紫泥',
			title: '国工',
			capacity: '260cc'

		}, {
			id: 4,
			img: 'img/kettles/goods_33.jpg',
			goods_name: '鱼乐壶',
			artist_name: '蒋惠娟',
			slurry: '底槽青',
			title: '高工',
			capacity: '360cc'

		}, {
			id: 5,
			img: 'img/kettles/goods_05.jpg',
			goods_name: '鸿运-龟龍',
			artist_name: '许良平',
			slurry: '紫泥',
			title: '高工',
			capacity: '160cc'

		}, {
			id: 6,
			img: 'img/kettles/goods_06.jpg',
			goods_name: '鸟语花香',
			artist_name: '周丽华',
			slurry: '老紫泥',
			title: '国工',
			capacity: '300cc'

		}, {
			id: 7,
			img: 'img/kettles/goods_07.jpg',
			goods_name: '西施',
			artist_name: '周洪明',
			slurry: '大红袍',
			title: '国工',
			capacity: '300cc'

		}, {
			id: 8,
			img: 'img/kettles/goods_08.jpg',
			goods_name: '一品竹段',
			artist_name: '范永芳',
			slurry: '老紫泥',
			title: '国工',
			capacity: '300cc'

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

			telphone2();

		},
		close() {
			$('.footer-k,.foot-xunjia').hide();

			$('#fbtn').show();
		},
		details(index) {
			$('.pswp__scroll-wrap').show();
			let tupian = "";
			for (let i of imgsMobile[index]) {
				tupian += '<div class="swiper-slide"> <img src = "img/kettles/details/' + i.src + '" ></div>';
			}
			$("#swiper .swiper-wrapper").html(tupian);
			$('.total').text($('.pswp_img .swiper-slide').length);

			var swiper = new Swiper('#swiper .swiper-container', {
				effect: 'slide', //滑动效果
				touchAngle: 30, //滑动的角度超过30度无效
				// 轮播图的方向，也可以是vertical方向
				direction: 'horizontal',
				//环形切换关闭
				loop: true,
				// 切换的速度
				speed: 800, //滑动或者自动换页时的速度
				// 这样，即使我们滑动之后， 定时器也不会被清除
				autoplayDisableOnInteraction: true,
				observer: true, //修改swiper自己或子元素时，自动初始化swiper
				observeParents: true, //修改swiper的父元素时，自动初始化swiper
				on: {
					slideChange: function() {
						// 获取当前活动下标
						var active_index = this.realIndex;
						$('.realIndex').text(active_index + 1);
					}
				}
			});


		}
	},
	created() {
		this.company = {
			'zsh.yuhao02.cn': '郑州码卓信息科技有限公司',
			'zsh.9daymall.cn': '宜宾惠人电子商务有限公司',
			'zsh.ltshe.cn': '重庆乐图社文化传播有限公司'
		} [document.domain];
		
	},
	mounted() {
		this.lazyload();
		$('.pswp__scroll-wrap').click(function(event) {
			if (event.target == this) {
				$(this).hide();
			}
		});
		$('#pswp_img').click(function(event) {
			event.stopPropagation();
		});
	}

});
layui.use('layer', function() {

	var layer = layui.layer;

});

function telphone2() {

	const telphone = $("#xjTel").val();

	var regCode = /^1\d{10}$/;

	if (regCode.test(telphone) === false) {

		layer.close(layer.index);

		layer.msg('请输入您的手机号,手机号码不正确', {
			icon: 5,
			time: 1000
		});

		return false;

	} else {
		vm.close();

		const artist = vm.submit_information.artist_name || '';
		const goods = vm.submit_information.goods_name || '';
		const capacity = vm.submit_information.capacity || vm.submit_information;
		let demand = [artist, goods, capacity];
		demand = JSON.stringify(demand);

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
				});

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

