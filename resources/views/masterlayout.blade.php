<!-- <base href="http://localhost/phonghap/" />-->

<!-- Đã xóa phần php include database -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Phong Hấp </title>
<link rel="stylesheet" style="style/sheet" href="{{asset('public/frontend/slide/engine/style.css')}}">
<link rel="stylesheet" style="style/sheet" href="{{asset('public/frontend/css/index.css')}}">
<link rel="stylesheet" style="style/sheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link rel="stylesheet" style="style/sheet" href="{{asset('public/frontend/css/style1.css')}}">
<link rel="stylesheet" style="style/sheet" href="{{asset('public/frontend/css/index.css')}}">

<script language="javascript" type="text/javascript" src="{{asset('public/frontend/js/jquery.easing.js')}}"></script>
<script language="javascript" type="text/javascript" src="{{asset('public/frontend/js/script.js')}}"></script>
<script src="https://kit.fontawesome.com/2c8a18bbf3.js" crossorigin="anonymous"></script>
<script src="{{asset('public/frontend/js/jquery-1.3.2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/frontend/js/code.js')}}"></script>

<!-------------------------------------Tabs-------------------------------->
<script>

// Đợi cho đến khi DOM tải trước khi truy vấn

$(document).ready(function(){

$('ul.tabs').each(function(){

// For each set of tabs, we want to keep track of
// which tab is active and it's associated content

var $active, $content, $links = $(this).find('a');

// If the location.hash matches one of the links, use that as the active tab.

// If no match is found, use the first link as the initial active tab.

$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);

$active.addClass('active');

$content = $($active.attr('href'));

// Hide the remaining content

$links.not($active).each(function () {

$($(this).attr('href')).hide();

});

// Bind the click event handler

$(this).on('click', 'a', function(e){

// Make the old tab inactive.

$active.removeClass('active');

$content.hide();

// Update the variables with the new link and content

$active = $(this);

$content = $($(this).attr('href'));

// Make the tab active.

$active.addClass('active');

$content.show();
// Prevent the anchor's default click action
// Ngăn cản

e.preventDefault();

});

});

});


</script>

<!-------------------------------------slide-------------------------------->
<script type="text/javascript">
 $(document).ready( function(){
		var buttons = { previous:$('#lofslidecontent45 .lof-previous') ,
						next:$('#lofslidecontent45 .lof-next') };

		$obj = $('#lofslidecontent45').lofJSidernews( { interval : 4000,
												direction		: 'opacitys',
											 	easing			: 'easeInOutExpo',
												duration		: 2000,
												auto		 	: true,
												maxItemDisplay  : 4,
												navPosition     : 'horizontal', // horizontal
												navigatorHeight : 32,
												navigatorWidth  : 80,
												mainWidth:1000,
												buttons			: buttons} );
	});
</script>
</head>
<body style="background:white">
<div id="wapper">
	<!-- <div class="alertBox" id="alertBox">
	<div class='exitField' onclick="document.getElementById('alertBox').innerHTML=''">
		<div class='alertBox-holder'>
			<div class='alertBox-title'>.$title</div>
			<div class='alertBox-context'>".$message."</div>
			<div class='alertBox-interact' onclick="document.getElementById('alertBox').innerHTML=''"> Oke </div>
		</div>
	</div> -->
	</div>
	<div id="header" class="header">
		<div class="nav container">
			<a href="{{URL::to('/')}}" class="nav__logo">
				<img src="{{asset('public/frontend/images/logo-header.png')}}" alt="">
			</a>
			<div class="nav__menu" id="nav-menu">
					<ul class="nav__list">
						<li class="nav__item">
							<a href="{{URL::to('/sanpham/dongho')}}" class="nav__link">Đồng hồ</a>
						</li>
						<li class="nav__item">
							<a href="{{URL::to('/sanpham/phukien')}}" class="nav__link">Phụ kiện</a>
						</li>
						<li class="nav__item">
							<a href="{{URL::to('/hotro')}}" class="nav__link">Hỗ trợ</a>
						</li>
                        <li class="nav__item">
                            <a href="{{URL::to('/tintuc')}}" class="nav__link">Tin tức</a>
						</li>
					</ul>
			</div>

			<div class="nav__acc">
				<div >
					<a href="{{asset('public/frontend/index.php?content=cart')}}">
						<i class="fas fa-shopping-cart nav__cart" style="transform: scale(1.3);"></i>
					</a>
				</div>
				<?php 
				$tendangnhap = Session::get('tendangnhap');
				$phanquyen = Session::get('phanquyen');
				if (isset($tendangnhap)) {?>
					<ul>
						<?php if (isset($phanquyen) && ($phanquyen == 0 || $phanquyen == 2)) {?><a href="{{asset('public/frontend/admin/admin.php')}}"><li>Quay về trang admin </li></a><?php }?>
						<a href="{{URL::to('/thongtincanhan')}}"><li><i class="fas fa-user"></i> <?php echo $tendangnhap ?></li></a>
						<a href="{{URL::to('/logout')}}"><li> Đăng xuất</li></a>
					</ul>
				<?php } else {?>
					<ul>
						<a href="{{URL::to('/register')}}"><li>Đăng ký </li></a>
						<a href="{{URL::to('/login')}}"><li> Đăng nhập</li></a>
					</ul>
				<?php }?>
			</div>
		</div>
	</div><!-- End .header -->

	<div id="main-content">
		<div id="center-content"> 
			{{-- yield show where the page define in bracket will take place --}}
            @yield('home')
			@yield('login')
			@yield('register')
			@yield('news')
			@yield('newsDetail')
			@yield('support')
			@yield('spDetail')
			@yield('product')
			@yield('productDetail')
			@yield('profile')
			@yield('transactionHistory')
			@yield('changeProfile')
		</div><!-- End .center-content -->
	</div><!-- End .main-content -->

	<div id="footer">
	    <div id="doitac">
		    <div id="center2">
			    <div id="doitaccon">
					    <img src="{{asset('public/frontend/images/footer-banner.png')}}" alt="Đối tác" />
			    </div><!-- End .doitaccon -->
		    </div><!-- End .center2 -->
	    </div><!-- End .doitac -->
		<div id="bg-footer">
			<div id="noidungfooter">
				<div id="noidung">
					<ul>
						<li><span id="tencongty">Cty TNHH chưa có thành viên PHONG HẤP</span></li> <br>

						<li>Địa chỉ: Đặng Văn Ngữ - TP.Hồ Chí Minh </li>
						<li>Điện thoại: 0938909944 - Hotline:  0972341193</li>
						<li>Email:  daylafooter@gmail.com</li>
					</ul>
				</div><!-- End .noidung -->
				<div id="thanhngang">
					<img src="{{asset('public/frontend/images/thanhngang-footer.png')}}" />
				</div><!-- End .thanhngang -->
				<div id="copyright">
					<p>Bản quyền thuộc sở hữu bởi Phong Hấp<p>
                    <p>Chịu trách nhiệm quản lí nội dung: một đứa ất ơ nào đó - Số điện thoại: cho nhá máy chết con nhà người ta<p>
                    <p>Mã số doanh nghiệp: chưa có<p>
				</div>
			</div><!-- End .noidungfooter -->
		</div><!-- End .bg-footer -->
	</div><!-- End .footer -->
</div><!-- End .wapper -->

</body>
</html>