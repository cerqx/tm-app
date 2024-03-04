<?php

use \App\Models\Category;
use \App\Models\Product;

describe('Products CRUD', function () {
    it('should create a product', function () {
        $category = Category::factory()->create();
        $response = $this->postJson(route('products.store'), [
            'category_id' => $category->id,
            'name' => 'Product Test',
            'description' => 'Description Test',
            'price' => 10.10,
            'status' => 'active'
        ]);

        expect($response)->assertStatus(201)->assertJsonStructure(['data' => ['id', 'category', 'name', 'description', 'price', 'status']]);
    });

    it('should list all products', function () {
        $response = $this->getJson(route('products.index'));

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => [['id', 'category', 'name', 'description', 'price', 'status']]]);
    });

    it('should show a product', function() {
        $product = Product::factory()->create();
        $response = $this->getJson(route('products.show', $product->id));

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => ['id', 'category', 'name', 'description', 'price', 'status']]);
    });

    it('should update a product', function () {
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->patchJson(route('products.update', $product->id), [
            'category_id' => $category->id,
            'name' => 'Product updated',
            'description' => 'Description updated',
            'price' => 9.50,
            'status' => 'active'
        ]);

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => ['id', 'category', 'name', 'description', 'price', 'status']]);
    });

    it('should delete a product', function () {
        $product = Product::factory()->create();
        $response = $this->deleteJson(route('products.destroy', $product->id));

        expect($response)->assertStatus(204)->assertNoContent();
    });
});
