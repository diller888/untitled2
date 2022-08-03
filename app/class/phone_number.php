<?php

class phone_number
{

    public $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    public function mobile()
    {

        $string = $this->str;
        $string = str_replace(' ', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('-', '', $string);
        $string = str_replace('+', '', $string);
        $n = $string[0];
        if ($n == 8) {
            $p2 = $string[1];
            $p3 = $string[2];
            $p4 = $string[3];
            $pp = $string[4];
            $pp2 = $string[5];
            $pp3 = $string[6];
            $r = $string[7];
            $r2 = $string[8];
            $r3 = $string[9];
            $r4 = $string[10];
            $str = '+7 (' . $p2 . '' . $p3 . '' . $p4 . ') ' . $pp . '' . $pp2 . '' . $pp3 . ' ' . $r . '' . $r2 . '-' . $r3 . '' . $r4;
        } elseif ($n == 7) {
            $p2 = $string[1];
            $p3 = $string[2];
            $p4 = $string[3];
            $pp = $string[4];
            $pp2 = $string[5];
            $pp3 = $string[6];
            $r = $string[7];
            $r2 = $string[8];
            $r3 = $string[9];
            $r4 = $string[10];
            $str = '+7 (' . $p2 . '' . $p3 . '' . $p4 . ') ' . $pp . '' . $pp2 . '' . $pp3 . ' ' . $r . '' . $r2 . '-' . $r3 . '' . $r4;
        } else {
            $p2 = $string[1];
            $p3 = $string[2];
            $p4 = $string[3];
            $pp = $string[4];
            $pp2 = $string[5];
            $pp3 = $string[6];
            $r = $string[7];
            $r2 = $string[8];
            $r3 = $string[9];
            if (isset($r4)) {
                $str = '+7 (' . $p2 . '' . $p3 . '' . $p4 . ') ' . $pp . '' . $pp2 . '' . $pp3 . ' ' . $r . '' . $r2 . '-' . $r3 . '' . $r4;
            } else {
                $str = 'номер телефона';
            }
        }
        return $str;

    }

    public function city()
    {

        $string = $this->str;
        $string = str_replace(' ', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('-', '', $string);
        $n = $string[0];
        if ($n == 8) {
            $p2 = $string[1];
            $p3 = $string[2];
            $p4 = $string[3];
            $pp = $string[4];
            $pp2 = $string[5];
            $pp3 = $string[6];
            $r = $string[7];
            $r2 = $string[8];
            $r3 = $string[9];
            $r4 = $string[10];
            $str = '+7 (' . $p2 . '' . $p3 . '' . $p4 . '' . $pp . ') ' . $pp2 . '' . $pp3 . ' ' . $r . '' . $r2 . ' ' . $r3 . '' . $r4;
        } elseif ($n == 7) {
            $p2 = $string[1];
            $p3 = $string[2];
            $p4 = $string[3];
            $pp = $string[4];
            $pp2 = $string[5];
            $pp3 = $string[6];
            $r = $string[7];
            $r2 = $string[8];
            $r3 = $string[9];
            $r4 = $string[10];
            $str = '+7 (' . $p2 . '' . $p3 . '' . $p4 . '' . $pp . ') ' . $pp2 . '' . $pp3 . ' ' . $r . '' . $r2 . ' ' . $r3 . '' . $r4;
        } else {
            $p2 = $string[1];
            $p3 = $string[2];
            $p4 = $string[3];
            $pp = $string[4];
            $pp2 = $string[5];
            $pp3 = $string[6];
            $r = $string[7];
            $r2 = $string[8];
            $r3 = $string[9];
            if (isset($r4)) {
                $str = '+7 (' . $p2 . '' . $p3 . '' . $p4 . '' . $pp . ') ' . $pp2 . '' . $pp3 . ' ' . $r . '' . $r2 . ' ' . $r3 . '' . $r4;
            } else {
                $str = 'номер телефона';
            }
        }
        return $str;
    }

}

?>