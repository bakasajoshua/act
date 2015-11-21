<!DOCTYPE html>
<html>
<head>
	<title>Tests|Upload</title>
</head>
<body>
<form action="<?php echo base_url();?>tests/read_csv" method="post" enctype="multipart/form-data">
	<input type="file" name="upload" />
	<input type="submit">
</form>
</body>
</html>