<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use App\Models\OgSoftcopy;
use App\Models\SEComposing;
use App\Models\OgFile;
use App\Models\PublicationType;
use App\Models\PublicationTypeChildren;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Auth;
use DB;

class PublicationModule extends Component
{
    //PUBLICATION SIDE
    public $pubAddMode = true;
    public $publicationSub = [];
    public $publicationAddSub = [];
    public $publication_type;
    public $pubList = [];
    public $pubSubList = [];
    public $editPubId;
    public $arrayCountUpdate;
    
    public function addSubType(){
        $this->publicationSub[] = [
            ['publication_type_sub_id' => '', 'publication_type_sub' => '']
        ];
    }
    
    // ADD INPUT WHEN UPDATE MODE IS ENABLED
    public function addUpdateSubType(){
        $this->publicationSub[$this->arrayCountUpdate]['publication_type_sub_id'] = '0000';
        $this->publicationSub[$this->arrayCountUpdate]['publication_type_sub'] = '';
        $this->arrayCountUpdate++;
    }
    
    public function removeSubType($index){
        unset($this->publicationSub[$index]);
        $this->publicationSub = array_values($this->publicationSub);
    }
    
    public function deleteParentPubType($pubId){
        $postDelete = PublicationType::find($pubId);
        DB::table('publication_type_childrens')->where('publication_parent_id', $postDelete->id)->delete();
        $postDelete->delete();
        
        session()->flash('messagePublication', 'Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function deleteChildrenPubType($pubId){
        $postDelete = PublicationTypeChildren::find($pubId);
        $postDelete->delete();
        session()->flash('messagePublication', 'Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function editPubType($pubId, $indexKey){
        $this->editPubId = $pubId;
        $this->refreshTrick();
        $this->pubAddMode = false;
        $postEdit = PublicationType::find($pubId);
        $this->publication_type = $postEdit->publication_type;
        
        $childrenList = DB::table('publication_type_childrens')->where('publication_parent_id', $postEdit->id)->get();
        foreach($childrenList as $childrenlist){
            $indexKey++;
            $this->arrayCountUpdate = $indexKey + 1;
            $this->publicationSub[$indexKey]['publication_type_sub_id'] = $childrenlist->id;
            $this->publicationSub[$indexKey]['publication_type_sub'] = $childrenlist->publication_type_child;
        }
        $this->emit('newSoftcopyAdded');
    }
    
    public function savePublication(){
        $now = Carbon::now();
        
        $addpublicationType = PublicationType::create([
            'publication_type' => Str::upper($this->publication_type),
            'created_by_id' => Auth::user()->id,
            'created_by_name' => Auth::user()->name,
            ]
        );
        
        foreach ($this->publicationSub as $publicationSub){
            PublicationTypeChildren::create([
                'publication_parent_id' => $addpublicationType->id,
                'publication_type_child' => Str::upper($publicationSub['publication_type_sub']),
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Auth::user()->name,
                ]
            );
        }
        
        session()->flash('messagePublication', 'Publication Type/s Added Successfully!');
        
        $this->refreshTrick();
    }
    
    public function updatePublication($pubId){
        $updatePubType = PublicationType::find($pubId);
        $updatePubType->update(
            ['publication_type' => Str::upper($this->publication_type)]
        );
        
        foreach ($this->publicationSub as $publicationSub){
            if( $publicationSub['publication_type_sub_id'] != "0000" ){
                $updatePubTypeSub = PublicationTypeChildren::find($publicationSub['publication_type_sub_id']);
                $updatePubTypeSub->update(
                    ['publication_type_child' => Str::upper($publicationSub['publication_type_sub'])]
                );
            }else{
                PublicationTypeChildren::create([
                    'publication_parent_id' => $updatePubType->id,
                    'publication_type_child' => Str::upper($publicationSub['publication_type_sub']),
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Auth::user()->name,
                    ]
                );
            }
        }
        
        session()->flash('messagePublication', 'Publication Type/s Updated Successfully!');
        $this->refreshTrick();
    }
    
    public function refreshTrick(){
        $this->publication_type = '';
        $this->publicationSub = [];
        $this->pubAddMode = true;
        $this->pubList = PublicationType::all();
        $this->pubSubList = PublicationTypeChildren::all();
    }
    
    public function mount(){
        $this->pubList = PublicationType::all();
        $this->pubSubList = PublicationTypeChildren::all();         
    }
    
    public function render()
    {
        return view('livewire.rr-composing-system.publication-module');
    }
}
