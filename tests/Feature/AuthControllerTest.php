<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
	use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
	protected $body = [
			'name' => 'Artjoms',
			'lastname' => 'Fomins',
            'email' => 'test@test.com',
            'password' => 'lalalalalKAKKKSKSKSKsdasdsa',
			'password_confirmation' => 'lalalalalKAKKKSKSKSKsdasdsa'
	];
	protected function setUp(): void
	{	
		parent::setUp();
		$response = $this->post('/auth/register',$this->body);		
		$response->assertStatus(302);	
	}
	public function boot()
	{
		
	}
	
	public function test_user_registration_without_body()
	{
		$response = $this->post('/auth/register',[]);		
		$response->assertStatus(400);
	}

	public function test_user_registration()
	{
		
		$this->assertDatabaseHas('user', [
			'email' => 'test@test.com',
		]);
		$response = $this->post('/auth/register',$this->body)->assertJson(fn(AssertableJson $json) => $json->where('email',[0 => 'The email has already been taken.']));		
		$response->assertStatus(400);
	}

	public function test_user_login()
	{
		
		$response = $this->post('/auth/login',[
			'email' => 'test@test.com',
			'password'=>'dsadsadasdsADWDWDWDsdsdsds'
		]);
		$response->assertJson(fn(AssertableJson $json) => $json->where('email','email or password are incorrects'));		
		$response->assertStatus(400);
	}

	public function test_user_logout()
	{
		$response = $this->post('/auth/logout',[]);		
		$response->assertRedirectToRoute('index');

		$this->get('/manage')->assertRedirectToRoute('login');
	}
}
