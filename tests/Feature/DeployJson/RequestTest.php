<?php

namespace Tests\Feature\DeployJson;

use Tests\TestCase;

class RequestTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->array = require 'FixtureJson.php';
        $this->json = json_encode($this->array);
    }

    /** @test */
    public function status_ok_on_get_request_with_correct_json_param_content()
    {
        $this->get('/?' . http_build_query([
            'json' => $this->json
        ]))->assertOk();
    }

    /** @test */
    public function status_ok_on_post_request_with_correct_json_param_content()
    {
        $this->post('/', [
            'json' => $this->json
        ])->assertOk();
    }

    /** @test */
    public function status_not_ok_on_get_request_with_incorrect_json_param_content()
    {
        $this->get('/?' . http_build_query([
            'json' => 'a'
        ]))->assertRedirect();
    }

    /** @test */
    public function status_not_ok_on_post_request_with_incorrect_json_param_content()
    {
        $this->post('/', [
            'json' => 'a'
        ])->assertRedirect();
    }
}
