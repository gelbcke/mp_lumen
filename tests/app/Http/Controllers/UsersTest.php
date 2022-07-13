
<?php

use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * api/users [GET]
     */
    public function testShouldReturnAllUsers()
    {
        $this->get("api/users", []);
        $this->seeStatusCode(200);
    }

    /**
     * api/users/id [GET]
     */
    public function testShouldReturnUsers()
    {
        $this->get("api/users/1", []);
        $this->seeStatusCode(200);
    }

    /**
     * api/users [POST]
     */
    public function testShouldCreateUsers()
    {
        $parameters = [
            'name' => 'Sr. Jhon Dow',
            'email' => 'jhon@doe.com',
            'password' => 'secret'
        ];

        $this->post("api/users", $parameters, []);
        $this->seeStatusCode(201);
    }

    /**
     * api/users/id [PUT]
     */
    public function testShouldUpdateUsers()
    {
        $parameters = [
            'email' => 'jhon2@dow.com',
            'password' => 123456
        ];

        $this->put("api/users/4/", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * api/users/id [DELETE]
     */
    public function testShouldDeleteUsers()
    {
        $this->delete("api/users/2/");
        $this->seeStatusCode(410);
    }
}
