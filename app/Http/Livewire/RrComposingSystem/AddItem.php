<?php

namespace App\Http\Livewire\RrComposingSystem;

use Livewire\Component;
use App\Models\OgSoftCopy;
use App\Models\OgFile;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Auth;

class AddItem extends Component
{
    use WithFileUploads;
    
    public $articleTitle;
    
    public $petitionerName;
    public $petitionerAddress;
    public $amountPaid;
    public $datePaid;
    public $isPaymentComplete;
    
    public $publicationType = "";
    public $datePublished;
    public $isDownloadable;
    public $isSearchable;
    public $fileUpload;
    
    public $noError = true;
    public $showAddForm = false;
    
    public function saveSoftcopy(){
        $now = Carbon::now();
        
        $validated = $this->validate([
            'fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
            ]);
            
            $addOgSoftcopy = OgSoftCopy::create([
                'article_title' => $this->articleTitle,
                
                'petitioner_id' => Str::uuid(),
                'petitioner_name' => $this->petitionerName,
                'petitioner_address' => $this->petitionerAddress,
                'amount_paid' => $this->amountPaid,
                'date_paid' => $this->datePaid,
                'is_payment_complete' => $this->isPaymentComplete,
                
                'encoded_by_id' => Auth::user()->id,
                'encoded_by_name' => Auth::user()->name,
                // 'petitioner_encoded_at' => $now,
                
                'publication_type' => $this->publicationType,
                'date_published' => $this->datePublished,
                'is_downloadable' => $this->isDownloadable,
                'is_searchable' => $this->isSearchable,
                'file_id' => Str::uuid(),
                ]);
                
                $addOgFiles = OgFile::create([
                    'belongs_to' => $addOgSoftcopy->file_id,
                    'original_filename' => $this->fileUpload->getClientOriginalName(),
                    'converted_filename' => Str::snake($addOgSoftcopy->article_title) . '_' . $addOgSoftcopy->file_id  . '.pdf',
                    'filetype' => $this->fileUpload->getClientOriginalExtension(),
                    'filesize' => $this->fileUpload->getSize(),
                    ]);
                    
                    $this->fileUpload->storeAs('public/og_files', $addOgFiles->converted_filename);
                    
                    session()->flash('success', 'Publication saved Successfully');
                    return redirect()->to('/composing_system');
                }
                
                public function updatedFileUpload(){
                    $validated = $this->validate([
                        'fileUpload' => 'mimes:pdf|max:51200', // 50MB Max 1024 * 50 = 51200
                        ]);
                    }
                    
                    public function render()
                    {
                        return view('livewire.rr-composing-system.add-item');
                    }
                }