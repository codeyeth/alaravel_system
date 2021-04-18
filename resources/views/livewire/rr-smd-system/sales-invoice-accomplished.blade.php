<div>
    {{-- MODAL ADD SOFTCOPY --}}
    <div class="modal fade" id="modalAccomplished" tabindex="-1" role="dialog" aria-labelledby="modalAccomplished" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Accomplished Sales Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                @if(session('messageAccomplishedSi'))
                <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageAccomplishedSi')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                
                @if(session('messageNoAccomplished'))
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="fa fa-info mx-2"></i>
                    <strong style="font-size: 150%">  {!! Str::upper(session('messageNoAccomplished')) !!} </strong> {{ \Carbon\Carbon::parse(session('now'))->toDayDateTimeString() }}
                </div>
                @endif
                
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-sm-10 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <strong class="text-muted d-block mb-2">MONTH <span class="requiredTag">&bullet;</span></strong>
                                    <select class="form-control" name="monthSelected" id="monthSelected" wire:model="monthSelected" wire:change="selectAccomplished">
                                        <option disabled selected value="">Select Month here</option>
                                        @foreach (collect($monthSelector)->sortBy('monthNumber')->toArray() as $month_selector)
                                        <option value="{{ $month_selector['monthName'] }}">{{ Str::upper($month_selector['monthName'] ) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="hr_dashed">
                    @if (count($accomplishedResult) > 0 && count($getCount) > 0 )
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="text-align: center">NAME</th>
                                <th style="text-align: center">1ST WEEK <br> (1-7)</th>
                                <th style="text-align: center">2ND WEEK <br> (8-15)</th>
                                <th style="text-align: center">3RD WEEK <br> (16-22)</th>
                                <th style="text-align: center">4TH WEEK <br> (23- {{ $endOfMonth }} )</th>
                                <th style="text-align: center">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accomplishedResult as $accomplished_result)
                            <tr>
                                <td style="text-align: center">{{ $accomplished_result['name'] }}</td>
                                
                                @foreach ($getCount as $get_count)
                                @if ( $accomplished_result['name'] == $get_count['belongs_to'] )
                                <td style="text-align: center"> {{ $get_count['count'] }} </td>
                                @endif
                                
                                @endforeach
                                
                                <td style="text-align: center">
                                    {{ $getCountCollection->where('belongs_to', $accomplished_result['name'])->sum('count') }}
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="text-align: center" class="text-danger"><b> {{ $getCountCollection->sum('count') }} </b>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">PREPARED BY <span class="requiredTag">&bullet;</span></strong>
                                    <input type="text" class="form-control" id="preparedBy" name="preparedBy" placeholder="Prepared by" required wire:model="preparedBy" >
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">POSITION <span class="requiredTag">&bullet;</span></strong>
                                    <input type="text" class="form-control" id="prepPosition" name="prepPosition" placeholder="Position" required wire:model="prepPosition" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">SUBMITTED BY <span class="requiredTag">&bullet;</span></strong>
                                    <input type="text" class="form-control" id="submittedBy" name="submittedBy" placeholder="Submitted by" required wire:model="submittedBy" >
                                </div>
                                <div class="form-group col-md-6">
                                    <strong class="text-muted d-block mb-2">POSITION <span class="requiredTag">&bullet;</span></strong>
                                    <input type="text" class="form-control" id="subPosition" name="subPosition" placeholder="Position" required wire:model="subPosition" >
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ asset ('accomplished_si') }}/{{ Str::upper($monthSelected) }}/{{ Str::upper($preparedBy) }}/{{ Str::upper($prepPosition) }}/{{ Str::upper($submittedBy) }}/{{ Str::upper($subPosition) }}" 
                    target="_blank" class="btn btn-accent btn-block"><i class="material-icons">text_snippet</i> Print to PDF</a>
                    @else
                    <br>
                    <p style="text-align: center">No Accomplished S.I Found.</p>
                    @endif
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="removeContent">Close</button>
                </div>
                
            </div>
        </div>
    </div>
</div>