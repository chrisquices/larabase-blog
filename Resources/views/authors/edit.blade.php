<x-app-layout>
    <x-slot name="title">{{ __('blog::general.update_author') }}: {{ $author->name }}</x-slot>

    <x-heading>
        <x-card.title>{{ __('blog::general.update_author') }}: {{ $author->name }}</x-card.title>
    </x-heading>

    <form action="{{ route('blog.authors.update', $author) }}" method="POST" autocomplete="off">
        @csrf
        @method('PATCH')

        <x-card class="!py-0">
            <div class="px-2.5 divide-y-[1px] divide-slate-200 dark:divide-slate-700">
                <x-form.row>
                    <x-text-label for="name">{{ __('blog::general.name') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="name" value="{{ $author->name }}" required/>
                        <x-input-error name="name"/>
                    </x-slot>
                </x-form.row>


                <x-form.row>
                    <x-text-label for="email">{{ __('blog::general.email') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="email" type="email" value="{{ $author->email }}" required/>
                        <x-input-error name="email"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="bio">{{ __('blog::general.bio') }}</x-text-label>

                    <x-slot name="input">
                        <x-textarea id="bio" required>{{ $author->bio }}</x-textarea>
                        <x-input-error name="bio"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="facebook">{{ __('blog::general.facebook') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="facebook" value="{{ $author->facebook }}"/>
                        <x-input-error name="facebook"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="instagram">{{ __('blog::general.instagram') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="instagram" value="{{ $author->instagram }}"/>
                        <x-input-error name="instagram"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="twitter">{{ __('blog::general.twitter') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="twitter" value="{{ $author->twitter }}"/>
                        <x-input-error name="twitter"/>
                    </x-slot>
                </x-form.row>
            </div>
        </x-card>

        <x-form.actions>
            <x-anchor href="{{ route('blog.authors.index') }}" class="font-bold">{{ __('blog::general.cancel') }}</x-anchor>
            <x-primary-button>{{ __('blog::general.update_author') }}</x-primary-button>
        </x-form.actions>

    </form>
</x-app-layout>
