 <?php
include "barcode128.php";
?>

<body>
<?php
$bar="123456789tesProgram";
echo bar128(stripslashes($bar));
?>
</body>
</html>