<?php

use PHPUnit\Framework\TestCase;

require_once 'src/displayAllRecordsFunction.php';
require_once 'src/generateFormSubmitErrorsFunction.php';

class DisplayAllRecordsTest extends TestCase
{
    public function test_success_displayAllRecords()
    {
        //inputs
        $records = [
            (object)[
                'album_name' => 'Album 1',
                'artist_name' => 'Artist 1',
                'release_year' => 2001,
                'genre_name' => 'Rock',
                'score' => 1,
                'img' => 'album1.jpg'
            ]
        ];
        //expected
        $expected =
            "<div class='albumContainer'>
            <img src='album1.jpg' alt='Album 1' width='300' height='300' >
            <div class='albumStats'>
                <p class='smallCopy'><strong>Album:</strong> Album 1</p>
                <p class='smallCopy'><strong>Artist:</strong> Artist 1</p>
                <p class='smallCopy'><strong>Year of release:</strong> 2001</p>
                <p class='smallCopy'><strong>Genre:</strong> Rock</p>
                <p class='smallCopy'><strong>Score:</strong> 1/10</p>
            </div>
        </div>";

        //result
        $result = displayAllRecords($records);

        //comparing
        $this->assertStringContainsString($expected, $result);
    }

    public function test_failure_displayAllRecords()
    {

        //?
        $formSubmission = generateFormSubmitErrors('', '', '', '', '', '');


        $this->assertArrayHasKey('albumName', $formSubmission);
        $this->assertArrayHasKey('artistName', $formSubmission);
        $this->assertArrayHasKey('releaseYear', $formSubmission);
        $this->assertArrayHasKey('genre', $formSubmission);
        $this->assertArrayHasKey('score', $formSubmission);
        $this->assertArrayHasKey('img', $formSubmission);
    }
}
