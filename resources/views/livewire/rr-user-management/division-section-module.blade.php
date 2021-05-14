    <div>
        {{-- MODAL ADD PRODUCT --}}
        <div class="modal fade" id="modalAddDivision" tabindex="-1" role="dialog" aria-labelledby="modalAddDivision" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @if ( $divisionAddMode == true )
                    <form wire:submit.prevent="saveDivision" autocomplete="off">
                        @else
                        <form wire:submit.prevent="updateDivision({{ $editDivisionId }})" autocomplete="off">
                            @endif
                            
                            @csrf
                            
                            @if(session('messageDivision'))
                            <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <i class="fa fa-info mx-2"></i>
                                <strong style="font-size: 150%">  {!! Str::upper(session('messageDivision')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                            </div>
                            @endif
                            
                            <div class="modal-body">
                                
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <strong class="text-muted d-block mb-2">DIVISION <span class="requiredTag">&bullet;</span></strong>
                                                <input type="text" class="form-control" id="divisionName" name="divisionName" placeholder="Division Name" autocomplete="off" required autofocus wire:model="divisionName" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr class="hr_dashed">
                                
                                @if ($divisionAddMode == true)
                                <button type="button" class="btn btn-accent btn-block" wire:click="addSectionName"><i class="material-icons">add</i>Add Section</button>
                                @else
                                <button type="button" class="btn btn-accent btn-block" wire:click="addUpdateSectionName"><i class="material-icons">add</i>Add Section</button>
                                @endif
                                
                                <br>
                                
                                {{-- SECTION LISTS --}}
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SECTION</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sectionName as $index => $section_name)
                                        <tr>
                                            <td>
                                                {{-- <input type="text" class="form-control" placeholder="Sub-Product Name" wire:model="productSubName.{{$index}}.product_sub_id" required> --}}
                                                <input type="text" class="form-control" placeholder="Section Name" wire:model="sectionName.{{$index}}.section_name" required>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-block" wire:click="removeSectionName({{$index}})"> <i class="material-icons">remove</i> Remove</button>
                                            </td>
                                        </tr>      
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                @if (count($sectionName) <= 0 )
                                <p style="text-align: center"> Click Add Sub-Product to add.</p>
                                @endif
                                
                                <hr class="hr_dashed">
                                
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="input-group mb-3">
                                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search" wire:model="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-warning" type="button" wire:click="clearSearch">Clear Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <p>Total of <b class="text-info" style="font-size: 130%;"> {{ $divisionListCount }} </b> Result/s found.</p>
                                
                                @if (count($divisionList) > 0)
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col" class="border-0">#</th>
                                            <th scope="col" class="border-0" style="text-align: left">DIVISION
                                                <i class="material-icons text-danger">info</i> <small class="text-danger"> Deleting a Product <br> will also Delete its Sections. </small>
                                            </th>
                                            <th style="text-align: left" scope="col" class="border-0" >SECTION <br> </th>
                                            <th scope="col" class="border-0" ></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($divisionList as $division_list)
                                        <tr>
                                            <td>{{ $division_list->id }}</td>
                                            <td style="text-align: left"> <a href="#" class="text-danger" wire:click="deleteDivision({{ $division_list->id }})"> <i class="material-icons">delete</i></a> {{ $division_list->division }}</td>
                                            <td style="text-align: left">
                                                @foreach ($sectionList as $section_list)
                                                @if ($section_list->division_id == $division_list->id)
                                                <li> {{ $section_list->section }} <a href="#" class="text-danger" wire:click="deleteSection({{ $section_list->id }})"> <i class="material-icons">delete</i></a> </li> 
                                                @endif
                                                @endforeach
                                            </td>
                                            <td width="5%">
                                                <button type="button" class="btn btn-accent btn-block btn-sm" wire:click="editDivision({{ $division_list->id }}, {{ $loop->index }})">  <i class="material-icons">mode_edit</i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                <p style="text-align: center"> No Division/s Found.</p>
                                @endif
                                
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                                <button type="button" class="btn btn-warning" wire:click="refreshTrick">Reset Form</button>
                                <button type="submit" class="btn btn-accent">{{ $divisionAddMode == true ? 'Save Division' : 'Update Division'}}</button>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>