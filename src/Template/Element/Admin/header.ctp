<?php
	use Cake\Utility\Inflector;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>
		<?php
			$title = str_replace('Admin/', '', $this->fetch('title'));
			echo ucwords(str_replace('_', ' ', Inflector::underscore($title)));
		?>

		:: BTSL Admin

	</title>

	<?php
		$css = array('bootstrap.min',
					 'plugins/metisMenu/metisMenu.min',
					 'sb-admin-2',
					 'coderity',
					 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

		echo $this->Html->css($css);

		$js = array('jquery',
					'jquery-ui');

		echo $this->Html->script($js);
	?>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>