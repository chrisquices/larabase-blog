<x-app-layout>
    <x-slot name="title">{{ __('blog::general.post_details') }}: {{ $post->title }}</x-slot>

    <x-heading>
        <x-card.title>{{ __('blog::general.post_details') }}: {{ $post->title }}</x-card.title>
    </x-heading>

    <x-card class="!py-0">
        <div class="px-2.5 divide-y-[1px] divide-slate-200 dark:divide-slate-700">
            <x-form.row>
                <x-text-label for="title">{{ __('blog::general.title') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $post->title }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="content">{{ __('blog::general.content') }}</x-text-label>

                <x-slot name="input">

                    <div x-data="{ isShowing: false }">
                        <div x-on:click="isShowing = !isShowing" class="px-1 py-2 text-sm text-primary font-medium cursor-pointer">
                            <p x-show="!isShowing" class="text-primary">{{ __('blog::general.show_content') }}</p>
                            <p x-show="isShowing" class="text-primary">{{ __('blog::general.hide_content') }}</p>
                        </div>
                        <div x-show="isShowing">{!! $post->content !!}</div>
                    </div>

                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="author">{{ __('blog::general.author') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $post->author->name }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="category">{{ __('blog::general.category') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $post->category->name }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="tags">{{ __('blog::general.tags') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $post->tags }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="published_at">{{ __('blog::general.published_at') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $post->published_at }}</x-form.text>
                </x-slot>
            </x-form.row>
        </div>
    </x-card>

    <x-card class="!py-0">
        <div class="px-2.5 divide-y-[1px] divide-slate-200 dark:divide-slate-700">
            <x-form.row>
                <x-text-label for="photo">{{ __('blog::general.photo') }}</x-text-label>

                <x-slot name="input">
                    <x-form.thumbnail url="{{ $post->photo_url }}"></x-form.thumbnail>
                </x-slot>
            </x-form.row>
        </div>
    </x-card>

    <x-form.actions>
        <x-anchor href="{{ route('blog.posts.index') }}" class="font-bold">{{ __('blog::general.cancel') }}</x-anchor>
    </x-form.actions>

    <x-heading>
        <x-card.subtitle>{{ __('blog::general.comments') }}</x-card.subtitle>
    </x-heading>

    <livewire:blog::posts.comments.index :post="$post"/>

</x-app-layout>
