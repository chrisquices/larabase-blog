<x-app-layout>
    <x-slot name="title">{{ __('blog::general.create_post') }}</x-slot>

    <x-heading>
        <x-card.title>{{ __('blog::general.create_post') }}</x-card.title>
    </x-heading>

    <form action="{{ route('blog.posts.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <x-card class="!py-0">
            <div class="px-2.5 divide-y-[1px] divide-slate-200 dark:divide-slate-700">
                <x-form.row>
                    <x-text-label for="title">{{ __('blog::general.title') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="title" required/>
                        <x-input-error name="title"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="content">{{ __('blog::general.content') }}</x-text-label>

                    <x-slot name="input">
                        <x-textarea id="content">{{ old('content') }}</x-textarea>
                        <x-input-error name="content"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="author_id">{{ __('blog::general.author') }}</x-text-label>

                    <x-slot name="input">
                        <x-select id="author_id" class="tom-select" required>
                            <option value="" selected disabled>{{ __('general.select_an_option') }}</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" @selected(old('author_id') === $author->id)>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error name="author_id"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="category_id">{{ __('blog::general.category') }}</x-text-label>

                    <x-slot name="input">
                        <x-select id="category_id" class="tom-select" required>
                            <option value="" selected disabled>{{ __('general.select_an_option') }}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') === $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error name="author_id"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="tags">{{ __('blog::general.tags') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="tags" required/>
                        <x-input-error name="tags"/>
                    </x-slot>
                </x-form.row>

                <x-form.row>
                    <x-text-label for="published_at">{{ __('blog::general.published_at') }}</x-text-label>

                    <x-slot name="input">
                        <x-text-input id="published_at" type="date" required/>
                        <x-input-error name="published_at"/>
                    </x-slot>
                </x-form.row>
            </div>
        </x-card>

        <section>
            <x-card class="!py-0">
                <div class="px-2.5 divide-y-[1px] divide-slate-200 dark:divide-slate-700">
                    <x-form.row>
                        <x-text-label for="photo">{{ __('blog::general.photo') }}</x-text-label>

                        <x-slot name="input">
                            <x-file-input id="photo" required/>
                            <x-input-error name="photo"/>
                        </x-slot>
                    </x-form.row>
                </div>
            </x-card>
        </section>

        <x-form.actions>
            <x-anchor href="{{ route('blog.posts.index') }}" class="font-bold">{{ __('blog::general.cancel') }}</x-anchor>
            <x-primary-button>{{ __('blog::general.save') }}</x-primary-button>
        </x-form.actions>
    </form>

    @section('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    ckfinder: {
                        uploadUrl: `{{ route('blog.posts.upload', ['_token' => csrf_token()]) }}`
                    },
                    height: ['250px']
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.config.height = "700px"
        </script>
    @endsection
</x-app-layout>
