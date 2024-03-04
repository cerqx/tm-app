<?php

use \App\Models\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

describe('Categories CRUD', function () {

    it('should create category', function() {
        $response = $this->postJson(route('categories.store'), [
            'name' => 'Category Test',
            'description' => 'Description Test'
        ]);

        expect($response)->assertStatus(201)->assertJsonStructure(['data' => ['id', 'name', 'description']]);
    });

    it('should list all categories', function () {
        $response = $this->getJson(route('categories.index'));

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => [['id', 'name', 'description']]]);
    });

    it('should show a category', function () {
        $category = Category::factory()->create();
        $response = $this->getJson(route('categories.show', $category->id));

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => ['id', 'name', 'description']]);
    });

    it('should update a category', function () {
        $category = Category::factory()->create();
        $response = $this->patchJson(route('categories.update', $category->id), [
            'name' => 'Category Test Updated',
            'description' => 'Description Test Updated'
        ]);

        expect($response)->assertStatus(200)->assertJsonStructure(['data' => ['id', 'name', 'description']]);
    });

    it('should delete a category', function () {
        $category = Category::factory()->create();
        $response = $this->deleteJson(route('categories.destroy', $category->id));

        expect($response)->assertStatus(204)->assertNoContent();
    });
});
