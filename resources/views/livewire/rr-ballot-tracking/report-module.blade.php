<div>
    {{-- MODAL REPORT --}}
    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-labelledby="modalReport" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Generate Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <h5 class="mb-3"><b class="text-muted"> Based on History Date </b></h5>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <strong class="text-muted d-block mb-2">Date From </strong>
                                    <input type="datetime-local" name="dfrom" id="dfrom"  wire:model="dateFrom" class="form-control" placeholder="Date From" value="<?php echo date('Y-m-d\TH:i'); ?>"/>
                                </div>
                                <div class="form-group col-md-5">
                                    <strong class="text-muted d-block mb-2">Date To </strong>
                                    <input type="datetime-local" wire:model="dateTo" name="dto" id="dto" class="form-control" placeholder="Date To" value="<?php echo date('Y-m-d\TH:i'); ?>">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <strong class="text-muted d-block mb-2">.</strong>
                                    <button type="button" class="btn btn-primary btn-block" wire:click="exportDateBallot"><i class="material-icons">text_snippet</i> Generate</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    <h5 class="mb-3"><b class="text-muted"> Based on Ballot Status/Location</b></h5>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <strong class="text-muted d-block mb-2">Status </strong>
                                    <select id="statusReport" name="statusReport" class="form-control" wire:model="statusSelected">
                                        <option disabled selected value="">Select Status here</option>
                                        @if(count($comelecRolesList) > 0)
                                        @foreach($comelecRolesList as $comrole)
                                        <option value="{{$comrole->comelec_role}}">{{ Str::title($comrole->comelec_role) }}</option>
                                        @endforeach
                                        @else
                                        <option disabled selected>No Status available</option>
                                        @endif                
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <strong class="text-muted d-block mb-2">Status Type </strong>
                                    <select id="statusType" name="statusType" class="form-control" wire:model="statusType">
                                        <option disabled selected value="">Select Status Type here</option>
                                        <option value="IN">IN</option>               
                                        <option value="OUT">OUT</option>               
                                        <option value="ALL">IN AND OUT</option>               
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <strong class="text-muted d-block mb-2">. </strong>
                                    <button type="button" class="btn btn-block btn-secondary" wire:click="exportStatusBallotHistory"><i class="material-icons">text_snippet</i> Generate</button>   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" class="btn btn-block btn-success" wire:click="exportAllBallotHistory"><i class="material-icons">text_snippet</i> All History</button>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" class="btn btn-block btn-success" wire:click="exportDelivered"><i class="material-icons">text_snippet</i> Out for Delivery</button>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" class="btn btn-block btn-success" wire:click="exportDelivered"><i class="material-icons">text_snippet</i> Delivered Ballots</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" class="btn btn-block btn-danger" wire:click="exportRePrints"><i class="material-icons">text_snippet</i> Generate All Re-prints ( Ballot ID )</button>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" class="btn btn-block btn-danger" wire:click="exportRePrints"><i class="material-icons">text_snippet</i> Generate All Re-prints ( Ballot/s )</button>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <button type="button" class="btn btn-block btn-danger" wire:click="exportRePrints"><i class="material-icons">text_snippet</i> Generate Re-Print History</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</div>
