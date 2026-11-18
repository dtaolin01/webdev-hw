<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_valid_product_can_be_created(): void
    {
        $this->post(route('products.store'), [
            'name' => 'Kopi Susu',
            'price' => 15000,
            'description' => 'Enak',
        ])->assertRedirect(route('products.index'))->assertSessionHasNoErrors();

        $this->assertDatabaseHas('products', ['name' => 'Kopi Susu', 'price' => 15000]);
    }

    public function test_required_fields_are_validated(): void
    {
        $this->post(route('products.store'), [])
            ->assertSessionHasErrors(['name', 'price']);

        $this->assertDatabaseCount('products', 0);
    }

    public function test_name_must_be_at_least_three_characters(): void
    {
        $this->post(route('products.store'), ['name' => 'AB', 'price' => 1000])
            ->assertSessionHasErrors('name');
    }

    public function test_price_must_be_a_positive_integer_within_limit(): void
    {
        foreach (['abc', 0, -5, 12.5, 1000000000] as $price) {
            $this->post(route('products.store'), ['name' => 'Teh Manis', 'price' => $price])
                ->assertSessionHasErrors('price');
        }
    }

    public function test_description_is_limited_to_1000_characters(): void
    {
        $this->post(route('products.store'), [
            'name' => 'Teh Manis',
            'price' => 5000,
            'description' => str_repeat('a', 1001),
        ])->assertSessionHasErrors('description');
    }

    public function test_name_must_be_unique(): void
    {
        Product::create(['name' => 'Kopi Susu', 'price' => 15000]);

        $this->post(route('products.store'), ['name' => 'Kopi Susu', 'price' => 20000])
            ->assertSessionHasErrors('name');
    }

    public function test_update_keeps_its_own_name_but_rejects_another_products_name(): void
    {
        $kopi = Product::create(['name' => 'Kopi Susu', 'price' => 15000]);
        Product::create(['name' => 'Teh Manis', 'price' => 5000]);

        $this->put(route('products.update', $kopi), ['name' => 'Kopi Susu', 'price' => 18000])
            ->assertSessionHasNoErrors();

        $this->put(route('products.update', $kopi), ['name' => 'Teh Manis', 'price' => 18000])
            ->assertSessionHasErrors('name');
    }

    public function test_error_messages_are_in_indonesian(): void
    {
        $this->post(route('products.store'), [])
            ->assertSessionHasErrors(['name' => 'Nama produk wajib diisi.']);
    }
}
