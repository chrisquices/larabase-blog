@canany(['list_posts', 'list_authors'])
    <li class="space-y-2" x-data="{ show: {{ (request()->is('blog/posts', 'blog/posts/*', 'blog/authors', 'blog/authors/*')) ? 'true' : 'false' }} }">
    <span
        @class([
            'menu-dropdown-toggle',
            'bg-primary/10 rounded-lg !text-primary font-medium' => (request()->is('blog/posts', 'blog/posts/*', 'blog/authors', 'blog/authors/*'))
        ])
        @click="show = !show" :class="{ 'menu-dropdown-show': show }">
        <x-heroicon-o-pencil-square @class(['!mr-1', '!text-primary' => (request()->is('blog/posts', 'blog/posts/*', 'blog/authors', 'blog/authors/*'))])/>
        {{ __('blog::general.blog') }}
    </span>
        <ul class="menu-dropdown space-y-2" :class="{ 'menu-dropdown-show': show }">
            @can('list_blog.posts')
                <li @class(['bg-primary/10 rounded-lg text-primary font-medium' => (request()->is('blog/posts', 'blog/posts/*'))])>
                    <a href="{{ route('blog.posts.index') }}">{{ __('blog::general.posts') }}</a>
                </li>
            @endcan
            @can('list_blog.authors')
                <li @class(['bg-primary/10 rounded-lg text-primary font-medium' => (request()->is('blog/authors', 'blog/authors/*'))])>
                    <a href="{{ route('blog.authors.index') }}">{{ __('blog::general.authors') }}</a>
                </li>
            @endcan
        </ul>
    </li>
@endcanany
