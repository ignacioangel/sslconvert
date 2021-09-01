<!DOCSTYLE html>
<html>

<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
<head>

<body>
<div class=c1>
<h3><a href=/>Home</a></h3>

<p>Convert SSL from .crt and .key to .pfx</p>

<?php
echo "
<form action='index.php' method='post' enctype='multipart/form-data'>
    Select certificate (.crt):<input type='file' name='crt'><br><br>
    Select private key (.key):<input type='file' name='key'><br><br>
    Friendly Name: <input type='text' name='fnm'><br><br>
    Export Password (pfx): <input type='password' name='psw'><br><br>
    <input type='submit' value='Convert' name='submit'>
</form>";

if(isset($_POST['submit'])){

$ERROR=$_FILES['key']['error'];

$CRT=$_FILES['crt']['tmp_name'];
$KEY=$_FILES['key']['tmp_name'];
$FNM=$_POST['fnm'];
$PSW=$_POST['psw'];

$convertcommand="openssl pkcs12 -inkey $KEY -in $CRT -export -out certificate.pfx -name $FNM -password pass:$PSW";

echo "* $convertcommand <br>";

shell_exec($convertcommand);

$zipcommand="zip converted.zip certificate.pfx && rm certificate.pfx";

echo "* $zipcommand <br>";

shell_exec($zipcommand);


echo "  <br><br>
	Successful<br>
        Download File <a href='converted.zip'> Here </a><br><br>";
}else {

echo "Please select the certificate and key files and click convert.";

}

?>
</div>
</body>
</html>

