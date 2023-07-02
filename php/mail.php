<?php
// Файлы phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$tariff = $_POST['tariff'];

// Формирование самого письма
$title = "С сайта Баталов №8";
$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Почта:</b> $email<br>
<b>Услуга:</b> $subject<br>
<b>Сообщение:</b> $message<br>
<b>Тариф:</b> $tariff<br>
";

// Настройки PHPMailer
//$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail = new PHPMailer;  
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    //$mail->SMTPDebug = 2;
   // $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->isSMTP();
    $mail->Host = 'ssl://smtp.yandex.ru';
    $mail->SMTPAuth     = true;
    $mail->Username     = 'info@sitemaket.ru'; // Если почта для домена, то логин это полный адрес почты
    $mail->Password     = 'peambiawfonvztyj';
    $mail->SMTPSecure = 'tls';
    $mail->Port         = 465;

    //ОТ кого
    $mail->setFrom('info@sitemaket.ru', 'MassageLive'); 

    // Получатель письма
    $mail->addAddress('s.povar@sitemaket.ru');


    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    

// Проверяем отравленность сообщения
    if ($mail->send()) {$result = "success";} 
    else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

?>