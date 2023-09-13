<?php
use PHPUnit\Framework\TestCase;

require_once 'index.php';

class DisplayAllRecordsTest extends TestCase
{
    public function test_success_GenerateFormSubmitErrors()
    {

        //expected
        $expected = [];

        //result
            $result = generateFormSubmitErrors(
            'Album name',
            'Artist name',
            '2020',
            1,
            1,
            'https://image.com/.jpg'
        );

        //comparing
        $this->assertEquals($expected, $result);
    }

}
