<?php
define("H", $_SERVER["DOCUMENT_ROOT"] . '/');
require_once H . 'app/inc/core.php';

require H . 'app/inc/func/phpmailer/PHPMailer.php';
require H . 'app/inc/func/phpmailer/SMTP.php';
require H . 'app/inc/func/phpmailer/Exception.php';

if (!empty($_POST['login'])) {
    if (!preg_match("#^([A-zА-я0-9\-\_\ ])+$#ui", $_POST['login'])) $err = 'В логине присутствуют запрещенные символы';
    if (preg_match("#[a-z]+#ui", $_POST['login']) && preg_match("#[а-я]+#ui", $_POST['login'])) $err = 'Разрешается использовать символы только русского или только английского алфавита';
    if (preg_match("#(^\ )|(\ $)#ui", $_POST['login'])) $err = 'Запрещено использовать пробел в начале и конце ника';
    if (strlen($_POST['login']) < 3) $err = 'Короткий логин';
    if (strlen($_POST['login']) > 64) $err = 'Длина логина превышает 64 символа';
    $login = $_POST['login'];
}
if (!empty($_POST['chislo'])) {
    $chislo = intval($_POST['chislo']);
    if (strlen($chislo) != 5) $err = 'Не указано проверочное число';
    if ($chislo != $sess->captcha) $err = 'Не верно указано проверочное число';
} else {
    $err = 'Вы не ввели проверочное число';
}

if (!isset($err)) {

    $email = '';
    $ank = $db->selectOne("users", "login", $login);
    if ($ank->login === $login) {
        $email = $ank->email;
    } else {
        if ($ank->email === $login) {
            $email = $ank->email;
        } else {
            if ($ank->phone === $login) {
                $email = $ank->email;
            }
        }
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
            $mail->Subject = 'Восстановление пароля';
            $mail->Body = '<h3>Восстановление пароля</h3>
<p>Уважаемый(ая), ' . $ank->name . '. Вы сделали запрос забытого пароля на сайте <a href="https://' . $_SERVER['SERVER_NAME'] . '">' . $set->company . '</a></p>
<div style="width: 100%;box-sizing:border-box;font-weight: bold;padding:2em;botder-radius:4px;background: #F7F7F7;text-align: center">Ваш пароль: ' . $ank->password . '</div>
<p>Если вы не делали запроса на восстановление пароля, то просто удалите это сообщение. Ваш пароль хранится в надежном месте.</p>';
            if ($mail->send()) {
                $ims = explode('@', $email);
                $c_n = strlen($ims[0]);
                $c_name = $c_n - 3;
                $rest = substr($ims[0], 0, -$c_name);
                $info_name = $rest . '' . str_repeat("*", $c_name);
                $msg = 'Пароль был отправлен на почту ' . $info_name . '@' . $ims[1];
                echo json_encode(array('result' => 'success', 'msg' => $msg));
            } else
                echo json_encode(array('result' => 'error', 'msg' => 'Почта не была отправлена'));

        } catch (Exception $e) {
            echo json_encode(array('result' => 'error', 'msg' => 'Message could not be sent'));
        }

    } else
        echo json_encode(array('result' => 'error', 'msg' => 'Email не найден'));

} else
    echo json_encode(array('result' => 'error', 'msg' => $err));
