<?php

namespace App\Http\Livewire\RrUserManagement;

use Livewire\Component;
use App\Models\Division;
use App\Models\Section;
use Auth;
use DB;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class DivisionSectionModule extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $search = '';
    
    public $divisionAddMode = true;
    public $editDivisionId;
    
    public $divisionName;
    public $sectionName = [];
    public $sectionList = [];
    public $arrayCountUpdate;
    
    public function clearSearch(){
        $this->search = '';
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function addSectionName(){
        $this->sectionName[] = [
            [ 'section_id' => '', 'section_name' => '',]
        ];
    }
    
    // ADD INPUT WHEN UPDATE MODE IS ENABLED
    public function addUpdateSectionName(){
        $this->sectionName[$this->arrayCountUpdate]['section_id'] = '0000';
        $this->sectionName[$this->arrayCountUpdate]['section_name'] = '';
        $this->arrayCountUpdate++;
    }
    
    public function removeSectionName($index){
        unset($this->sectionName[$index]);
        $this->sectionName = array_values($this->sectionName);
    }
    
    public function refreshTrick(){
        $this->divisionName = '';
        $this->sectionName = [];
        $this->divisionAddMode = true;
        $this->sectionList = Section::all();
    }
    
    public function saveDivision(){
        $saveDivision = Division::create([
            'division' => Str::upper($this->divisionName),
            'created_by_id' => Auth::user()->id,
            'created_by' => Auth::user()->name,
            ]
        );
        foreach ($this->sectionName as $section_name){
            $saveSection = Section::create([
                'division_id' =>$saveDivision->id,
                'division' => $saveDivision->division,
                'section' => Str::upper($section_name['section_name']),
                'created_by_id' => Auth::user()->id,
                'created_by' => Auth::user()->name,
                ]
            );
        }
        session()->flash('messageDivision', 'Division Added Successfully!');
        $this->refreshTrick();
    }
    
    public function editDivision($divisionId, $indexKey){
        $this->editDivisionId = $divisionId;
        $this->refreshTrick();
        
        $this->divisionAddMode = false;
        $postEdit = Division::find($divisionId);
        $this->divisionName = $postEdit->division;
        
        $sectionList = DB::table('sections')->where('division_id', $postEdit->id)->get();
        foreach($sectionList as $section_list){
            $indexKey++;
            $this->arrayCountUpdate = $indexKey + 1;
            $this->sectionName[$indexKey]['section_id'] = $section_list->id;
            $this->sectionName[$indexKey]['section_name'] = $section_list->section;
        }
    }
    
    public function updateDivision($divisionId){
        $updateDivision = Division::find($divisionId);
        $updateDivision->update(
            ['division' => Str::upper($this->divisionName),]
        );
        
        foreach ($this->sectionName as $section_name){
            if( $section_name['section_id'] != "0000" ){
                $updateSection = Section::find($section_name['section_id']);
                $updateSection->update(
                    ['section' => Str::upper($section_name['section_name'])]
                );
            }else{
                Section::create([
                    'division_id' =>$updateDivision->id,
                    'division' => $updateDivision->division,
                    'section' => Str::upper($section_name['section_name']),
                    'created_by_id' => Auth::user()->id,
                    'created_by' => Auth::user()->name,
                    ]
                );
            }
        }
        
        session()->flash('messageDivision', 'Division Updated Successfully!');
        $this->refreshTrick();
    }
    
    public function deleteDivision($divisionId){
        $postDelete = Division::find($divisionId);
        DB::table('sections')->where('division_id', $postDelete->id)->delete();
        $postDelete->delete();
        
        session()->flash('messageDivision', 'Division and its Sections Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function deleteSection($sectionId){
        $postDelete = Section::find($sectionId);
        $postDelete->delete();
        session()->flash('messageDivision', 'Section Deleted Successfully!');
        $this->refreshTrick();
    }
    
    public function mount(){
        $this->sectionList = Section::all();
    }
    
    public function render()
    {
        return view('livewire.rr-user-management.division-section-module', [
            'divisionList' => Division::where('division', 'like', '%'.$this->search.'%')
            ->orWhere('created_by', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10),
            'divisionListCount' => Division::where('division', 'like', '%'.$this->search.'%')
            ->orWhere('created_by', 'like', '%'.$this->search.'%')
            ->orderBy('created_at', 'DESC')
            ->count(),
            ]);
            
        }
    }
    