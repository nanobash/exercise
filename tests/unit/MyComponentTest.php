<?php

namespace app\tests\unit;

use app\components\MyComponent;

class MyComponentTest extends \Codeception\Test\Unit
{
    /**
     * @param $personalCode
     * @param $actual
     *
     * @dataProvider ageFromPersonalCodeProvider
     */
    public function testGetCorrectAgeFromPersonalCode($personalCode, $actual)
    {
        require_once 'components/MyComponent.php';
        $expected = MyComponent::getAgeFromPersonCode($personalCode);

        $this->assertEquals($expected, $actual);
    }

    public function ageFromPersonalCodeProvider()
    {
        return [
            ['47605160281', 41],
            ['38203143712', 35],
            ['49106230367', 26],
            ['49304254911', 24],
            ['48305063725', 34],
            ['48212130321', 34], // !IMPORTANT! After 12th month of the year this test will fail.
        ];
    }

    /**
     * @param $personalCode
     * @param $actual
     *
     * @dataProvider userIsNotUnderageProvider
     */
    public function testUserIsNotUnderage($personalCode, $actual)
    {
        require_once 'components/MyComponent.php';

        if (MyComponent::getAgeFromPersonCode($personalCode) < 18) { // underage
            $this->assertEquals(false, $actual);
        } else { // adult
            $this->assertEquals(true, $actual);
        }
    }

    public function userIsNotUnderageProvider()
    {
        return [
            ['38101310214', true],
            ['48510037011', true],
            ['39103024722', true],
            ['31203024722', false],
            ['31003024722', false],
            ['30103024722', false],
        ];
    }
}
