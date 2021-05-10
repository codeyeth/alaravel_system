<div>
    @if($isOn == true)
    <h3 style="text-align: center"><strong> PUBLICATION SOFTCOPY </strong></h3>
    <br>
    
    <div class="d-flex" style="overflow-x:auto;">
        <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
            <label class="btn btn-white {{ $searchingMode == "keywordMode" ? 'active' : ''}}" wire:click="$set('searchingMode', 'keywordMode')"><input type="radio" name="options" id="option1"> Search by Keyword </label>
            <label class="btn btn-white {{ $searchingMode == "dateMode" ? 'active' : ''}}" wire:click="$set('searchingMode', 'dateMode')"><input type="radio" name="options" id="option2"> Search by Date Published</label>
            <label class="btn btn-white {{ $searchingMode == "publicationTypeMode" ? 'active' : ''}}" wire:click="$set('searchingMode', 'publicationTypeMode')"><input type="radio" name="options" id="option2"> Search by Publication Type</label>
        </div>
        <div class="p-2"></div>
        <div class="ml-auto p-2">
            Total of <b class="text-success" style="font-size: 120%;"> {{ count($ogList) }} </b> Result/s Found
        </div>
    </div>
    
    @if ($searchingMode == "keywordMode")
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="input-group mb-3">
                <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="search" value="{{ $searchingMode }}">
                <div class="input-group-append">
                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                </div>
            </div>
        </div>
    </div>
    @elseif( $searchingMode == "dateMode" )
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="input-group mb-3">
                <input class="form-control form-control-lg mb-0" type="date" placeholder="Search" wire:model="search">
                <div class="input-group-append">
                    <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="input-group mb-3">
                        <select name="publicationType" id="publicationType" class="form-control form-control-lg" required wire:model="search" wire:change="spitMatchedSubPublicType($event.target.value)">
                            <option disabled selected value="">Select here</option>
                            @if (count($searchPubList) > 0)
                            @foreach ($searchPubList as $search_pub_list)
                            <option value="{{ $search_pub_list->id }}">{{ $search_pub_list->publication_type }}</option>
                            @endforeach
                            @else
                            <option disabled selected value="">No Available Type</option>
                            @endif
                        </select>
                        <div class="input-group-append">
                            @if (count($searchSubPubList) > 0)
                            <select name="publicationSubType" id="publicationSubType" class="form-control form-control-lg" required wire:model="searchSubType">
                                <option disabled selected value="">Select here</option>
                                @foreach ($searchSubPubList as $search_sub_pub_list)
                                <option value="{{ $search_sub_pub_list->id }}">{{ $search_sub_pub_list->publication_type_child }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                            @else
                            <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <div class="row" style="overflow-x:auto;">
        <div class="col-12 col-sm-12" >
            @if (count($ogList) > 0)
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        {{-- <th scope="col" class="border-0">#</th> --}}
                        <th scope="col" class="border-0">Article Title</th>
                        <th scope="col" class="border-0">Publication Type</th>
                        <th scope="col" class="border-0">Date Published</th>
                        <th scope="col" class="border-0">Petitioner</th>
                        <th scope="col" class="border-0">Uploaded at</th>
                        
                        {{-- <th scope="col" class="border-0"></th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ogList as $item)
                    <tr>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalAddOg" wire:click="getOgFile({{ $item->id }})">{{ $item->article_title }}</a>
                            @if ($item->is_downloadable)
                            <i class="material-icons text-success">download</i> 
                            @endif
                        </td>
                        <td>
                            {{-- PUBLICATION TYPE --}}
                            @if (count($this->pubList) > 0)
                            @foreach ($this->pubList as $publicationTypeItem)
                            @if ( $publicationTypeItem->id ==  $item->publication_type)
                            {{ $publicationTypeItem->publication_type }}
                            @endif
                            @endforeach
                            @endif
                            
                            {{-- PUBLICATION SUB TYPE --}}
                            @if (count($this->pubSelectSubList) > 0)
                            @foreach ($this->pubSelectSubList as $publicationSubTypeItem)
                            @if ( $publicationSubTypeItem->id ==  $item->publication_sub_type)
                            -
                            {{ $publicationSubTypeItem->publication_type_child }}
                            @endif
                            @endforeach
                            @endif

                        </td>
                        <td>{{ \Carbon\Carbon::parse($item->date_published)->toFormattedDateString() }} </td>
                        <td>{{ $item->petitioner_name }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <br>
            <p style="text-align: center">No Publication Softcopy found.</p>    
            @endif
            
        </div>
    </div>
    
    <br>
    
    <div class="text-center" style="text-align: center"> 
        {{ $ogList->links() }}
    </div>
    
    {{-- MODAL VIEW DOWNLOAD --}}
    <div class="modal fade" id="modalAddOg" tabindex="-1" role="dialog" aria-labelledby="modalAddOg" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-m" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Download Softcopy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    @if (count($getOgFile) > 0)
                    
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="text-align: right">Filename</th>
                                {{-- <th>Filetype</th>
                                    <th>Filesize</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getOgFile as $file_item)
                                <tr>
                                    <td style="text-align: right">{{ $file_item->original_filename }}</td>
                                    {{-- <td>{{ $file_item->filetype }}</td>
                                    <td>{{ $file_item->filesize }} MB</td> --}}
                                    <td style="text-align: left">
                                        <a href="{{ asset ('/storage/og_files/') }}/{{ $file_item->converted_filename }}" target="_blank" class="btn btn-accent btn-block">Download</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @else
                        <p style="text-align: center;">No Files Found / File Restricted</p>
                        @endif
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                </div>
            </div>
        </div>
        
        @else
        <h1 style="text-align: center;" class="text-danger">Publication Softcopy Search Engine is Currently Offline! Please try again later...</h1>
        @endif
    </div>