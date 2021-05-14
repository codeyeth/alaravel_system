<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\User;

class ActionBar extends Component
{
    public $allUserCount;
    public $activeCount;
    
    public function mount(){
        $this->allUserCount = User::all()->count();
        $this->activeCount = User::where('is_freezed', false)->count();
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.action-bar');
    }
}
