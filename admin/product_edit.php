<?php
	include '../lib/session.php';
    Session :: checkSession();
	include '../class/category.php';
	include '../class/product.php';
?>
<?php
	$product = new product();
    if(!isset($_GET['product_id']) || $_GET['product_id']==NULL){
        echo "<script>window.location='product_list.php'</script>";
    }else{
        $id = $_GET['product_id'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $product->update_product($_POST,$_FILES,$id);
    }
?>
<!DOCTYPE html>
<head>
<title>Edit product</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="index.php" class="logo">
        HOAGAF
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->


<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username"><?php echo Session::get('admin_name'); ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                <?php
                    if(isset($_GET['action']) && $_GET['action']== 'logout'){
                        Session ::destroy();
                    }
                ?>
                <li><a href="?action=logout"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Trang chủ</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="cat_add.php">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="category_list.php">Tất cả thương hiệu sản phẩm</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a class="active" href="javascript:;">
                        <i class="fa fa-th"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a class="active" href="product_add.php">Thêm sản phẩm</a></li>
                        <li><a href="product_list.php">Tất cả sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>Sliders</span>
                    </a>
                    <ul class="sub">
                        <li><a href="slider_add.php">Thêm slide</a></li>
                        <li><a href="slider_list.php">Tất cả slide</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-envelope"></i>
                        <span>Mail </span>
                    </a>
                    <ul class="sub">
                        <li><a href="mail.php">Inbox</a></li>
                        <li><a href="mail_compose.php">Compose Mail</a></li>
                    </ul>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
    <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Sửa sản phẩm
                        </header>
                        <?php
                            if(isset($updateProduct)){
                                echo $updateProduct;
                            }
                        ?>
                        <?php
                        $get_product = $product->get_product($id);
                        if($get_product){
                            while($result_product = $get_product->fetch_assoc()){
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="product_name" value="<?php echo $result_product['product_name']; ?>" id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá tiền</label>
                                        <input type="text" class="form-control" name="product_price" value="<?php echo $result_product['product_price']; ?>"  id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả</label>
                                        <textarea style="resize: none;" rows="5" class="form-control"   name="product_desc" id="exampleInputPassword1" ><?php echo $result_product['product_desc']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Ảnh minh họa</label> <br>
                                        <div>
                                        <img src="uploads/<?php echo $result_product['product_image']; ?>" width="150">
                                        </div>
                                        <br>
                                        <input type="file" class="form-control" value="<?php echo $result['product_image']; ?>"  name="product_image" id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Type</label>
                                        <select name="product_type" class="form-control input-sm m-bot15">
                                            <?php
                                                if ($result_product['product_type'] == 0){
                                            ?>
                                            <option value="1">Nổi bật</option>
                                            <option selected value="0">Không nổi bật</option>
                                            <?php
                                            }else{
                                            ?>
                                                <option selected value="1">Nổi bật</option>
                                                <option  value="0">Không nổi bật</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Thương hiệu</label>
                                        <select name="product_brand" class="form-control input-sm m-bot15">
                                            <?php
                                                $cat = new Category();
                                                $cat_list = $cat->show_cate();
                                                if($cat_list){
                                                    while($result = $cat_list->fetch_assoc()){

                                            ?>
                                            <option <?php if($result['cat_id']==$result_product['cat_id']){echo 'selected';}?> value="<?php echo $result['cat_id']; ?>"><?php echo $result['cat_name']; ?></option>
                                            <?php
                                            
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-info">Sửa</button>
                                </form>
                            </div>
                        </div>
                        <?php 
                            }
                        }
                        ?>
                    </section>

            </div>
    </section>
</section>

<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
</body>
</html>
