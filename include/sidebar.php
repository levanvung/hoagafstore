<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ('lib/session.php');
?>
<div class="overlay overlay-contentpush" >
					<button type="button" class="overlay-close"><i class="fa fa-times" aria-hidden="true"></i></button>

					<nav>
						<ul>
							<li><a href="index.php" class="active">Trang Chủ</a></li>
							<li><a href="about.php">Thông Tin </a></li>
							<li><a href="404.php">Team</a></li>
							<li><a href="shop.php">Mua Ngay</a></li>
							<li><a href="contact.php">Liên Hệ Chúng Tôi</a></li>
							<li 
							><a href="login.php">Đăng Nhập</a></li>
							<?php
								if(isset($_GET['action']) && $_GET['action']== 'logout'){
									Session ::destroy();
								}
							?>
                            <li><a href="?action=logout">Đăng xuất</a></li>
						</ul>
					</nav>
				</div>