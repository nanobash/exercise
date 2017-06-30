<?php

namespace app\components;

class MyComponent extends \yii\base\Component
{
    public static function getAgeFromPersonCode($personalCode) {
        $dobIdentifier = substr($personalCode, 1, 6);

        $year = substr($dobIdentifier, 0, 2);
        $year = ($year > 16) ? 19 . $year : 20 . $year;

        $month = substr($dobIdentifier, 2, 2);
        $day = substr($dobIdentifier, 4);

        $dob = new \DateTime($year.'-'.$month.'-'.$day);
        $now = new \DateTime('now');

        return $dob->diff($now)->y;
    }
}
