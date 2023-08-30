<?php

namespace Modules\Blog\Livewire\Posts;

use App\Http\Traits\Livewire\IndexFunctions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Blog\Models\Post;

class Index extends Component {
    use WithPagination, IndexFunctions;

    public function mount() {
        $this->init();
        $this->sortBy = 'title';
    }

    public function render() {
        $postsQuery = Post::query();

        $postsQuery->when($this->search, function ($query) {
            return $query->where('title', 'like', '%' . $this->search . '%');
        });

        $posts = $postsQuery
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->recordsPerPage);

        return view('blog::livewire.posts.index', compact('posts'));
    }

    public function delete($id) {
        abort_if(Gate::denies('delete_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Post::destroy($id);

        $this->resetSelectedRecord();

        $this->dispatch('flash', icon: 'success', message: __('blog::general.post_deleted_successfully'));
    }

    public function deleteMany() {
        abort_if(Gate::denies('delete_posts'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Post::whereIn('id', $this->selectedRecords)->delete();

        $this->resetSelectedRecords();

        $this->dispatch('flash', icon: 'success', message: __('blog::general.posts_deleted_successfully'));
    }

}
