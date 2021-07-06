<?php

namespace App\Http\Livewire\RrBallotTracking;

use Livewire\Component;

class AddWastage extends Component
{
    public $post;
    
    public $wastageEntryList = [];
    public $updateWastageEntry = false;
    
    
    public function resetContent(){
        $this->updateWastageEntry = false;
        $this->wastageEntryList =  [ ['control_number' => '', 'description' => '', 'descriptionText' => '',] ];
    }
    
    public function addWastage()
    {
        $this->wastageEntryList[] =  ['control_number' => '', 'description' => '', 'descriptionText' => '',];
        dd( $this->post );
    }
    
    public function removeWastage($index)
    {
        unset($this->wastageEntryList[$index]);
        $this->wastageEntryList = array_values($this->wastageEntryList);
    }
    
    //SET THE WASTAGE BALLOT ID TO GET THE PARENT BALLOT ID
    public function setWastageBallotId($ballotId){
        $this->wastageBallotId = $ballotId;
        $this->getWastages();
    }
    
    //GET ALL THE LISTED BAD BALLOTS
    public function getWastages()
    {
        $ballotId = Ballots::find($this->wastageBallotId);
        // $this->badBallotIdFor = $ballotId->ballot_id;
        $this->badBallotsFor = WastageManagement::where('ballot_id', $ballotId->ballot_id)->orderBy('id', 'DESC')->get();
    }
    
    //SAVE THE WASTAGE
    public function saveWastage($ballotId){
        $ballotId = Ballots::find($ballotId);
        
        foreach ($this->badBallotLists as $index => $badballotlist){
            $validatedData = Validator::make(
                ['unique_number' => $badballotlist['unique_number']
            ],
            ['unique_number' => 'string|unique:bad_ballots'],
            ['required' => 'The :attribute field is required'],
            )->validate();
            
            
            $description = Str::upper($badballotlist['description']);
            if( Str::upper($badballotlist['description']) == 'OTHERS' ){
                $description = Str::upper($badballotlist['descriptionText']);
            }
            
            BadBallots::create([
                'ballot_id' => $ballotId->ballot_id,
                'unique_number' => $badballotlist['unique_number'],
                'description' => $description,
                'created_by_id' => Auth::user()->id,
                'created_by_name' => Auth::user()->name,
                'created_by_comelec_role' => Auth::user()->comelec_role,
                ]
            );
            
            $scanForDescription = BbDescriptionDatabase::where( 'description', $description )->get();
            if( count($scanForDescription) == 0 ){
                BbDescriptionDatabase::create([
                    'description' => $description,
                    'created_by_id' => Auth::user()->id,
                    'created_by_name' => Auth::user()->name,
                    ]
                );
            }
            
            
        }
        session()->flash('messageBadBallots', 'Bad Ballots Saved Successfully!');
        $this->resetContent();  
    }
    
    public function mount(){
        $this->wastageEntryList =  [ ['control_number' => '', 'description' => '', 'descriptionText' => '',] ];   
    }
    
    public function render()
    {
        return view('livewire.rr-ballot-tracking.add-wastage');
    }
}
