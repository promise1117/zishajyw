layui.use('layer', function() {

	var layer = layui.layer;

})
	
	// 产品细节图片
const imgsMobile = [
			[
			[{
				src: '1/101/0.jpg'
			}, {
				src: '1/101/01.jpg'
			}, {
				src: '1/101/02.jpg'
			}, {
				src: '1/101/03.jpg'
			}, {
				src: '1/101/04.jpg'
			}, {
				src: '1/101/05.jpg'
			}],
			[{
				src: '1/102/0.jpg'
			}, {
				src: '1/102/02.jpg'
			}, {
				src: '1/102/03.jpg'
			}, {
				src: '1/102/04.jpg'
			}, {
				src: '1/102/05.jpg'
			}],
			[{
				src: '1/103/0.jpg'
			}, {
				src: '1/103/02.jpg'
			}, {
				src: '1/103/03.jpg'
			}, {
				src: '1/103/04.jpg'
			}, {
				src: '1/103/05.jpg'
			}],
			[{
				src: '1/104/00.jpg'
			}, {
				src: '1/104/0.jpg'
			}, {
				src: '1/104/01.jpg'
			}, {
				src: '1/104/02.jpg'
			}, {
				src: '1/104/03.jpg'
			}],
			[{
				src: '1/105/00.jpg'
			}, {
				src: '1/105/0.jpg'
			}, {
				src: '1/105/01.jpg'
			}, {
				src: '1/105/02.jpg'
			}, {
				src: '1/105/03.jpg'
			}],
			[{
				src: '1/106/00.jpg'
			}, {
				src: '1/106/0.jpg'
			}, {
				src: '1/106/01.jpg'
			}, {
				src: '1/106/02.jpg'
			}, {
				src: '1/106/03.jpg'
			}]
				
			],
			[
			[{
				src: '2/201/00.jpg'
			}, {
				src: '2/201/0.jpg'
			}, {
				src: '2/201/01.jpg'
			}, {
				src: '2/201/02.jpg'
			}, {
				src: '2/201/03.jpg'
			}],
			[{
				src: '2/202/0.jpg'
			}, {
				src: '2/202/01.jpg'
			}, {
				src: '2/202/02.jpg'
			}, {
				src: '2/202/04.jpg'
			}, {
				src: '2/202/05.jpg'
			}],
			 [{
			 	src: '2/203/0.jpg'
			 }, {
			 	src: '2/203/02.jpg'
			 }, {
			 	src: '2/203/03.jpg'
			 }, {
			 	src: '2/203/04.jpg'
			 }, {
			 	src: '2/203/06.jpg'
			 }],
			[ {
				src: '2/204/0.jpg'
			}, {
				src: '2/204/01.jpg'
			}, {
				src: '2/204/02.jpg'
			}, {
				src: '2/204/03.jpg'
			},{
				src: '2/204/04.jpg'
			}],	
			[{
				src: '2/205/0.jpg'
			}, {
				src: '2/205/02.jpg'
			}, {
				src: '2/205/03.jpg'
			}, {
				src: '2/205/04.jpg'
			}, {
				src: '2/205/05.jpg'
			}],
			[ {
				src: '2/206/0.jpg'
			}, {
				src: '2/206/01.jpg'
			}, {
				src: '2/206/02.jpg'
			}, {
				src: '2/206/03.jpg'
			},{
				src: '2/206/04.jpg'
			}]
			],
			[
			[{
				src: '3/301/0.jpg'
			}, {
				src: '3/301/02.jpg'
			}, {
				src: '3/301/03.jpg'
			}, {
				src: '3/301/04.jpg'
			}, {
				src: '3/301/05.jpg'
			}, {
				src: '3/301/06.jpg'
			}],
			[{
				src: '3/302/0.jpg'
			}, {
				src: '3/302/01.jpg'
			}, {
				src: '3/302/02.jpg'
			}, {
				src: '3/302/03.jpg'
			}, {
				src: '3/302/04.jpg'
			}],
			 [{
			 	src: '3/303/0.jpg'
			 }, {
			 	src: '3/303/02.jpg'
			 }, {
			 	src: '3/303/03.jpg'
			 }, {
			 	src: '3/303/04.jpg'
			 }, {
			 	src: '3/303/05.jpg'
			 }],
			[ {
				src: '3/304/0.jpg'
			}, {
				src: '3/304/02.jpg'
			}, {
				src: '3/304/03.jpg'
			},{
				src: '3/304/04.jpg'
			}, {
				src: '3/304/05.jpg'
			}, {
				src: '3/304/06.jpg'
			}],	
			[{
				src: '3/305/0.jpg'
			}, {
				src: '3/305/02.jpg'
			}, {
				src: '3/305/03.jpg'
			}, {
				src: '3/305/04.jpg'
			}, {
				src: '3/305/05.jpg'
			}],
			[ {
				src: '3/306/0.jpg'
			}, {
				src: '3/306/01.jpg'
			}, {
				src: '3/306/02.jpg'
			}, {
				src: '3/306/03.jpg'
			},{
				src: '3/306/04.jpg'
			}]
			],
			[
			[{
				src: '4/401/0.jpg'
			}, {
				src: '4/401/01.jpg'
			}, {
				src: '4/401/02.jpg'
			}, {
				src: '4/401/03.jpg'
			}, {
				src: '4/401/04.jpg'
			}],
			[{
				src: '4/402/0.jpg'
			}, {
				src: '4/402/01.jpg'
			}, {
				src: '4/402/02.jpg'
			}, {
				src: '4/402/03.jpg'
			}, {
				src: '4/402/04.jpg'
			}],
			 [{
			 	src: '4/403/0.jpg'
			 }, {
			 	src: '4/403/02.jpg'
			 }, {
			 	src: '4/403/03.jpg'
			 }, {
			 	src: '4/403/04.jpg'
			 }, {
			 	src: '4/403/08.jpg'
			 }],
			[ {
				src: '4/404/0.jpg'
			}, {
				src: '4/404/01.jpg'
			}, {
				src: '4/404/02.jpg'
			}, {
				src: '4/404/03.jpg'
			},{
				src: '4/404/04.jpg'
			}, {
				src: '4/404/05.jpg'
			}],	
			[{
				src: '4/405/0.jpg'
			}, {
				src: '4/405/01.jpg'
			}, {
				src: '4/405/02.jpg'
			}, {
				src: '4/405/03.jpg'
			}, {
				src: '4/405/04.jpg'
			}, {
				src: '4/405/05.jpg'
			}],
			[ {
				src: '4/406/0.jpg'
			}, {
				src: '4/406/01.jpg'
			}, {
				src: '4/406/03.jpg'
			},{
				src: '4/406/04.jpg'
			}, {
				src: '4/406/05.jpg'
			}]
			],
		];

// 预加载
const images = [];
function preload(para) {
	for (i = 0; i < para.length; i++) {
		images[i] = new Image();
		images[i].src = 'img/inquiry/details/' + para[i].src;
	}
}

preload(imgsMobile[0][0])

			const vm = new Vue({
				el: '#app',
				data: {

					submit_information: {},
					goods_index: 0,
					list: [{
							id: 0,
							name: '1千元以内',
							flag: true,
						},
						{
							id: 1,
							name: '1千-5千元',
							flag: false,
						},
						{
							id: 2,
							name: '5千-1万元',
							flag: false,
						}, {
							id: 3,
							name: '1万以上',
							flag: false,
						}
					],
					goods: [
						[{
								id: 0,
								img: 'img/inquiry/1000_03.jpg',
								goods_name: '吉祥如意',
								artist_name: '曹志刚',
								slurry: '枣红泥',
								title: '艺人',
								capacity: '200cc-250cc'
							},
							{
								id: 1,
								img: 'img/inquiry/1000_05.jpg',
								goods_name: '井栏',
								artist_name: '吴文彩',
								slurry: '紫朱泥',
								title: '美术员',
								capacity: '150cc-200cc'
							},
							{
								id: 2,
								img: 'img/inquiry/1000_09.jpg',
								goods_name: '金莲仿古',
								artist_name: '李烈华',
								slurry: '黑泥',
								title: '美术师',
								capacity: '200cc-250cc'
							}, {
								id: 3,
								img: 'img/inquiry/1000_10.jpg',
								goods_name: '牡丹西施',
								artist_name: '曹志刚',
								slurry: '黑泥',
								title: '艺人',
								capacity: '200cc-250cc'
							},
							{
								id: 4,
								img: 'img/inquiry/1000_13.jpg',
								goods_name: '天香',
								artist_name: '曹志刚',
								slurry: '黑泥',
								title: '艺人',
								capacity: '200cc-250cc'
							},
							{
								id: 5,
								img: 'img/inquiry/1000_14.jpg',
								goods_name: '仙桃西施',
								artist_name: '吴文彩',
								slurry: '黑泥',
								title: '美术员',
								capacity: '200cc-250cc'
							}
						],
						[{
								id: 0,
								img: 'img/inquiry/1000-5000_03.jpg',
								goods_name: '龙纹西施',
								artist_name: '王镇学',
								slurry: '大红袍',
								title: '国工',
								capacity: '300cc-350cc'
							},
							{
								id: 1,
								img: 'img/inquiry/1000-5000_05.jpg',
								goods_name: '龙纹龙蛋 ',
								artist_name: '王镇学',
								slurry: '大红袍',
								title: '国工',
								capacity: '300cc-350cc'
							},
							{
								id: 2,
								img: 'img/inquiry/1000-5000_09.jpg',
								goods_name: '一品竹段',
								artist_name: '范永芳',
								slurry: '老紫泥',
								title: '国工',
								capacity: '300cc'
							}, {
								id: 3,
								img: 'img/inquiry/1000-5000_10.jpg',
								goods_name: '龙腾',
								artist_name: '丁洪斌',
								slurry: '紫泥',
								title: '国工',
								capacity: '350cc以上'
							},
							{
								id: 4,
								img: 'img/inquiry/1000-5000_13.jpg',
								goods_name: '三足富韵',
								artist_name: '许良平',
								slurry: '紫泥',
								title: '高工',
								capacity: '350cc'
							},
							{
								id: 5,
								img: 'img/inquiry/1000-5000_14.jpg',
								goods_name: '一帆风顺',
								artist_name: '杨志华',
								slurry: '紫泥',
								title: '国工',
								capacity: '250cc-300cc'
							}
						],
							[{
								id: 0,
								img: 'img/inquiry/5000-10000_03.jpg',
								goods_name: '六方菱花',
								artist_name: '尹怀',
								slurry: '底槽清',
								title: '国工',
								capacity: '250cc-300cc'
							},
							{
								id: 1,
								img: 'img/inquiry/5000-10000_05.jpg',
								goods_name: '掇樂',
								artist_name: '陈顺根',
								slurry: '紫泥',
								title: '高工',
								capacity: '250cc-300cc'
							},
							{
								id: 2,
								img: 'img/inquiry/5000-10000_09.jpg',
								goods_name: '集玉',
								artist_name: '蒋惠娟',
								slurry: '紫泥',
								title: '高工',
								capacity: '380cc'
							}, {
								id: 3,
								img: 'img/inquiry/5000-10000_10.jpg',
								goods_name: '剑流德钟',
								artist_name: '李洪明',
								slurry: '芝麻段',
								title: '高工',
								capacity: '250cc'
							},
							{
								id: 4,
								img: 'img/inquiry/5000-10000_13.jpg',
								goods_name: '僧帽',
								artist_name: '储国峰',
								slurry: '桂花砂',
								title: '高工',
								capacity: '450cc'
							},
							{
								id: 5,
								img: 'img/inquiry/5000-10000_14.jpg',
								goods_name: '小莲瓣',
								artist_name: '陈卫民',
								slurry: '降坡泥',
								title: '高工',
								capacity: '200cc'
							}
						],
						[{
								id: 0,
								img: 'img/inquiry/10000_03.jpg',
								goods_name: '奔月壶',
								artist_name: '许敏芳',
								slurry: '紫泥',
								title: '高工',
								capacity: '400cc'
							},
							{
								id: 1,
								img: 'img/inquiry/10000_05.jpg',
								goods_name: '上合桃',
								artist_name: '李洪明',
								slurry: '底槽清',
								title: '高工',
								capacity: '600cc'
							},
							{
								id: 2,
								img: 'img/inquiry/10000_09.jpg',
								goods_name: '汉扁',
								artist_name: '杨卫刚',
								slurry: '老紫泥',
								title: '高工',
								capacity: '260cc'
							}, {
								id: 3,
								img: 'img/inquiry/10000_10.jpg',
								goods_name: '禅墩·唯心',
								artist_name: '李洪明',
								slurry: '大红袍',
								title: '高工',
								capacity: '230cc'
							},
							{
								id: 4,
								img: 'img/inquiry/10000_13.jpg',
								goods_name: '银箱',
								artist_name: '孔小明',
								slurry: '紫泥',
								title: '高工',
								capacity: '300cc'
							},
							{
								id: 5,
								img: 'img/inquiry/10000_14.jpg',
								goods_name: '鱼乐壶',
								artist_name: '蒋惠娟',
								slurry: '底槽青',
								title: '高工',
								capacity: '360cc'
							}
						]
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
					toggle(item, index) {
						console.log(index);
						this.list.forEach(i => {
							console.log(i.flag);
							console.log(this.list[index].flag);
							if (i.flag !== this.list[index].flag) {
								i.flag = false
							}
						})


						item.flag = !item.flag
					},
					toggleClass(item, index) {
						console.log(index);
						this.list.forEach(i => {
							console.log(i.flag);
							console.log(this.list[index].flag);
							if (i.flag !== this.list[index].flag) {
								i.flag = false
							}
						})
						item.flag = true
						this.goods_index = index;
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
						this.close() 

					},
					close() {
						$('.footer-k,.foot-xunjia').hide();

						$('#fbtn').show();
					},
					details(index) {
						$('.pswp__scroll-wrap').show();
						let tupian = "";
						for (let i of imgsMobile[this.goods_index][index]) {
							tupian += '<div class="swiper-slide"> <img src = "img/inquiry/details/' + i.src + '" ></div>';
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
			
						console.log(this.goods_index)
			
					}
								
					


				},
				created() {


				},
				mounted() {
					this.lazyload();
				},
				watch: {

				}
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

					const artist = vm.submit_information.artist_name || '';
					const goods = vm.submit_information.goods_name || '';
					const capacity = vm.submit_information.capacity || vm.submit_information;
					let demand = [artist, goods, capacity];
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

					$('.pswp__scroll-wrap').click(function(event) {
						if (event.target == this) {
							$(this).hide();
						}
					});
					$('#pswp_img').click(function(event) {
						event.stopPropagation();
					});


				function telphone() {
				
					const telphone = $("#telphone1").val();
				
					var regCode = /^1\d{10}$/;
				
					if (regCode.test(telphone) === false) {
				
						layer.close(layer.index);
				
						layer.msg('请输入您的手机号,手机号码不正确', {
							icon: 5,
							time: 1000
						})
				
						return false;
				
					} else {
				
						var demand = ['咨询紫砂壶'];
				
				
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
				
								/*console.log(data);
						
										layer.close(layer.index);
						
										if(data.code == 0){
						
											layer.msg('提交成功',{icon:6,time:2000})
						
										}else{
						
											layer.msg('提交失敗',{icon:5,time:2000})
						
										}*/
								layer.msg('提交成功', {
									icon: 6,
									time: 2000
								})
				
							},
				
							error: function() {
				
								layer.close(layer.index);
				
								//layer.msg('提交失敗',{icon:5,time:2000});
				
								layer.msg('提交成功', {
									icon: 6,
									time: 2000
								})
				
							}
				
						})
				
					}
				
				}

				$('.confirm').click(function() {

					layer.load();

					telphone();

				})
				
				
				
			})