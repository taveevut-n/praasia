<html>
<head>
	<title>textcomment</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
	<script src="ckeditor.js"></script>
	<script src="adapters/jquery.js"></script>
	<script type="text/javascript">
		$( document ).ready( function() {
			$( 'textarea#editor1' ).ckeditor({
				language: 'th',
			});
		});
	</script>
</head>
<body>
<form name="frmtextcomment" id="frmtextcomment" action="sample_check.php" method="POST">
<textarea name="editor1" id="editor1" col="5" row="3">

</textarea>
<button type="submit" name="btnsubmit" id="btnsubmit">Submit</button>
<button type="button" name="btnbutton" id="btnbutton" onclick="getvalue();">Get by jQuery</button>
</form>
</body>
<script type="text/javascript">
	function getvalue (){
		var content = $( 'textarea#editor1' ).val();
		alert(content);
	}
</script>
</html>