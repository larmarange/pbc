<?php 
define("PREPEND_PATH", "../../");
$hooks_dir = dirname(__FILE__);
include("../../defaultLang.php");
include("../../language.php");
include("../../lib.php");
include("../../header.php");

$dirs = array_filter(glob('*'), 'is_dir');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="https://www.jquery-az.com/javascript/alert/dist/sweetalert-dev.js"></script>
	<link rel="stylesheet" type="text/css" href="https://www.jquery-az.com/javascript/alert/dist/sweetalert.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading"><b>CHANGE YOUR APPGINI APPLICATION LANGUAGE</b></div>
				<div class="panel-body">
					<form action="" method="POST">
						<div class="form-group">
							<label for="sel1">Select New Language:</label>
							<select class="form-control" id="language" name="language">
								<?php  
								foreach ($dirs as $name) {
									echo '<option value="'.$name.'">'.ucfirst($name).'</option>';
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-success">Change Language</button>
					</form>

				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php 
if (isset($_POST['language'])) {
	# code...
	$path    = './'.$_POST['language'].'';
	$files = array_diff(scandir($path), array('.', '..'));
	foreach ($files as $filename) {
		# code...
		$source=$_POST['language']."/".$filename;
		$destination="../../language.php";
		copy($source, $destination);
	}
	echo '<script type="text/javascript">swal("Congrats!", "Your Appgini application language has successfully been changed.You can refresh to see changes", "success");</script>';
}
?>