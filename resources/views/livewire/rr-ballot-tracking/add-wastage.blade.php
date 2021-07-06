<div>
    <div class="modal fade" id="modalWastage" tabindex="-1" role="dialog" aria-labelledby="modalWastage" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wastageTitle">Add Wastage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Control Number</th>
                                <th>Description</th>
                                @if ( $updateWastageEntry == false)
                                <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wastageEntryList as $index => $wastage_entry_item)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Control Number" wire:model="wastageEntryList.{{$index}}.control_number" required>
                                    @if($errors->has('control_number'))
                                    <span class="text-danger">{{ $errors->first('control_number') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="text" name="description_{{$index}}" id="description_{{$index}}" class="form-control" placeholder="Description" wire:model="wastageEntryList.{{$index}}.description" required>
                                </td>
                                @if ( $updateWastageEntry == false)
                                <td>
                                    <button type="button" class="btn btn-danger btn-block" wire:click="removeWastage({{ $loop->index }})"><i class="material-icons">delete</i></button>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    @if ( $updateWastageEntry == false)
                                    <button type="button" class="btn btn-success btn-block" wire:click="addWastage"><i class="material-icons">add</i> Add New Fields</button>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    @if ( $updateWastageEntry == true)
                                    <button type="submit" class="btn btn-accent btn-block"><i class="material-icons">refresh</i> Update Wastage </button>
                                    @else
                                    <button type="submit" class="btn btn-accent btn-block"><i class="material-icons">save</i> Save Wastage </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="resetContent">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</div>