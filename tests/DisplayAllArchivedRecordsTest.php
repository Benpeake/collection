<?php

use PHPUnit\Framework\TestCase;
use Collection\Record;

require_once 'src/dispayAllArchivedRecordsFunction.php';
require_once 'src/Record.php';

class DisplayAllArchivedRecordsTest extends TestCase
{
    public function test_success_displayAllRecords()
    {
        // record instance 
        $record = new Record(
            1,
            'Album 1',
            'Artist 1',
            2001,
            1,
            'album1.jpg',
            0,
            'Rock',
            1
        );

        //inputs
        $records = [$record];

        //expected
        $expected =
            "<div class='archivedContainer'>
                <form method='POST'>
                    <input type='submit' value='Return' name='return' class='returnButton' />
                    <input type='hidden' name='recordID' value='1' />
                </form>     
            <div class='albumContainer archived'>
            <img src='album1.jpg' alt='Album 1' width='300' height='300' >
            <div class='albumStats'>
                <p class='smallCopy'><strong>Album:</strong> Album 1</p>
                <p class='smallCopy'><strong>Artist:</strong> Artist 1</p>
                <p class='smallCopy'><strong>Year of release:</strong> 2001</p>
                <div class='genre-input'><p class='smallCopy'><strong>Genre:</strong> Rock</p><div class='dot Rock'></div></div>
                <p class='smallCopy'><strong>Score:</strong> 1/10</p>
                <div class='buttonContainer'>    
                </div>
            </div>
          </div>
        </div>";

        //result
        $result = displayAllArchivedRecords($records);

        //comparing
        $this->assertStringContainsString($expected, $result);
    }
}
