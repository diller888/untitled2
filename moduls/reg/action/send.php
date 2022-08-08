<?php
require H . 'app/inc/func/phpmailer/PHPMailer.php';
require H . 'app/inc/func/phpmailer/SMTP.php';
require H . 'app/inc/func/phpmailer/Exception.php';

$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $smtp = 'smtp.yandex.ru';
    $loginmail = $set->loginmail;
    $passmail = $set->passmail;

    $msg = "ok";
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;

    $mail->Host = $smtp;
    $mail->Username = $loginmail;
    $mail->Password = $passmail;
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom($loginmail . '@yandex.ru', $set->company);

    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Успешная регистрация';
    $mail->Body = '<h3>Успешная регистрация</h3>
<p>Вы успешно зарегистрировались на сайте <a href="https://'.$_SERVER['SERVER_NAME'].'">'.$set->company.'</a></p>
<div style="width: 100%;box-sizing:border-box;font-weight: bold;padding:2em;botder-radius:4px;background: #F7F7F7;text-align: center">Ваш логин: ' . $login . '<br />Ваш пароль: ' . $password . '</div>
<p>Желаем вам успехов</p>';
    $mail->send();
} catch (Exception $e) {

}
