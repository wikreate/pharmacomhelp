<?
mysql_connect('localhost', '11', '22') or die('could not connect to k');
mysql_select_db("33");
$name=$mail=$phone=$skype='';

if ($_SERVER['REQUEST_METHOD']=='POST') {
	if (isset($_POST['username'])) $name=$_POST['username'];
	if (isset($_POST['email'])) $mail=$_POST['email'];
	if (isset($_POST['phone'])) $phone=$_POST['phone'];
	if (isset($_POST['skype'])) $skype=$_POST['skype'];

	$mailheaders  = 'MIME-Version: 1.0' . "\r\n";
	$mailheaders .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$mailheaders.="From: ".$mail."\r\nReply-To: info@".$_SERVER['HTTP_HOST'];

	$mailtext='';

	if (!empty($name)) $mailtext.='Имя: '.$name.'<br />';
	if (!empty($mail)) $mailtext.='e-mail: '.$mail.'<br />';
	if (!empty($phone)) $mailtext.='Телефон: '.$phone.'<br />';
	if (!empty($skype)) $mailtext.='Skype: '.$skype.'<br />';
	
	mail('info@betmaster.ru','Новая заявка на раскрутку',$mailtext,$mailheaders);

	echo 'Спасибо, мы свяжемся с вами в течении 24 часов.';
}
?>
