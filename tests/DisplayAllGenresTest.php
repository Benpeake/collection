<?php
use PHPUnit\Framework\TestCase;

require_once 'src/displayAllGenresFunction.php';

class DisplayAllGenresTest extends TestCase
{
    public function test_success_displayAllGenres()
    {
        //inputs
        $genres = [
            [
            'id' => 1,
            'name' => 'genre1'
            ]
        ];

        //expected
        $expected = "<option value=1>genre1</option>";

        //result
        $result = displayAllGenres($genres);

        //comparing
        $this->assertStringContainsString($expected, $result);
    }

}
