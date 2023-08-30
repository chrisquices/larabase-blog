<?php

namespace Modules\Blog\Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Authors
            [
                'category' => 'blog::general.authors',
                'name'     => 'blog::general.list_authors',
                'code'     => 'list_authors',
            ],
            [
                'category' => 'blog::general.authors',
                'name'     => 'blog::general.create_authors',
                'code'     => 'create_authors',
            ],
            [
                'category' => 'blog::general.authors',
                'name'     => 'blog::general.view_authors',
                'code'     => 'view_authors',
            ],
            [
                'category' => 'blog::general.authors',
                'name'     => 'blog::general.edit_authors',
                'code'     => 'edit_authors',
            ],
            [
                'category' => 'blog::general.authors',
                'name'     => 'blog::general.delete_authors',
                'code'     => 'delete_categories',
            ],
            // Posts
            [
                'category' => 'blog::general.posts',
                'name'     => 'blog::general.list_posts',
                'code'     => 'list_posts',
            ],
            [
                'category' => 'blog::general.posts',
                'name'     => 'blog::general.create_posts',
                'code'     => 'create_posts',
            ],
            [
                'category' => 'blog::general.posts',
                'name'     => 'blog::general.view_posts',
                'code'     => 'view_posts',
            ],
            [
                'category' => 'blog::general.posts',
                'name'     => 'blog::general.edit_posts',
                'code'     => 'edit_posts',
            ],
            [
                'category' => 'blog::general.posts',
                'name'     => 'blog::general.delete_posts',
                'code'     => 'delete_posts',
            ],
            // Comments
            [
                'category' => 'blog::general.comments',
                'name'     => 'blog::general.list_comments',
                'code'     => 'list_comments',
            ],
            [
                'category' => 'blog::general.comments',
                'name'     => 'blog::general.view_comments',
                'code'     => 'view_comments',
            ],
            [
                'category' => 'blog::general.comments',
                'name'     => 'blog::general.delete_comments',
                'code'     => 'delete_comments',
            ],
        ];

        Permission::insert($permissions);
    }
}
