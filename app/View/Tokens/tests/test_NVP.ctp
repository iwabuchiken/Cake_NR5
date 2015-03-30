<h1><?php echo __FILE__; ?></h1>
<br>
<?php 

	if (isset($message)) {
		
		echo $message;
		
	}
?>
<br>
<br>
<hr>

sen_NL is 
<?php 

	if (isset($hist_id)) {
		
		echo "(hist_id=$hist_id)";
	}
?>

<br>

<?php 

	if (isset($sen_NL)) {
		
		echo $sen_NL;
		
	} else {

		echo "Not set";

	}

?>

<hr>

<p>
sen_Syms is 
<?php 

	if (isset($hist_id)) {
		
		echo "(hist_id=$hist_id)";
	}
?>

<?php 

	if (isset($sen_Syms)) {
		
		echo $sen_Syms;
		
	} else {

		echo "Not set";

	}

?>

</p>

<br>

	<span></span>

<br>

<a onclick="d3_alert('clicked')">click</a>

