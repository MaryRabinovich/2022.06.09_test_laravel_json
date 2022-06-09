<?php

namespace Tests\Feature\DeployJson;

use Tests\TestCase;

class BackgroundTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $array = require 'FixtureJson.php';
        $this->json = json_encode($array);

        $this->absoluteUrl = 'https://mnogo-krolikov.ru/wp-content/uploads/2019/06/https-murkoshka-ru-wp-content-uploads-1467565784.jpeg';
        $this->relativeUrl = 'parchment.jpeg';
        $this->bgcolor = '(1,2,3)';
    }

    /** @test */
    public function renders_background_with_absolute_url_on_get_request()
    {
        $query = http_build_query([
            'json' => $this->json,
            'background' => $this->absoluteUrl
        ]);

        $this->get("/?$query")->assertSee("url('$this->absoluteUrl')");
    }

    /** @test */
    public function renders_background_with_absolute_url_on_post_request()
    {
        $this->post('/', [
            'json' => $this->json,
            'background' => $this->absoluteUrl
        ])->assertSee("url('$this->absoluteUrl')");
    }

    /** @test */
    public function renders_background_with_relative_url_on_get_request()
    {
        $query = http_build_query([
            'json' => $this->json,
            'background' => $this->relativeUrl
        ]);

        $this->get("/?$query")->assertSee("url(");
        $this->get("/?$query")->assertSee("$this->relativeUrl");
    }

    /** @test */
    public function renders_background_with_relative_url_on_post_request()
    {
        $this->post('/', [
            'json' => $this->json,
            'background' => $this->relativeUrl
        ])->assertSee("$this->relativeUrl");
    }

    /** @test */
    public function renders_background_with_bgcolor_on_get_request()
    {
        $query = http_build_query([
            'json' => $this->json,
            'background' => $this->bgcolor
        ]);

        $this->get("/?$query")->assertSee($this->bgcolor);
    }

    /** @test */
    public function renders_background_with_bgcolor_on_post_request()
    {
        $this->post('/', [
            'json' => $this->json,
            'background' => $this->bgcolor
        ])->assertSee($this->bgcolor);
    }
}
