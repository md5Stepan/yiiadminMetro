
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/style-metro.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/style-responsive.css" rel="stylesheet" type="text/css"/>
	<link href="/assets/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="/assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="/assets/plugins/select2/select2_metro.css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="/assets/css/pages/login-soft.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
        
        <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   <script src="/assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
	<script src="/assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="/assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>      
	<script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="/assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="/assets/plugins/excanvas.min.js"></script>
	<script src="/assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="/assets/plugins/jquery.blockui.min.js" type="text/javascript"></script>  
	<script src="/assets/plugins/jquery.cookie.min.js" type="text/javascript"></script>
	<script src="/assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="/assets/plugins/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
	<script src="/assets/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="/assets/plugins/select2/select2.min.js"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="/assets/scripts/app.js" type="text/javascript"></script>
	<script src="/assets/scripts/login-soft.js" type="text/javascript"></script>      
	<!-- END PAGE LEVEL SCRIPTS --> 
	<script>
		jQuery(document).ready(function() {     
		  App.init();
		  Login.init();
		});
	</script>
	<!-- END JAVASCRIPTS -->
        
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
	<!-- BEGIN LOGO -->
	<div class="logo">
		<img src="/assets/img/py-logo.png" alt="" /> 
	</div>
	<!-- END LOGO -->
	<!-- BEGIN LOGIN -->
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
                <?php $form=$this->beginWidget('CActiveForm', array(
                        'id'=>'login-form',
                        'enableClientValidation'=>true,
                        'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                        ),
                        'htmlOptions'=>array('class'=>'form-vertical login-form'),
                )); ?>
			<h3 class="form-title">Login to your account</h3>
                        <?php if($model->hasErrors() > 0):?>
			<div class="alert alert-error">
				<button class="close" data-dismiss="alert"></button>
                                <span>
                                    <ul>
                                    <?php foreach($model->getErrors() as $unit=>$value):?>
                                        <li><?php echo CHtml::encode($value[0]);?></li>
                                    <?php endforeach;?>
                                    </ul>
                                </span>
			</div>
                        <?php endif;?>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">E-mail</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
                                                <?php echo $form->textField($model,'username',array(
                                                    'class'=>'m-wrap placeholder-no-fix',
                                                    'autocomplete'=>'off',
                                                    'placeholder'=>'E-mail'
                                                )); ?>
					</div>
                                        <?php echo $form->error($model,'username',array('class'=>'help-inline help-small no-left-padding','style'=>'color:#b94a48;')); ?>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">Password</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
                                                <?php echo $form->passwordField($model,'password',array(
                                                    'class'=>'m-wrap placeholder-no-fix',
                                                    'autocomplete'=>'off',
                                                    'placeholder'=>'Password'
                                                )); ?>
					</div>
                                        <?php echo $form->error($model,'password',array('class'=>'help-inline help-small no-left-padding','style'=>'color:#b94a48;')); ?>
				</div>
			</div>
			<div class="form-actions">
				<label class="checkbox">
                                    <?php echo $form->checkBox($model,'rememberMe'); ?> Remember me
				</label>
				<button type="submit" class="btn blue pull-right">
				Login <i class="m-icon-swapright m-icon-white"></i>
				</button>            
			</div>  
		<?php $this->endWidget(); ?>
		<!-- END LOGIN FORM -->
	</div>
	<!-- END LOGIN -->
	<!-- BEGIN COPYRIGHT -->
	<div class="copyright">
		&copy; 
                <a style="color: #eee;" href="http://py-group.ru/">Панфилов и Юшко</a> 
                <?php echo date('Y');?>. All Rights Reserved.
	</div>
	<!-- END COPYRIGHT -->
<!-- END BODY -->
</html>