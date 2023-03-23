<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Http\Response;

class apiUnitTest extends TestCase
{
    use CreatesApplication;
    public function testCovidApi() : void
    {
        $this -> json( 'get', 'api/fill_data')
        ->assertStatus(Response::HTTP_OK)
        ->assertJson([
            "Message" => "Databases updated successfully!"
        ]);
    }
}
