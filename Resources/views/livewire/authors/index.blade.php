<div>
    <x-heading>
        <x-card.title>{{ __('blog::general.authors') }}</x-card.title>

        <x-table.search/>

        <x-card.actions>
            @can('delete_authors')
                <x-danger-button wire:click="confirm('deleteMany', '{{ __('blog::general.are_you_sure_you_want_to_delete_the_selected_authors?') }}')" :disabled="!count($selectedRecords)">{{ __('blog::general.delete_authors') }}</x-danger-button>
            @endcan
            @can('create_authors')
                <x-primary-button-link href="{{ route('blog.authors.create') }}">{{ __('blog::general.create_author') }}</x-primary-button-link>
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
                    @can('delete_authors')
                        <x-table.header></x-table.header>
                    @endcan
                    <x-table.header>
                        {{ __('blog::general.name') }}
                        @include('components.table.sort', ['column' => 'name'])
                    </x-table.header>
                    <x-table.header></x-table.header>
                </x-table.row>
            </x-table.head>
            <x-table.body>
                @forelse($authors as $author)
                    <x-table.row wireKey="{{ $author->id }}" redirectTo="{{ Gate::allows('view_authors') ? route('blog.authors.show', $author) : false }}">
                        @can('delete_autors')
                            <x-table.data-cell class="w-10">
                                <x-checkbox id="ch-{{ $author->id }}" value="{{ $author->id }}" wire:model.live="selectedRecords"/>
                            </x-table.data-cell>
                        @endcan
                        <x-table.data-cell>{{ $author->name }}</x-table.data-cell>
                        <x-table.data-cell class="flex justify-end gap-3">
                            @can('view_autors')
                                <x-anchor href="{{ route('blog.authors.show', $author) }}">
                                    <x-heroicon-o-magnifying-glass/>
                                </x-anchor>
                            @endcan
                            @can('edit_autors')
                                <x-anchor href="{{ route('blog.authors.edit', $author) }}">
                                    <x-heroicon-o-pencil-square/>
                                </x-anchor>
                            @endcan
                            @can('delete_autors')
                                    <x-anchor wire:click="confirm('delete({{ $author->id }})', '{{ __('blog::general.are_you_sure_you_want_to_delete_this_author?') }}')">
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

        {{ $authors->links('components.table.pagination') }}

    </x-card>

    @include('partials.modals.confirm')

</div>
