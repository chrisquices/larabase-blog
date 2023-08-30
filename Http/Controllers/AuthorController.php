<?php

namespace Modules\Blog\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Modules\Blog\Http\Requests\AuthorStoreRequest;
use Modules\Blog\Http\Requests\AuthorUpdateRequest;
use Modules\Blog\Models\Author;

class AuthorController extends Controller
{

    public function index()
    {
        abort_if(Gate::denies('list_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog::authors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('create_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog::authors.create');
    }

    public function store(AuthorStoreRequest $request)
    {
        abort_if(Gate::denies('create_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $author = Author::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'bio'       => $request->bio,
            'facebook'  => $request->facebook,
            'instagram' => $request->instagram,
            'twitter'   => $request->twitter,
        ]);

        session()->flash('success', __('blog::general.author_created_successfully'));

        return to_route('blog.authors.show', $author);
    }

    public function show(Author $author)
    {
        abort_if(Gate::denies('view_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog::authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        abort_if(Gate::denies('edit_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('blog::authors.edit', compact('author'));
    }

    public function update(AuthorUpdateRequest $request, Author $author)
    {
        abort_if(Gate::denies('edit_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $author->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'bio'       => $request->bio,
            'facebook'  => $request->facebook,
            'instagram' => $request->instagram,
            'twitter'   => $request->twitter,
        ]);

        session()->flash('success', __('blog::general.author_updated_successfully'));

        return to_route('blog.authors.show', $author);
    }

}
