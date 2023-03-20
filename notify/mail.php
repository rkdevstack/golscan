<?php 
require 'phpmailler/PHPMailerAutoload.php';

$mail = new PHPMailer;
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  $mail->SMTPAuth=true;
  $mail->SMTPSecure='tls';
  $mail->Username='catchwaymailler@gmail.com';
  $mail->Password='Catchway@2020';
  $mail->setFrom('info@golscan.io');
  $mail->addAddress($_POST[email]);
  $mail->addReplyTo('info@golscan.io');
  $mail->isHTML(true);
  $mail->Subject='5 Gol Tokens Deposited in your Wallet';
  $mail->Body ='<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>GogolCoin</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #eeeeee;
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style1 {
	color: #FFFFFF;
	font-size: 20px;
}
.style3 {font-size: 16}
.button1 {
    background: #dda46f;
    text-decoration: none;
    color: white;
    padding: 10px;
    margin: 4px;
    border-radius: 4px;
	border:0;
	border-bottom:2px solid #ac7e53;
	width:90%;
}
.button2 {
    background: #5d7ec0;
    text-decoration: none;
    color: white;
    padding: 10px;
    margin: 4px;
    border-radius: 4px;
	border:0;
	border-bottom:2px solid #415c90;
	width:90%;
}
-->
</style></head>

<body>
<p>&nbsp;</p>
<table width="600" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#ffffff">
  <tr>
    <td width="327" height="70" style="border-bottom:1px solid #eee;"><img src="http://golscan.io/notify/logo-black_small.png" width="182" height="39" /></td>
    <td width="233" align="right" style="border-bottom:1px solid #eee;">Go to <a href="#" style="text-decoration:none; color: #DDA46F;">My Account </a></td>
  </tr>
  <tr>
    <td height="126" style="border-bottom:1px solid #eee;"><p><img src="http://golscan.io/notify/1.jpg" width="248" height="226" style="float: right;" /></p>      </td>
    <td height="126" style="border-bottom:1px solid #eee;"><p>Dear Customer, </p>
    <p> Congrats  ! ! We have deposited 5 GogolCoins in your Wallet . Login to your account to view your balance</p></td>
  </tr>
  <tr>
    <td height="121" style="border-bottom:1px solid #eee;"><p align="center" class="style3" style="text-transform:uppercase; font-weight:600; margin-top: 0px;"><img src="http://golscan.io/notify/metamask-logo-png-transparent.png" width="93" height="93" /></td>
    <td height="121" style="border-bottom:1px solid #eee;">
      Your Public Metamask Address</p>
    <p align="center" class="style1" style="margin-bottom: 0; color: #DDA46F;"><a href="https://etherscan.io/token/0x083d41d6dd21ee938f0c055ca4fb12268df0efac?a='.$_POST[address].'" target="_blank" ">'.$_POST['address'].'</a></p></td>
  </tr>

  <tr>
  	<td colspan="2" style="border-bottom:1px solid #eee;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center"><a href="https://etherscan.io/token/0x083d41d6dd21ee938f0c055ca4fb12268df0efac?a='.$_POST[address].'" target="_blank" class="button1">View in GolScan</a></td>
        
        <td align="center"><a href="https://etherscan.io/token/0x083d41d6dd21ee938f0c055ca4fb12268df0efac?a='.$_POST[address].'" target="_blank" class="button2">View in EthScan</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="60" colspan="2" align="center">If you have any questions, please get in touch with our <a href="#" mailto="support@gogolcoin.io" style="text-decoration:none; color: #DDA46F;">support@gogolcoin.io</a></td>
  </tr>
</table>
`
</body>
</html>';

$mail->send();
        header('location:index.php?msg=success');

