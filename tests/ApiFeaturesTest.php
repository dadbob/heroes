<?php

class ApiFeaturesTest extends TestCase
{

    public function testSuccessfulHeroCreation()
    {
        $userData = [
            "publisher" => "Marvel 3",
            "real_name" => "Jane 5",
            "hero_name" => "Doe 5",
            "appearance_at" => "2021-04-03",
            "powers" => ["data" => [["id" => 1], ["id" => 3]]],
            "teams" => ["data" => [["id" => 4], ["id" => 2]]],
        ];

        $this->json('POST', 'api/heroes', $userData, ['Accept' => 'application/json'])
            ->seeJsonStructure([
                "status",
                "data" => [
                    "id",
                    "real_name",
                    "hero_name",
                    "publisher",
                    "appearance_at",
                ],
                "teams" => ["data" => [["id"], ["id"]]],
                "powers" => ["data" => [["id"], ["id"]]],
            ]);

    }

    public function testSuccessfulHeroUpdate()
    {
        $userData = [
            "publisher" => "Marvel 6",
            "real_name" => "Jane 6",
            "hero_name" => "Doe 6",
            "appearance_at" => "2021-04-03",
            "powers" => ["data" => [["id" => 1], ["id" => 3]]],
            "teams" => ["data" => [["id" => 4], ["id" => 2]]],
        ];

        $this->json('PUT', 'api/heroes/5', $userData, ['Accept' => 'application/json'])
            ->assertResponseStatus(200);
    }

    public function testSuccessfulHeroDelete()
    {
        $this->json('DELETE', 'api/heroes/2', [], ['Accept' => 'application/json'])
            ->assertResponseStatus(200);
    }

    public function testSuccessfulHero()
    {
        $this->json('GET', 'api/heroes/3', [], ['Accept' => 'application/json'])
            ->seeJsonStructure(
                [
                    "status",
                    "data" => [
                        [
                            "id",
                            "real_name",
                            "hero_name",
                            "publisher",
                            "appearance_at",
                            "created_at",
                            "updated_at",
                        ],
                    ],
                    "teams" => ["data" => [["id"], ["id"]]],
                    "powers" => ["data" => [["id"], ["id"]]],
                ]
            );
    }

    public function testSuccessfulHeroAll()
    {
        $this->json('GET', 'api/heroes/', [], ['Accept' => 'application/json'])
            ->seeJsonStructure(
                [
                    "status",
                    "data" => [
                        [
                            "id",
                            "real_name",
                            "hero_name",
                            "publisher",
                            "appearance_at",
                            "created_at",
                            "updated_at",
                        ],
                    ],
                    "teams" => ["data" => [["id"], ["id"]]],
                    "powers" => ["data" => [["id"], ["id"]]],
                ]
            );
    }



    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }
}
