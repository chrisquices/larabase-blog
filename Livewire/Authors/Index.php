<?php

namespace Modules\Blog\Livewire\Authors;

use App\Http\Traits\Livewire\IndexFunctions;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Blog\Models\Author;

class Index extends Component
{
    use WithPagination, IndexFunctions;

    public function mount()
    {
        $this->init();
        $this->sortBy = 'name';
    }

    public function render()
    {
        $authors = Author::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->recordsPerPage);

        return view('blog::livewire.authors.index', compact('authors'));
    }

    public function delete($id)
    {
        abort_if(Gate::denies('delete_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            Author::destroy($id);

            $this->dispatch('flash', icon: 'success', message: __('blog::general.author_deleted_successfully'));

        } catch (QueryException $e) {
            $this->dispatch('flash', icon: 'error', message: __('blog::general.unknown_error_occurred'));
        }
    }

    public function deleteMany()
    {
        abort_if(Gate::denies('delete_authors'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        try {
            Author::whereIn('id', $this->selectedRecords)->delete();

            $this->dispatch('flash', icon: 'success', message: __('blog::general.authors_deleted_successfully'));

        } catch (QueryException $e) {
            $this->dispatch('flash', icon: 'error', message: __('blog::general.unknown_error_occurred'));
        }

        $this->resetSelectedRecords();
    }
}
