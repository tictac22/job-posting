<?php

namespace Tests\Feature;

use App\Models\Posts;
use App\Services\FileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
	use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected $body = [
			'name' => 'eqwewq',
			'lastname' => 'ewqewqew',
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

	public function test_post_create()
	{	

		$file = UploadedFile::fake()->image('avatar.png');

		$this->mock(FileService::class, function(MockInterface $mock) use($file) {
			$mock->shouldReceive('upload')->andReturn('https://res.cloudinary.com/ddmcmjx3v/image/upload/v1671696020/my_uploads/testm5xw352ii1.jpg');
		});


		$response = $this->followingRedirects()->post('/create',[
			'company_name' => 'company_name',
            'job_title' => 'job_title',
			'location' => 'location',
			'tags' => '122222222',
			'logo' => $file,
			'description' => 'description',
		]);

		$response->assertSee('company_name');
		$response->assertSee('job_title');
		$response->assertSee('location');
		
		$this->assertDatabaseHas('posts', [
			'company_name' => 'company_name',
		]);

	}
}
