<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/bootstrap.css")?>">
		<link type="text/css" rel="stylesheet" href="<?=loadStatic("css/bootstrap-theme.css")?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class="header" style="/*background-color: red*/">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-10 col-md-offset-1" >
						<div class="col-md-6"><h1 class="logo"><span class="glyphicon glyphicon-home"></span> <?=PROJECT_TITLE?></h1></div>
					</div>
				</div>
			</div>
		</div>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo isset($data['user'])?"/home":"/"?>"><span class="glyphicon glyphicon-home"></span>&nbsp;<?=PROJECT_TITLE?></a>
	    </div>
	
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	      	<?php if(isset($data['user'])){ ?>
	        <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Notifications <span class="badge"><?=count($data['user']->unreadNotifications())?></span></a>
	        	<ul class="dropdown-menu dropdown-messages" style="min-width: 400px">
	        		<?php 
	        		$notifications = $data['user']->unreadNotifications();
	        		$number = count($notifications);
	        		if($number > 2)
	        			$number = 2;
	        		for($i=0; $i < $number; $i++){ ?>
                        <li>
                            <a href="#">
                                <div class="row">
                                    <strong><?=$notifications[$i]->title?></strong>
                                    <span class="pull-right text-muted">
                                        <em></em>
                                    </span>
                                </div>
                                <div class="row"><?=$notifications[$i]->message?></div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?php } ?>
                        <li>
                            <a class="text-center" href="/notifications/all">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
	        </li>
	        <?php } ?>
	        <li class="dropdown">
	        <?php if(isset($data['houses']) && count($data['houses'])>0){ ?>
	          <a href="#" id="" title="This shows the list of you houses" data-placement="bottom" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Houses <span class="badge"><?=count($data['houses'])?></span><span class="caret"></span></a>
	          <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
	          		<?php foreach($data['houses'] as $house){ ?>
	          		<li class="dropdown-submenu">
	          			<a href="/house/<?=$house->id?>/<?=$house->name?>"><?=$house->name?></a>
	          		</li>
	            <?php } 
					} ?>
	          </ul>
	        </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <?php 
	       if($data['data']){
	        foreach($data['data'] as $navItem){ ?>
	        	<li><?=$navItem?></li>
	        <?php } 
	        }?>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo isset($data['user'])?$data['user']->user_name:"Account"?><span class="caret"></span></a>
	          <?php if(isset($data['user'])){ ?>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="<?=Session::get('rank',false) == "tenant"?"/tenant/profile/edit":"/account/profile"?>">Profile</a></li>
	            <li class="divider"></li>
	            <li><a href="/account/logout?con=1">logout<span class="pull-right glyphicon glyphicon-off"></span></a></li>
	          </ul>
	          <?php }else{ ?>
	          <ul class="dropdown-menu" role="menu">
	            <li><a href="/account/login">Login</a></li>
	            <li><a href="/account/signup">Register</a></li>
	          </ul>
	          <?php } ?>
	        </li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

<div class="container">
