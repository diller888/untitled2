<?php
if (!empty($_POST['phone'])) {
    $phones = preg_replace("/[^,.0-9]/", '', $_POST['phone']);
    if (strlen($phones) > 10) {
        $db->where("phone", $phones);
        $ankphone = $db->ObjectBuilder()->getOne("users");
        if ($ankphone->phone === $phones) {
            $err = 'Номер телефона уже зарегистрирован';
        } else {
            $sess->phone = $phones;
            array_push($dataUser, 'phone', $phones);
        }
    } else $err = 'Укажите номер телефона';
} else $err = 'Не указан телефон';