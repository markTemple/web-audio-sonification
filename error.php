<?php include("header.php");?>

<h2 id="pageName">Sonification - Data input error</h2>
<div class="fieldset">

  <div class="boarderbox">

<h2>The DNA sequence entered cannot be processed possible due to the following;</h2>
<?php echo '<h3>'.$_GET["msg"].'</h3>'; ?>

</div>
</div>

<?php include("footer.php");?>
