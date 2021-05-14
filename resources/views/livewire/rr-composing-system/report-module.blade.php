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
                    
                    <div class="modal-body">
                        
                        <h5 class="mb-3" style="text-align: right;"><b class="text-muted"> Generate Monthly Publication </b></h5>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <strong class="text-muted d-block mb-2">Month </strong>
                                <select class="form-control mb-3" name="monthSelected" id="monthSelected" wire:model="monthSelected">
                                    <option disabled selected value="">Select Month here</option>
                                    @foreach (collect($monthSelector)->sortBy('monthNumber')->toArray() as $month_selector)
                                    <option value="{{ $month_selector['monthName'] }}">{{ Str::upper($month_selector['monthName'] ) }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-primary btn-block" wire:click="selectMonthly"><i class="material-icons">text_snippet</i> Generate Monthly Report </button>
                            </div>
                        </div>
                        
                        <hr class="hr_dashed">
                        
                        @if(session('messageDateRangeRequired'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <i class="fa fa-info mx-2"></i>
                            <strong style="font-size: 150%">  {!! Str::upper(session('messageDateRangeRequired')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                        </div>
                        @endif
                        
                        <h5 class="mb-3" style="text-align: right;"><b class="text-muted"> Generate Daily/Weekly Publication </b></h5>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <strong class="text-muted d-block mb-2">Date From </strong>
                                        <input type="date" name="dateFrom" id="dateFrom"  wire:model="dateFrom" class="form-control" placeholder="Date From" value="<?php echo date('Y-m-d'); ?>"/>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <strong class="text-muted d-block mb-2">Date To </strong>
                                        <input type="date" wire:model="dateTo" name="dateTo" id="dateTo" class="form-control" placeholder="Date To" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-block" wire:click="selectDateRange"><i class="material-icons">text_snippet</i> Generate Report </button>
                            </div>
                        </div>
                        
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