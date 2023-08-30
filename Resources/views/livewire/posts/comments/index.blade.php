<div>
    <x-heading>
        <x-table.search/>

        <x-card.actions>
            @can('delete_comments')
                <x-danger-button wire:click="confirm('deleteMany', '{{ __('blog::general.are_you_sure_you_want_to_delete_the_selected_comments?') }}')"
                                 :disabled="!count($selectedRecords)">{{ __('blog::general.delete_comments') }}</x-danger-button>
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
                    @can('delete_comments')
                        <x-table.header></x-table.header>
                    @endcan
                    <x-table.header>
                        {{ __('blog::general.name') }}
                        @include('components.table.sort', ['column' => 'name'])
                    </x-table.header>
                    <x-table.header>
                        {{ __('blog::general.email') }}
                        @include('components.table.sort', ['column' => 'email'])
                    </x-table.header>
                    <x-table.header>
                        {{ __('blog::general.message') }}
                        @include('components.table.sort', ['column' => 'message'])
                    </x-table.header>
                    <x-table.header>
                        {{ __('blog::general.created_at') }}
                        @include('components.table.sort', ['column' => 'created_at'])
                    </x-table.header>
                    <x-table.header></x-table.header>
                </x-table.row>
            </x-table.head>
            <x-table.body>
                @forelse($comments as $comment)
                    <x-table.row wireKey="{{ $comment->id }}">
                        @can('delete_comments')
                            <x-table.data-cell class="w-10">
                                <x-checkbox id="ch-{{ $comment->id }}" value="{{ $comment->id }}" wire:model.live="selectedRecords"/>
                            </x-table.data-cell>
                        @endcan
                        <x-table.data-cell class="w-10">{{ $comment->name }}</x-table.data-cell>
                        <x-table.data-cell class="w-10">{{ $comment->email }}</x-table.data-cell>
                        <x-table.data-cell class="!whitespace-normal">{{ $comment->message }}</x-table.data-cell>
                        <x-table.data-cell>{{ $comment->created_at }}</x-table.data-cell>
                        <x-table.data-cell class="flex justify-end gap-3 align-middle">
                            @can('delete_comments')
                                <x-anchor wire:click="confirm('delete({{ $comment->id }})', '{{ __('blog::general.are_you_sure_you_want_to_delete_this_comment?') }}')">
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

        {{ $comments->links('components.table.pagination') }}

    </x-card>

    @include('partials.modals.confirm')

</div>
