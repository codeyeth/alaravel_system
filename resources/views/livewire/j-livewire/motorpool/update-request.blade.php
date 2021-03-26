<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                    <input type="text" wire:model="user_id" hidden >
                    <strong class="text-muted d-block mb-2">Action <span class="requiredTag"></span></strong>
                    <select id="action" name="action" wire:model="action" wire:change="ChangeStatusBasedOnValue($event.target.value)" class="form-control" required>
                      <option disabled selected value="0">Pending</option>
                        <option value="2"> Approved </option>
                        <option value="3"> Disapproved </option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Reason/Notes</label>
                        <input type="text" name="reason" wire:model="reason" class="form-control"  id="exampleFormControlInput2" placeholder="Notes for action">
                    </div>
                    <input type="text" name="status" wire:model="status" hidden>
                </form>
            </div>
                @error('file') <div class="alert alert-danger">{{ $message }}</div> @enderror
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>


<div wire:ignore.self class="modal fade" id="updateLetter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Signed Request Letter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @error('file') <div class="alert alert-danger">{{ $message }}</div> @enderror
            <div class="modal-body">
                <form>
                    <div class="form-group">
                    <input type="text" wire:model="user_id_letter" hidden>
                    </div>
                    <div class="form-group">
                    <label for="feRequestAtt">Attach Scanned Signed Copy:</label>
                    <input type="file" name="file" class="form-control" wire:model="file">                    </div>
                    <div wire:loading wire:target="file">Uploading...</div>
                </form>
                <input type="text" name="status" wire:model="status_letter" hidden>
            </div>
              
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="updateletter()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div>
