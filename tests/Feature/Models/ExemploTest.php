<?php
declare(strict_types=1);

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExemploTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    private $path = '/api/exemplos';
    private $model = \App\Models\Exemplo::class;
    private $table = 'exemplos';

    public function test_create_ExemploTest()
    {
        $data = $this->model::factory()->make();

        $this->postJson($this->path, ['data' => $data->toArray()])->assertCreated();

        $this->assertDatabaseHas($this->table, $data->toArray());
    }

    public function test_show_ExemploTest()
    {
        $data = $this->model::factory()->create();

        $this->get($this->path . '/' .  $data->id)->assertOk();
    }

    public function test_update_ExemploTest()
    {
        $data = $this->model::factory()->create();
        $newData = $this->model::factory()->make();

        $this->putJson($this->path . '/' . $data->id, ['data' => $newData->toArray()])->assertOk();
    }

    public function test_list_ExemploTest()
    {
        $this->model::factory()->count(10)->create();
        $this->get($this->path)
            ->assertOk();
    }

    public function test_delete_ExemploTest()
    {
        $data = $this->model::factory()->create();
        $this->delete($this->path . '/' . $data->id)
            ->assertNoContent();

        $this->assertDatabaseCount($this->table, 0);
    }

}
