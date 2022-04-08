<?php
session_start();
/* DECLARE VARIABLES */
$username = 'admin';
$password = 'admin';
$random1 = 'secret_key1';
$random2 = 'secret_key2';
$hash = md5($random1 . $password . $random2);
$self = $_SERVER['REQUEST_URI'];
/* USER LOGOUT */
if(isset($_GET['logout']))
{
	unset($_SESSION['login']);
}
/* USER IS LOGGED IN */
if (isset($_SESSION['login']) && $_SESSION['login'] == $hash)
{
	logged_in_msg($username);
}
/* FORM HAS BEEN SUBMITTED */
else if (isset($_POST['submit']))
{
	if ($_POST['username'] == $username && $_POST['password'] == $password)
	{
		//IF USERNAME AND PASSWORD ARE CORRECT SET THE LOGIN SESSION
		$_SESSION["login"] = $hash;
		header("Location: $_SERVER[PHP_SELF]");
	}
	else
	{
		// DISPLAY FORM WITH ERROR
		display_login_form();
		display_error_msg();
	}
}
/* SHOW THE LOGIN FORM */
else
{
	display_login_form();
}
/* TEMPLATES */
function display_login_form()
{
?>
 <!DOCTYPE html>
	<html>
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Panel Drive 2020</title>
	<link rel="stylesheet" href="https://cdn.rawgit.com/ufilestorage/b/master/bootstrap/css/bootstrap.min.css" type="text/css"/>
	<link rel="stylesheet" href="https://cdn.rawgit.com/ufilestorage/b/master/bootstrap/css/main.css" type="text/css"/>
        </head>
		<body>
			<div class="trail">
				<canvas id="world"></canvas>
			</div>
	<div class="container" style="opacity:1;">
			<div class="row col-md-offset-2 col-md-8 login-error">
			<div class="alert alert-danger" role="alert">
				<strong>
					<font size="3">The following errors were found</font>	
				</strong>
				<font color="black" size="3">
					<ul type="square">
					</ul>
				</font>
			</div>
		</div>
		
	  	<div class="row-fluid">
	  		<div class="col-sm-offset-2 col-md-offset-4 col-sm-8 col-md-4 col-xs-12 login-form">
	  			<div class="row-fluid">
	  				<div class="col-sm-12 logo-login-form">
	  				<h2 style="text-align:center">Embed</h2>
	  				</div>
	  			</div>
	  			<div class="row-fluid">
	  				<div class="col-sm-12">
	<?php echo '<form action="' . isset($self) . '" method="post">' .
			 '<label for="username">username:</label>' .
			 '<input type="text" name="username" id="username">' .
			 '<label for="password">password:</label>' .
			 '<input type="password" name="password" id="password">' .
			 '<input type="submit" name="submit" value="login" class="btn btn-default primary sub">' .
		 '</form>';
}
function logged_in_msg($username)
{
?>
  </div>
	  			      </div>
	  			   <div>
	  			</div>
	  		</div>
	  	</div>
	</div>
</body>
</html>  
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Panel Drive 2021</title>
	<link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/ITunes_12.2_logo.png/600px-ITunes_12.2_logo.png" type="image/x-icon" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
	<script type="text/javascript" src="assets/js/apicodes.min.js"></script>
</head>
<body>
	<div class="container">
	     <br>
	     <br>
		<form id="action-form" action="action.php" method="POST" accept-charset="utf-8">
		    <a class="btn btn-info btn-sm" href="?logout=true" role="button">Cerrar Sesion</a>
			<div class="form-group">
				<label class="font-weight-bold">ID Drive:</label>
				<input type="text" name="link" class="form-control" placeholder="1QPuoQJvgJdp-PTiiPvNgJY3zRLQydVvN"this.select()" required>
			</div>

			<div class="row">

				<div class="col-md-11" id="sub">
					<div id="sub-block">
						<div class="row">
						    <div class="col-md-7">
						        <div class="form-group">
						        	<label class="font-weight-bold">Subtitle</label>
						        	<input type="text" class="form-control" name="sub[0]" placeholder="Ex: name.com/api/apipanel/drop/the.boss.baby.srt (optional)" onclick="this.select()"> 
						        </div>
						    </div>
						    
						    <div class="col-md-4">
						        <div class="form-group">
						        	<label class="font-weight-bold">Idioma</label>
						        	<input type="text" class="form-control" name="label[0]" placeholder="Ex: English (optional)" onclick="this.select()"> 
						        </div>
						    </div>
						    
						    <div class="col-md-1" style="margin-top: 30px">
						    <button type="button" id="add_new_sub" data-total="1" class="btn btn-success btn-block"><i class="fa fa-plus"></i></button>
						    </div>
						</div>
					</div>
				</div>

			</div>

			<div class="form-group">
				<label class="font-weight-bold">Url Imagen:</label>
				<input type="text" name="poster" class="form-control" placeholder="Ex: https://as01.epimg.net/meristation/imagenes/2019/01/08/reportajes/1546933662_826942_1546935400_noticia_normal.jpg" onclick="this.select()">
			</div>

			<div class="form-group">
				<button type="submit" id="action-submit" class="btn btn-dark"> <span id="fa-loading"></i></span> Encriptar URL</button>
			</div>
		</form>
		
		<div class="form-group">
			<label class="font-weight-bold">URL Directo:</label>
			<input type="text" id="url-encode" class="form-control" placeholder="La URL después de la codificación se mostrará aquí ..." onclick="this.select()">
		</div>

		<div class="form-group">
			<label class="font-weight-bold">Iframe:</label>
			<textarea rows="5" class="form-control" id="iframe-encode" placeholder="La URL con iframe después de la codificación se mostrará aquí ..." onclick="this.select()"></textarea>
		</div>
		<?php  $domainServer = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['PHP_SELF']); ?>
		<script type="text/javascript">
			jQuery(function ($) {
				$('#action-form').submit(function(e) {
					e.preventDefault();
					$('#action-submit').prop('disabled', !0);
					$('#fa-loading').html('<i class="fa fa-spinner fa-spin"></i>');
		       		var b = $(this).serializeArray(), c = $(this).attr('action');
					$.ajax({
				        type: 'POST',
				        dataType: 'text',
				        url: c,
				        data: b,
						error: function (result) {
							alert("Something went wrong. Please try again!");
							$('#fa-loading').html('<i class="fa fa-arrow-circle-right"></i>');
							$('#action-submit').removeAttr('disabled');
						},
						success: function (result) {
							$('#url-encode').val('<?php echo $domainServer . '/embed.php?data=' ?>'+result+'');
							$('#iframe-encode').html('<iframe src="<?php echo $domainServer . '/embed.php?data=' ?>'+result+'" width="100%" height="100%" frameborder="0" allowfullscreen></iframe>');
							$('#fa-loading').html('<i class="fa fa-arrow-circle-right"></i>');
							$('#action-submit').removeAttr('disabled');
						}
					});
				});
			});
		</script>

		<hr>
		<footer class="footer">
		</footer>
	</div><!-- /.container -->
	<?php
	}
function display_error_msg()
{
	echo '<p>Username or password is invalid</p>';
}
?>
</body>
</html>