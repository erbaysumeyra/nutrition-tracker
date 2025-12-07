<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeTest extends TestCase
{
    use RefreshDatabase;

    public function test_recipe_index_displays_recipes(): void
    {
        $recipes = Recipe::factory()->count(3)->create();

        $response = $this->get('/recipes');

        $response->assertStatus(200);
        $response->assertSee($recipes[0]->name);
    }

    public function test_recipe_can_be_created(): void
    {
        $data = [
            'name' => 'Test recipe',
            'calories' => 100,
            'protein' => 10,
            'carbs' => 20,
            'fat' => 5,
            'fiber' => 3,
            'carbon_footprint' => 1.5,
            'description' => 'Test description',
        ];

        $response = $this->post('/recipes', $data);

        $response->assertRedirect('/recipes');
        $this->assertDatabaseHas('recipes', ['name' => 'Test recipe']);
    }
}
