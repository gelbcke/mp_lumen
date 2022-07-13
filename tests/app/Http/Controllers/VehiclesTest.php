
<?php

use Tests\TestCase;

class VehiclesTest extends TestCase
{
    /**
     * api/vehicles [GET]
     */
    public function testShouldReturnAllVehicles()
    {
        $this->get("api/vehicles", []);
        $this->seeStatusCode(200);
    }

    /**
     * api/vehicles/id [GET]
     */
    public function testShouldReturnVehicle()
    {
        $this->get("api/vehicles/1", []);
        $this->seeStatusCode(200);
    }

    /**
     * api/vehicles [POST]
     */
    public function testShouldCreateVehicle()
    {
        $parameters = [
            'brand' => 'Volkswagen',
            'model' => 'Fusca',
            'plate' => 'BBB8899'
        ];

        $this->post("api/vehicles", $parameters, []);
        $this->seeStatusCode(201);
    }

    /**
     * api/vehicles/id [PUT]
     */
    public function testShouldUpdateVehicle()
    {
        $parameters = [
            'brand' => 'FORD',
            'model' => 'Focus',
            'user_id' => 1
        ];

        $this->put("api/vehicles/4/", $parameters, []);
        $this->seeStatusCode(200);
    }

    /**
     * api/vehicles/id [DELETE]
     */
    public function testShouldDeleteVehicle()
    {
        $this->delete("api/vehicles/2/");
        $this->seeStatusCode(410);
    }
}
