<?php

namespace Tests\Feature\DeployJson;

use Tests\TestCase;

class DeployTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $array = require 'FixtureJson.php';
        $this->json = json_encode($array);
    }

    /** @test */
    public function json_is_only_one_level_open_when_depth_param_is_absent()
    {
        $query = http_build_query([
            'json' => $this->json
        ]);

        $this->get("/?$query")->assertDontSee('open');
    }

    /** @test */
    public function json_is_more_than_one_level_open_when_depth_param_equals_two()
    {
        $query = http_build_query([
            'json' => $this->json,
            'depth' => 2
        ]);

        $this->get("/?$query")->assertSee('open');
    }

    /** @test */
    public function null_and_booleans_are_visible_as_words()
    {
        $query = http_build_query([
            'json' => $this->json
        ]);

        $result = $this->get("/?$query");

        $result->assertSee('true');
        $result->assertSee('false');
        $result->assertSee('null');
    }
}
