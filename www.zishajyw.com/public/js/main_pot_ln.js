// 产品细节图片
const imgsMobile = [
	[{
		src: '01/0.jpg'
	},{
		src: '01/01.jpg'
	}, {
		src: '01/02.jpg'
	}],
	[{
		src: '02/0.jpg'
	},{
		src: '02/01.jpg'
	}, {
		src: '02/02.jpg'
	}],
	[{
		src: '03/0.jpg'
	},{
		src: '03/01.jpg'
	}, {
		src: '03/02.jpg'
	}],
	[{
		src: '04/0.jpg'
	}, {
		src: '04/01.jpg'
	}, {
		src: '04/02.jpg'
	}]
];

const imgsMobile2 = [
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
	}, {
		src: '03/05.jpg'
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
	}, {
		src: '05/05.jpg'
	}, {
		src: '05/06.jpg'
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
	}, {
		src: '06/05.jpg'
	}],
	[{
		src: '07/0.jpg'
	},{
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
		images[i].src = 'img/product/details/special/' + para[i].src;
	}
}

preload(imgsMobile[0]);

Vue.use(VueLazyload, {
	preLoad: 1.3,
	error: 'img/pot/pseudo_graph.jpg',
	loading: 'img/pot/pseudo_graph.jpg',
	attempt: 1
});

const vm = new Vue({
	el: '#app',
	data: {
		submit_information: {},
		goods_index: 0,

		list: [{
			img: 'img/product/goods_01.jpg',
			goods_name: '鱼化龙',
			artist_name: '储立强',
			slurry: '大红袍',
			capacity: '150cc',
			title: '国工',
			original_price: '3288',
			current_price: '???'
		}, {
			img: 'img/product/goods_02.jpg',
			goods_name: '西施',
			artist_name: '范菊英',
			slurry: '小红泥',
			capacity: '240cc',
			title: '国工',
			original_price: '3288',
			current_price: '???'
		}, {
			img: 'img/product/goods_03.jpg',
			goods_name: '子冶石瓢',
			artist_name: '范育君',
			slurry: '紫泥',
			capacity: '240cc',
			title: '国工',
			original_price: '2688',
			current_price: '???'
		}, {
			img: 'img/product/goods_04.jpg',
			goods_name: '竹节德钟',
			artist_name: '戚志君',
			slurry: '老紫泥',
			capacity: '230cc',
			title: '国工',
			original_price: '2988',
			current_price: '???'
		}],

		list_goods: [{
			img: 'img/product/mgoods_01.jpg',
			goods_name: '香凌壶',
			artist_name: '李洪明',
			slurry: '清水泥',
			title: '高工',
			capacity: '300cc'
		}, {
			img: 'img/product/mgoods_02.jpg',
			goods_name: '西施',
			artist_name: '周丽华',
			slurry: '大红袍',
			title: '国工',
			capacity: '220cc'
		}, {
			img: 'img/product/mgoods_03.jpg',
			goods_name: '石瓢壶',
			artist_name: '许敏芳',
			slurry: '朱泥',
			title: '高工',
			capacity: '300cc'
		}, {
			img: 'img/product/mgoods_04.jpg',
			goods_name: '四方德钟',
			artist_name: '蒋建军',
			slurry: '黑泥',
			title: '高工',
			capacity: '350cc'
		}, {
			img: 'img/product/mgoods_05.jpg',
			goods_name: '云龙',
			artist_name: '许良平',
			slurry: '朱泥',
			title: '高工',
			capacity: '300cc'
		}, {
			img: 'img/product/mgoods_06.jpg',
			goods_name: '锦纹传炉',
			artist_name: '李洪明',
			slurry: '红皮龙',
			title: '高工',
			capacity: '400cc'
		}, {
			img: 'img/product/mgoods_07.jpg',
			goods_name: '井栏壶',
			artist_name: '许敏芳',
			slurry: '紫泥',
			title: '高工',
			capacity: '320cc'
		}, {
			img: 'img/product/mgoods_08.jpg',
			goods_name: '繁花似锦',
			artist_name: '张伟军',
			slurry: '大红袍',
			title: '高工',
			capacity: '340cc'
		}],
		artist:[
			{
				id:1,
				name: '顾绍培',
				img:'img/product/artist_01.jpg',
				title: '研究员级高级工艺美术师'
			},
			{
				id:2,
				name: '程辉',
				img:'img/product/artist_02.jpg',
				title: '研究员级高级工艺美术师'
			},
			{
				id:3,
				name: '季益顺',
				img:'img/product/artist_03.jpg',
				title: '研究员级高级工艺美术师'
			},
			{
				id:4,
				name: '李昌鸿',
				img:'img/product/artist_04.jpg',
				title: '研究员级高级工艺美术师'
			}
		],
		artist_list: [
			[{
				id: 0,
				name: '顾绍培',
				img: 'img/product/artist1.png',
				title: '研究员级高级工艺美术师',
				goods_list: [{
					goods_name: '高旦圆壶',
					artist_name: '顾绍培',
					goods_img: 'img/product/artist1_001.jpg',
					slurry: '紫泥',
					title: '研高',
					capacity: '200cc-250cc'
				}],
				synopses: '非物质文化遗产传承人 中国工艺美术大师 研究员级高级工艺美术师 中国工艺美术学会会员 中国陶瓷协会会员 中国工业设计协会会员 1945年出生于陶艺世家，1958年进宜兴陶瓷中学读书学艺，启蒙老师是潘春芳教授，转入紫砂工艺厂后，师承著名老艺人陈福渊，后得当代壶艺泰斗顾景舟悉心提携。从事紫砂已50载，深研诸名师技法，集各派之精华，融艺术个性于一体。创作新品100余个，曾获德国莱比锡国际博览会金奖；中国工艺美术品百花金杯奖；首届中国工艺美术华艺杯金奖；'
			}, {
				id: 1,
				name: '程辉',
				img: 'img/product/artist2.png',
				title: '研究员级高级工艺美术师',
				goods_list: [{
					goods_name: '亚明四方',
					artist_name: '程辉',
					goods_img: 'img/product/artist2_001.jpg',
					slurry: '紫泥',
					title: '研高',
					capacity: '250cc-300cc'
				}],
				synopses: '程辉   紫砂艺术大师、江苏省工艺美术大师、研究员级高级工艺美术师，中国工艺美术学会会员、中国宜兴紫砂行业协会副秘书长、江苏省宜兴紫砂收藏鉴赏专业委员会秘书长、宜兴方井紫砂艺术总监、哈尔滨工业大学兼职教授、紫砂非物质文化遗产代表性传承人。国家标准《紫砂陶器》（GB/T1989)起草人、《宜兴紫砂泥料标准》制定专家组组长。字润年，斋号守愚斋，1944年生于江苏宜兴陶瓷世家，自1958年进入宜兴紫砂工艺厂，师从一代宗师吴云根先生学习紫砂成型艺术，练就扎实的制壶功底，年轻时期在紫砂界就出类拔萃'
			}, {
				id: 2,
				name: '季益顺',
				img: 'img/product/artist3.png',
				title: '研究员级高级工艺美术师',
				goods_list: [{
					goods_name: '浩然正气',
					artist_name: '季益顺',
					goods_img: 'img/product/artist3_001.jpg',
					slurry: '绿泥',
					title: '研高',
					capacity: '250cc-300cc'
				}],
				synopses: '季益顺，1960年出生于江苏宜兴。中国工艺美术大师，中国陶瓷艺术大师，研究员级高级工艺美术师，中国工艺美术学会会员，紫砂行业协会壶艺专业委员主任，收藏监赏委员会主任。 　国际、国内权威性艺术展评多次金奖获得者。紫砂艺术承前启后的扛鼎人物。现宜兴方圆紫砂工艺有限公司供职。 　1960年生于陶都宜兴陶瓷世家，自幼生活在陶瓷世界之中，紫砂陶的高雅艺术熏陶着他的童年，也培养着他对紫砂艺术的悟性与天赋。 　1978年踏进紫砂工艺厂后，师从著名紫砂陶艺家、高级工艺师高丽君学艺。恩师如母，言传手教，使本来就灵性、'
			}, {
				id: 3,
				name: '李昌鸿',
				img: 'img/product/artist4.png',
				title: '研究员级高级工艺美术师',
				goods_list: [{
					goods_name: '荷叶筋纹',
					artist_name: '李昌鸿',
					goods_img: 'img/product/artist4_001.jpg',
					slurry: '天青泥',
					title: '研高',
					capacity: '150cc-200cc'
				}],
				synopses: '李昌鸿 中国工艺美术大师 中国陶瓷艺术大师 研究员级高级工艺美术师 世界名人 1937年生，1955年进紫砂工艺厂，师从顾景舟大师。“丙寅大吉”“九龙组壶”“四方特奎壶”“青玉四方茶具”“一衡茶具”“高八方壶”“斗方壶”等一批作品二十多次荣获国际、国内金银一等奖，在行业中有“获奖大户”美誉。大师为人厚道，谦虚好学，师德高尚，工作之余喜欢习字作画，钻研紫砂理论，培育新人，传授技艺。早期与顾景舟、徐秀棠合编《宜兴紫砂珍赏》;与唐伯年、叶龙耕合编《宜兴紫砂茶具实用功能的研究》'
			}]
		]
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
		toArtist(index) {
			this.goods_index = index;
			$('#box').hide();
			$('#box2').show();
		},
		toMain() {
			$('#box2').hide();
			$('#box').show();
		},
		details(index) {
			$('.pswp__scroll-wrap').show();
			let tupian = "";
			for (let i of imgsMobile[index]) {
				tupian += '<div class="swiper-slide"> <img src = "img/product/details/special/' + i.src + '" ></div>';
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
		},
		details2(index) {
			$('.pswp__scroll-wrap').show();
			let tupian = "";
			for (let i of imgsMobile2[index]) {
				tupian += '<div class="swiper-slide"> <img src = "img/product/details/recommend/' + i.src + '" ></div>';
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
	created() {},
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
})

layui.use('layer', function() {

	var layer = layui.layer;

})

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



$(function() {
	const imgsMobile = [{
		"src": "banner6.jpg",
		"href": "javascript:;"

	}, {

		"src": "banner7.jpg",
		"href": "javascript:;"

	}, {

		"src": "banner8.jpg",

		"href": "javascript:;"
	}, {

		"src": "banner5.jpg",

		"href": "javascript:;"

	}, {

		"src": "banner4.jpg",

		"href": "javascript:;"

	}];

	let tupian = "";

	for (let i of imgsMobile) {

		tupian += '<div class="swiper-slide"><a href="' + i.href + '"> <img src = "img/banner/' + i.src +
			'" > </a></div>';

	};

	$("header .swiper-wrapper").html(tupian);



	const mySwiper = new Swiper('header .swiper-container', {
		autoplay: {
			delay: 5000,
		}, //自动滑动，5秒切换一次
		effect: 'slide', //滑动效果
		touchAngle: 30, //滑动的角度超过30度无效
		// 轮播图的方向，也可以是vertical方向
		direction: 'horizontal',
		//环形切换关闭
		loop: true,
		// 切换的速度
		speed: 800, //滑动或者自动换页时的速度
		// 如果需要分页器
		pagination: {
			el: 'header .swiper-pagination',
			clickable: true,
			type: 'bullets',
		},
		// 这样，即使我们滑动之后， 定时器也不会被清除
		autoplayDisableOnInteraction: true
	});
	mySwiper.pagination.bullets.css('background', 'white');
	
	// 复制文本内容
	var copyBtn = new ClipboardJS('.full-gift');

	copyBtn.on("success", function(e) {
		// 复制成功
		 alert("微信号复制成功",1500); 
		 window.location.href='weixin://';
		e.clearSelection();
	});
	copyBtn.on("error", function(e) {
		//复制失败；
		console.log(e.action)
	});
})
