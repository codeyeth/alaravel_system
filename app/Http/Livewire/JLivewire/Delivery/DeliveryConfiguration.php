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

    public $copies;
    public $title;
    public $person_name;
    public $description;
    public $delivered_to;
    public $person_title = '';
    public $person_auth = '';
  

    public function refresh(){
        $this->copies = '';
        $this->title = '';
        $this->person_name = '';
        $this->person_auth = '';
        $this->person_title = '';
        $this->description = '';
        $this->delivered_to = '';
        
    }

    public function save($id){
        if($id == 1){
            $save = DeliveryConfig::create([
                'personnel' => $this->person_name,
                'title' => $this->person_title,
                'authorization' => $this->person_auth,
                ]);
                session()->flash('messageSavePerson', ''.$this->person_name.'  has been added to the List');
        }elseif($id == 2){
            $save = DeliveryConfig::create([
                'delivered_to' => $this->delivered_to,
                ]);
                session()->flash('messageSaveDelivered', ''.$this->delivered_to.'  has been added to the List');
        }elseif($id == 3){
            $save = DeliveryConfig::create([
                'description' => $this->description,
                ]);
                session()->flash('messageSaveDescription', ''.$this->description.'  has been added to the List');  
        }elseif($id == 4){
            $save = DeliveryConfig::create([
                'title_list' => $this->title,
                ]);
                session()->flash('messageSaveTitle', ''.$this->title.'  has been added to the List');
        }elseif($id == 5){
            $save = DeliveryConfig::create([
                'copies' => $this->copies,
                ]);
                session()->flash('messageSaveCopies', ''.$this->copies.'  has been added to the List'); 
        }
        $this->refresh();
    }

    public function remove($id, $value){
        $remove = DeliveryConfig::find($id);
        $remove->delete();
        if($value == 1){
            session()->flash('messageDeletePerson', ''.$remove->personnel.' has been removed from the List');
        }elseif($value == 2){
            session()->flash('messageDeleteDelivered', ''.$remove->delivered_to.' has been removed from the List');
        }elseif($value == 3){
            session()->flash('messageDeleteDescription', ''.$remove->description.' has been removed from the List');
        }elseif($value == 4){
            session()->flash('messageDeleteTitle', ''.$remove->title_list.' has been removed from the List');
        }elseif($value == 5){
            session()->flash('messageDeleteCopies', ''.$remove->copies.' has been removed from the List');
        }
      
    }


    public function render()
    {
        $descriptionList = DB::table('delivery_configs')->where('description','<>','')->get();
        $deliveredList = DB::table('delivery_configs')->where('delivered_to','<>','')->get();
        $copyList = DB::table('delivery_configs')->where('copies','<>','')->get();
        $titleList = DB::table('delivery_configs')->where('title_list','<>','')->where('title_list','!=','N/A')->get();
        $nameList = DB::table('delivery_configs')->where('personnel','<>','')->get();
        return view('livewire.j-livewire.delivery.delivery-configuration',compact('descriptionList','deliveredList','copyList','titleList','nameList'));
    }   
}
