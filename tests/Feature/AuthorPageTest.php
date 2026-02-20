<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorPageTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed system settings to avoid layout errors
        \App\Models\SystemSetting::create([
            'sitename' => 'Vexon',
            'favicon' => 'favicon.png',
            'sitelogo' => 'logo.png',
            'contactnumber' => '1234567890',
            'supportemail' => 'support@vexon.com',
            'address' => '123 Tech St',
        ]);
    }

    public function test_author_page_displays_correctly()
    {
        // Create an author
        $author = User::factory()->create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'bio' => 'Experienced blogger.',
        ]);

        // Create a category
        $category = Category::create([
            'title' => 'Tech',
            'status' => Category::STATUS_ACTIVE,
        ]);

        // Create blogs for this author
        for ($i = 1; $i <= 3; $i++) {
            Blog::create([
                'title' => 'Blog Title ' . $i,
                'content' => 'Blog Content ' . $i,
                'slung' => 'blog-title-' . $i,
                'author_id' => $author->id,
                'category_id' => $category->id,
                'status' => Blog::STATUS_ACTIVE,
                'published_at' => now(),
            ]);
        }

        // Create a blog for another author
        $otherAuthor = User::factory()->create();
        Blog::create([
            'title' => 'Hidden Blog',
            'content' => 'Hidden Content',
            'slung' => 'hidden-blog',
            'author_id' => $otherAuthor->id,
            'category_id' => $category->id,
            'status' => Blog::STATUS_ACTIVE,
            'published_at' => now(),
        ]);

        // Visit the author page
        $response = $this->get(route('author.page', $author->id));

        // Assert success status
        $response->assertStatus(200);

        // Assert author details are visible
        $response->assertSee('John Doe');
        $response->assertSee('Experienced blogger.');

        // Assert author's blogs are visible
        for ($i = 1; $i <= 3; $i++) {
            $response->assertSee('Blog Title ' . $i);
        }

        // Assert other author's blog is NOT visible
        $response->assertDontSee('Hidden Blog');
    }

    public function test_author_page_is_publicly_accessible()
    {
        $author = User::factory()->create();

        $response = $this->get(route('author.page', $author->id));

        $response->assertStatus(200);
    }

    public function test_author_not_found_redirects_to_home()
    {
        $response = $this->get(route('author.page', 9999));

        $response->assertRedirect(route('home.page'));
    }
}
