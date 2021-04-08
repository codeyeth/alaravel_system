<?php

namespace App\Http\Livewire\JLivewire\Delivery;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Models\DeliveryConfig;

class DeliveryConfiguration extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $copy;
    public $title;

    public function refresh(){
        $this->copy = '';
        $this->title = '';
    }

    public function savecopy(){
        $savecopy = DeliveryConfig::create([
            'copies' => $this->copy,
            ]);
            session()->flash('messageSaveNewCopy', 'Copy for '.$this->copy.' Saved Successfully!');
            $this->refresh();
          // $this->emit('newUserAdded');
    }

    public function removecopy($copyID){
        $removecopy = DeliveryConfig::find($copyID);
        $removecopy->delete();
        session()->flash('messageDeleteCopy', 'Copy for '.$removecopy->copies.' Deleted Successfully!');
    }

    public function savetitle(){
        $savetitle = DeliveryConfig::create([
            'title_list' => $this->title,
            ]);
            session()->flash('messageSaveNewTitle', ''.$this->title.'  has been added to the List of Position / Title');
            $this->refresh();
          // $this->emit('newUserAdded');
    }

    public function removetitle($titleID){
        $removetitle = DeliveryConfig::find($titleID);
        $removetitle>delete();
        session()->flash('messageDeleteTitle', ''.$removetitle->title_list.' has been removed from the List of Position / Title');
    }

    public function savepersonnel(){
        $savetitle = DeliveryConfig::create([
            'title_list' => $this->title,
            ]);
            session()->flash('messageSaveNewTitle', ''.$this->title.'  has been added to the List of Position / Title');
            $this->refresh();
          // $this->emit('newUserAdded');
    }

    public function removepersonnel($personID){
        $removetitle = DeliveryConfig::find($titleID);
        $removetitle>delete();
        session()->flash('messageDeleteTitle', ''.$removetitle->title_list.' has been removed from the List of Position / Title');
    }

  
    public function render()
    {
        $copyList = DB::table('delivery_configs')->where('copies','<>','')->get();
        $titleList = DB::table('delivery_configs')->where('title_list','<>','')->get();
        $nameList = DB::table('delivery_configs')->where('personnel','<>','')->get();
        return view('livewire.j-livewire.delivery.delivery-configuration',compact('copyList','titleList','nameList'));
    }   
}
