<?php
namespace Tests\Unit\app\Commands;

use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\File;
use PHPUnit\Framework\Attributes\Test;

class CreateServiceCommandTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    #[Test]
    public function it_should_create_a_service_successfully()
    {
        $fileMock = Mockery::mock('alias:' . File::class);

        $fileMock->shouldReceive('isDirectory')
            ->once()
            ->with(app_path('Services/Auth'))
            ->andReturn(false);
        $fileMock->shouldReceive('makeDirectory')
            ->once()
            ->with(app_path('Services/Auth'), 0755, true, true);
        $fileMock->shouldReceive('exists')
            ->once()
            ->with(app_path('Services/Auth/ExampleService.php'))
            ->andReturn(false);
        $fileMock->shouldReceive('put')
            ->once()
            ->with(
                app_path('Services/Auth/ExampleService.php'),
                "<?php\n\nnamespace App\\Services\\Auth;\n\nclass ExampleService\n{\n    // Implement your service methods here\n}\n"
            );
        $this->artisan('make:service', ['name' => 'Auth/Example'])
            ->expectsOutput('Service ExampleService criado com sucesso em ' . app_path('Services/Auth') . '!')
            ->assertExitCode(0);
    }
}