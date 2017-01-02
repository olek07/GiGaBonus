<?php
namespace In2code\Powermail\Tests\Domain\Validator;

use TYPO3\CMS\Core\Tests\UnitTestCase;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Alex Kellner <alexander.kellner@in2code.de>, in2code.de
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * StringValidator Tests
 *
 * @package powermail
 * @license http://www.gnu.org/licenses/lgpl.html
 *          GNU Lesser General Public License, version 3 or later
 */
class StringValidatorTest extends UnitTestCase
{

    /**
     * @var \In2code\Powermail\Domain\Validator\StringValidator
     */
    protected $generalValidatorMock;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->generalValidatorMock = $this->getAccessibleMock(
            '\In2code\Powermail\Domain\Validator\StringValidator',
            ['dummy']
        );
    }

    /**
     * @return void
     */
    public function tearDown()
    {
        unset($this->generalValidatorMock);
    }

    /**
     * Dataprovider validateMandatoryForStringOrArrayReturnsBool()
     *
     * @return array
     */
    public function validateMandatoryForStringOrArrayReturnsBoolDataProvider()
    {
        return [
            'string "in2code.de"' => [
                'in2code.de',
                true
            ],
            'string "a"' => [
                'a',
                true
            ],
            'string empty' => [
                '',
                false
            ],
            'string "0"' => [
                '0',
                true
            ]
        ];
    }

    /**
     * Test for validateMandatory()
     *
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateMandatoryForStringOrArrayReturnsBoolDataProvider
     * @test
     */
    public function validateMandatoryForStringOrArrayReturnsBool($value, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateMandatory', $value);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateEmailReturnsBool()
     *
     * @return array
     */
    public function validateEmailReturnsBoolDataProvider()
    {
        return [
            'email' => [
                'alexander.kellner@in2code.de',
                true
            ],
            'email2' => [
                'www.alexander.kellner@in2code.de',
                true
            ],
            'email3' => [
                'alex@subdomain1.subdomain2.in2code.de',
                true
            ],
            'email4' => [
                'www.alexander.kellner@subdomain1.subdomain2.in2code.de',
                true
            ],
            'email5' => [
                'alex@lalala.',
                false
            ],
            'email6' => [
                'alex@lalala',
                false
            ],
            'email7' => [
                'alex.lalala.de',
                false
            ],
            'email8' => [
                'alex',
                false
            ],
        ];
    }

    /**
     * Test for validateEmail()
     *
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateEmailReturnsBoolDataProvider
     * @test
     */
    public function validateEmailReturnsBool($value, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateEmail', $value);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateUrlReturnsBool()
     *
     * @return array
     */
    public function validateUrlReturnsBoolDataProvider()
    {
        return [
            'url1' => [
                'http://www.test.de',
                true
            ],
            'url2' => [
                'www.test.de',
                false
            ],
            'url3' => [
                'test.de',
                false
            ],
            'url4' => [
                'https://www.test.de',
                true
            ],
            'url5' => [
                'https://www.test.de',
                true
            ],
            'url6' => [
                'ftp://www.test.de',
                true
            ],
            'url7' => [
                'test',
                false
            ],
        ];
    }

    /**
     * Test for validateUrl()
     *
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateUrlReturnsBoolDataProvider
     * @test
     */
    public function validateUrlReturnsBool($value, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateUrl', $value);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validatePhoneReturnsBool()
     *
     * @return array
     */
    public function validatePhoneReturnsBoolDataProvider()
    {
        return [
            'phone1' => [
                '01234567890',
                true
            ],
            'phone2' => [
                '0123 4567890',
                true
            ],
            'phone3' => [
                '0123 456 789',
                true
            ],
            'phone4' => [
                '(0123) 45678 - 90',
                true
            ],
            'phone5' => [
                '0012 345 678 9012',
                true
            ],
            'phone6' => [
                '0012 (0)345 / 67890 - 12',
                true
            ],
            'phone7' => [
                '+123456789012',
                true
            ],
            'phone8' => [
                '+12 345 678 9012',
                true
            ],
            'phone9' => [
                '+12 3456 7890123',
                true
            ],
            'phone10' => [
                '+49 (0) 123 3456789',
                true
            ],
            'phone11' => [
                '+49 (0)123 / 34567 - 89',
                true
            ],
            'phone12' => [
                'a123546',
                false
            ],
            'phone13' => [
                '12(3)45',
                false
            ],
            'phone14' => [
                'ab cd ef',
                false
            ],
            'phone15' => [
                '0 123 456 7890',
                false
            ],
            'phone16' => [
                '+49 (0) 36 43/58 xx xx',
                false
            ],
            'phone17' => [
                '+3a',
                false
            ],
            'phone18' => [
                '0',
                false
            ],
            'phone19' => [
                0,
                false
            ],
        ];
    }

    /**
     * Test for validatePhone()
     *
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validatePhoneReturnsBoolDataProvider
     * @test
     */
    public function validatePhoneReturnsBool($value, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validatePhone', $value);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateNumbersOnlyReturnsBool()
     *
     * @return array
     */
    public function validateNumbersOnlyReturnsBoolDataProvider()
    {
        return [
            'number1' => [
                '123453',
                true
            ],
            'number2' => [
                'abc',
                false
            ],
            'number3' => [
                '123a',
                false
            ],
            'number4' => [
                'a1234',
                false
            ],
            'number5' => [
                '1234 5678',
                false
            ],
            'number6' => [
                123453,
                true
            ],
        ];
    }

    /**
     * Test for validateNumbersOnly()
     *
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateNumbersOnlyReturnsBoolDataProvider
     * @test
     */
    public function validateNumbersOnlyReturnsBool($value, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateNumbersOnly', $value);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateLettersOnlyReturnsBool()
     *
     * @return array
     */
    public function validateLettersOnlyReturnsBoolDataProvider()
    {
        return [
            'letter1' => [
                '123453',
                false
            ],
            'letter2' => [
                12345,
                false
            ],
            'letter3' => [
                'abcdef',
                true
            ],
            'letter4' => [
                'abc def',
                false
            ],
            'letter5' => [
                '1abcdef',
                false
            ],
            'letter6' => [
                'abcdef1',
                false
            ],
            'letter7' => [
                'abcdefäöüßÄ',
                false
            ],
            'letter8' => [
                'abd+d',
                false
            ],
            'letter9' => [
                'abd.d',
                false
            ],
        ];
    }

    /**
     * Test for validateLettersOnly()
     *
     * @param string $value
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateLettersOnlyReturnsBoolDataProvider
     * @test
     */
    public function validateLettersOnlyReturnsBool($value, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateLettersOnly', $value);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateMinNumberReturnsBool()
     *
     * @return array
     */
    public function validateMinNumberReturnsBoolDataProvider()
    {
        return [
            'minimum1' => [
                '8',
                '1',
                true
            ],
            'minimum2' => [
                '1',
                '8',
                false
            ],
            'minimum3' => [
                '4582',
                '4581',
                true
            ],
            'minimum4' => [
                '0',
                '0',
                true
            ],
            'minimum5' => [
                '-1',
                '1',
                false
            ],
            'minimum6' => [
                '6.5',
                '6',
                true
            ],
            'minimum7' => [
                5,
                4,
                true
            ],
            'minimum8' => [
                4,
                5,
                false
            ],
            'minimum9' => [
                5,
                5,
                true
            ],
        ];
    }

    /**
     * Test for validateMinNumber()
     *
     * @param string $value
     * @param string $configuration
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateMinNumberReturnsBoolDataProvider
     * @test
     */
    public function validateMinNumberReturnsBool($value, $configuration, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateMinNumber', $value, $configuration);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateMaxNumberReturnsBool()
     *
     * @return array
     */
    public function validateMaxNumberReturnsBoolDataProvider()
    {
        return [
            'maximum1' => [
                '8',
                '1',
                false
            ],
            'maximum2' => [
                '1',
                '8',
                true
            ],
            'maximum3' => [
                '4582',
                '4581',
                false
            ],
            'maximum4' => [
                '0',
                '0',
                true
            ],
            'maximum5' => [
                '-1',
                '1',
                true
            ],
            'maximum6' => [
                '6.5',
                '6',
                false
            ],
            'maximum7' => [
                5,
                4,
                false
            ],
            'maximum8' => [
                4,
                5,
                true
            ],
            'maximum9' => [
                5,
                5,
                true
            ],
        ];
    }

    /**
     * Test for validateMaxNumber()
     *
     * @param string $value
     * @param string $configuration
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateMaxNumberReturnsBoolDataProvider
     * @test
     */
    public function validateMaxNumberReturnsBool($value, $configuration, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateMaxNumber', $value, $configuration);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateRangeReturnsBool()
     *
     * @return array
     */
    public function validateRangeReturnsBoolDataProvider()
    {
        return [
            'range1' => [
                '8',
                '1,10',
                true
            ],
            'range2' => [
                '507',
                '506,508',
                true
            ],
            'range3' => [
                '0',
                '0,0',
                true
            ],
            'range4' => [
                '5',
                '10',
                true
            ],
            'range5' => [
                '15',
                '10',
                false
            ],
            'range6' => [
                88,
                5,
                false
            ],
            'range7' => [
                5,
                '5,6',
                true
            ],
            'range8' => [
                6,
                '5,6',
                true
            ],
        ];
    }

    /**
     * Test for validateRange()
     *
     * @param string $value
     * @param string $configuration
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateRangeReturnsBoolDataProvider
     * @test
     */
    public function validateRangeReturnsBool($value, $configuration, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateRange', $value, $configuration);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validateLengthReturnsBool()
     *
     * @return array
     */
    public function validateLengthReturnsBoolDataProvider()
    {
        return [
            'length1' => [
                'abc',
                '1,10',
                true
            ],
            'length2' => [
                'abcdefghijklmnopq',
                '1,10',
                false
            ],
            'length3' => [
                '',
                '1,10',
                false
            ],
            'length4' => [
                12345,
                '1,10',
                true
            ],
            'length5' => [
                12345,
                '10',
                true
            ],
            'length6' => [
                '12345',
                '10',
                true
            ],
            'length7' => [
                '12345',
                '1',
                false
            ],
            'length8' => [
                '12345',
                '1',
                false
            ],
        ];
    }

    /**
     * Test for validateLength()
     *
     * @param string $value
     * @param string $configuration
     * @param bool $expectedResult
     * @return void
     * @dataProvider validateLengthReturnsBoolDataProvider
     * @test
     */
    public function validateLengthReturnsBool($value, $configuration, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validateLength', $value, $configuration);
        $this->assertSame($expectedResult, $result);
    }

    /**
     * Dataprovider validatePatternReturnsBool()
     *
     * @return array
     */
    public function validatePatternReturnsBoolDataProvider()
    {
        return [
            'pattern1' => [
                'https://www.test.de',
                'https?://.+',
                true
            ],
            'pattern2' => [
                'http://www.test.de/test/lalal.html',
                'https?://.+',
                true
            ],
            'pattern3' => [
                'email@email.org',
                'https?://.+',
                false
            ],
            'pattern4' => [
                'abcd',
                'https?://.+',
                false
            ],
            'pattern5' => [
                1345,
                'https?://.+',
                false
            ],
            'pattern6' => [
                12345,
                '[0-9]{5}',
                true
            ],
            'pattern7' => [
                1234,
                '[0-9]{5}',
                false
            ],
        ];
    }

    /**
     * Test for validatePattern()
     *
     * @param string $value
     * @param string $configuration
     * @param bool $expectedResult
     * @return void
     * @dataProvider validatePatternReturnsBoolDataProvider
     * @test
     */
    public function validatePatternReturnsBool($value, $configuration, $expectedResult)
    {
        $result = $this->generalValidatorMock->_callRef('validatePattern', $value, $configuration);
        $this->assertSame($expectedResult, $result);
    }
}
