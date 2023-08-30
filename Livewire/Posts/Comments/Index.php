<?php

namespace Modules\Blog\Livewire\Posts\Comments;

use App\Http\Traits\Livewire\IndexFunctions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Blog\Models\Comment;

class Index extends Component
{
    use WithPagination, IndexFunctions;

    public $post;

    public function mount($post)
    {
        $this->init();
        $this->sortBy = 'created_at';

        $this->post = $post;
    }

    public function render()
    {
        $comments = Comment::query()
            ->where('post_id', $this->post->id)
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('message', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->recordsPerPage);

        return view('blog::livewire.posts.comments.index', compact('comments'));
    }

    public function delete($id)
    {
        abort_if(Gate::denies('delete_comment'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Comment::destroy($id);

        $this->resetSelectedRecord();

        $this->dispatch('flash', icon: 'success', message: __('blog::general.comment_deleted_successfully'));
    }

    public function deleteMany()
    {
        abort_if(Gate::denies('delete_comments'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Comment::whereIn('id', $this->selectedRecords)->delete();

        $this->resetSelectedRecords();

        $this->dispatch('flash', icon: 'success', message: __('blog::general.comments_deleted_successfully'));
    }

}
