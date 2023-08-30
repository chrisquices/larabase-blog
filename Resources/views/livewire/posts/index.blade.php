<div>
    <x-heading>
        <x-card.title>{{ __('blog::general.posts') }}</x-card.title>

        <x-table.search/>

        <x-card.actions>
            @can('delete_posts')
                <x-danger-button wire:click="confirm('deleteMany', '{{ __('blog::general.are_you_sure_you_want_to_delete_the_selected_posts?') }}')" :disabled="!count($selectedRecords)">{{ __('blog::general.delete_posts') }}</x-danger-button>
            @endcan
            @can('create_posts')
                <x-primary-button-link href="{{ route('blog.posts.create') }}">{{ __('blog::general.create_post') }}</x-primary-button-link>
            @endcan
        </x-card.actions>
    </x-heading>

    <x-card>
        <x-card.utilities>
            <x-table.records-per-page-options :recordsPerPageOptions="$recordsPerPageOptions"/>
            <x-table.loader/>

            <x-slot name="filters">
                <x-table.no-filters-found/>
            </x-slot>
        </x-card.utilities>

        <x-table>
            <x-table.head>
                <x-table.row>
                    @can('delete_posts')
                        <x-table.header></x-table.header>
                    @endcan
                        <x-table.header>
                            {{ __('blog::general.title') }}
                            @include('components.table.sort', ['column' => 'title'])
                        </x-table.header>
                        <x-table.header>
                            {{ __('blog::general.category') }}
                            @include('components.table.sort', ['column' => 'category_id'])
                        </x-table.header>
                        <x-table.header>
                            {{ __('blog::general.author') }}
                            @include('components.table.sort', ['column' => 'author_id'])
                        </x-table.header>
                        <x-table.header>
                            {{ __('blog::general.published_at') }}
                            @include('components.table.sort', ['column' => 'published_at'])
                        </x-table.header>
                    <x-table.header></x-table.header>
                </x-table.row>
            </x-table.head>
            <x-table.body>
                @forelse($posts as $post)
                    <x-table.row wireKey="{{ $post->id }}" redirectTo="{{ Gate::allows('view_posts') ? route('blog.posts.show', $post) : false }}">
                        @can('delete_posts')
                            <x-table.data-cell class="w-10">
                                <x-checkbox id="ch-{{ $post->id }}" value="{{ $post->id }}" wire:model.live="selectedRecords"/>
                            </x-table.data-cell>
                        @endcan
                            <x-table.data-cell>{{ $post->title }}</x-table.data-cell>
                            <x-table.data-cell>{{ $post->category->name }}</x-table.data-cell>
                            <x-table.data-cell>{{ $post->author->name }}</x-table.data-cell>
                            <x-table.data-cell>{{ $post->published_at_formatted }}</x-table.data-cell>
                        <x-table.data-cell class="flex justify-end gap-3 align-middle">
                            @can('view_posts')
                                <x-anchor href="{{ route('blog.posts.show', $post) }}">
                                    <x-heroicon-o-magnifying-glass/>
                                </x-anchor>
                            @endcan
                            @can('edit_posts')
                                <x-anchor href="{{ route('blog.posts.edit', $post) }}">
                                    <x-heroicon-o-pencil-square/>
                                </x-anchor>
                            @endcan
                            @can('delete_posts')
                                    <x-anchor wire:click="confirm('delete({{ $post->id }})', '{{ __('blog::general.are_you_sure_you_want_to_delete_this_post?') }}')">
                                    <x-heroicon-o-trash/>
                                </x-anchor>
                            @endcan
                        </x-table.data-cell>
                    </x-table.row>
                @empty
                    <x-table.no-results-found/>
                @endforelse
            </x-table.body>
        </x-table>

        {{ $posts->links('components.table.pagination') }}

    </x-card>

    @include('partials.modals.confirm')

</div>
