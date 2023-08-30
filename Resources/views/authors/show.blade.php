<x-app-layout>
    <x-slot name="title">{{ __('blog::general.author_details') }}: {{ $author->name }}</x-slot>

    <x-heading>
        <x-card.title>{{ __('blog::general.author_details') }}: {{ $author->name }}</x-card.title>
    </x-heading>

    <x-card class="!py-0">
        <div class="px-2.5 divide-y-[1px] divide-slate-200 dark:divide-slate-700">
            <x-form.row>
                <x-text-label for="name">{{ __('blog::general.name') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $author->name }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="email">{{ __('blog::general.email') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $author->email }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="bio">{{ __('blog::general.bio') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $author->bio }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="facebook">{{ __('blog::general.facebook') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $author->facebook }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="instagram">{{ __('blog::general.instagram') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $author->instagram }}</x-form.text>
                </x-slot>
            </x-form.row>

            <x-form.row>
                <x-text-label for="twitter">{{ __('blog::general.twitter') }}</x-text-label>

                <x-slot name="input">
                    <x-form.text>{{ $author->twitter }}</x-form.text>
                </x-slot>
            </x-form.row>
        </div>
    </x-card>

    <x-form.actions>
        <x-anchor href="{{ route('blog.authors.index') }}" class="font-bold">{{ __('blog::general.cancel') }}</x-anchor>
    </x-form.actions>

</x-app-layout>
