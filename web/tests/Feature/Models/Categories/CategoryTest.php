<?php

namespace Tests\Unit\Models\Categories;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * A Category has many childrens
     *
     * @return void
     */
    public function testItHasManyChildrens()
    {
        $category = factory(Category::class)->create();

        $category->childrens()->save(
            factory(Category::class)->create()
        );

        $this->assertInstanceOf(Category::class, $category->childrens->first());
    }

    /**
     * parent scope only fetch a category that
     * doen't have a parent
     *
     * @return void
     */
    public function testItCanFetchOnlyParents()
    {
        $category = factory(Category::class)->create();

        $category->childrens()->save(
            factory(Category::class)->create()
        );

        $this->assertEquals(1, Category::parents()->count());
    }
}
