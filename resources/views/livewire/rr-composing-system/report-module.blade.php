<div>
    <div class="row">
        
        {{-- MODAL ADD SOFTCOPY --}}
        <div class="modal fade" id="modalReports" tabindex="-1" role="dialog" aria-labelledby="modalReports" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Generate Reports</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    @if(session('messageSaveSoftcopy'))
                    <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-info mx-2"></i>
                        <strong style="font-size: 150%">  {!! Str::upper(session('messageSaveSoftcopy')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                    </div>
                    @endif
                    
                    <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <strong class="text-muted d-block mb-2">GENERATE MONTHLY </strong>
                                <select class="form-control mb-2" name="monthSelected" id="monthSelected" wire:model="monthSelected">
                                    <option disabled selected value="">Select Month here</option>
                                    @foreach (collect($monthSelector)->sortBy('monthNumber')->toArray() as $month_selector)
                                    <option value="{{ $month_selector['monthName'] }}">{{ Str::upper($month_selector['monthName'] ) }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary btn-block" wire:click="selectMonthly"><i class="material-icons">text_snippet</i> Generate Report </button>
                            </div>
                        </div>

                        <hr class="hr_dashed">
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="refreshTrick">Close</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    
</div>
</div>