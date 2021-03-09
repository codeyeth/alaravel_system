<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                    <input type="hidden" wire:model="user_id">
                    <label for="exampleFormControlInput1">Action</label>
                    <select id="action" name="action" wire:model="action" class="form-control" required="">
                        <option value="">Select Action</option>
                        <option value="1"> Approve </option>
                        <option value="2"> Disapprove </option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Reason/Notes</label>
                        <input type="text" name="reason" wire:model="reason" class="form-control"  id="exampleFormControlInput2" placeholder="Notes for action">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-primary" data-dismiss="modal">Save changes</button>
            </div>
       </div>
    </div>
</div></div>
