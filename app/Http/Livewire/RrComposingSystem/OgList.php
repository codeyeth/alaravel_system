<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OgSoftcopy;
use App\Models\OgFile;

class OgList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    
    public function render()
    {
        // return view('livewire.rr-composing-system.og-list');
        
        return view('livewire.rr-composing-system.og-list', [
            'ogList' => OgSoftcopy::where('article_title', 'like', '%'.$this->search.'%')
            ->orWhere('publication_type', 'like', '%'.$this->search.'%')
            // ->orWhere('division', 'like', '%'.$this->search.'%')
            // ->orWhere('section', 'like', '%'.$this->search.'%')
            ->paginate(5),
            ]);
        }
        
    }