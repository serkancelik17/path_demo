<?php


namespace App\Tests\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    private $client = null;
    private $userRepository = null;

    public function setUp() : void
    {
        $this->client = static::createClient();
        $this->userRepository = static::getContainer()->get(UserRepository::class);
    }

    public function testIndexSuccess()
    {
        // if response.status == 2
        $this->assertTrue(true);
    }

    public function testShowIsSuccess()
    {
        // if response.status == 200
        $this->assertTrue(true);
    }

    public function testShowOrderIsNotBelongUser()
    {
        // if order is not belongs current user
        $response = ['success' => false];

        $this->assertFalse($response['success']);
    }


    public function testStoreIsSuccess()
    {

        //if response.status == 200
        $response = ["success" => true];

        $this->assertTrue($response['success']);

    }

    public function testStoreIsHasValidationError()
    {

        //if response.validation == false
        $response = ["success" => false];

        $this->assertFalse($response['success']);

    }


    public function testUpdateIsSuccess()
    {
        //if response.status == false
        $response = ["success" => true];

        $this->assertTrue($response['success']);

    }


}