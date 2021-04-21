<div>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="d-flex">
                <div class="ml-auto p-2">
                    {{-- Total of <b class="text-success" style="font-size: 120%;"> {{ count($ogList) }} </b> Result/s Found --}}
                </div>
                <div class="p-2"></div>
                
                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                    <label class="btn btn-white {{ $siTable == true ? 'active' : '' }}" wire:click="showSiTable"><input type="radio" name="options" id="option1"> Sales Invoice Table</label>
                    <label class="btn btn-white {{ $clTable == true ? 'active' : ''}}" wire:click="showClTable"><input type="radio" name="options" id="option2"> Client Ledger Table</label>
                    <label class="btn btn-white {{ $drTable == true ? 'active' : ''}}" wire:click="showDrTable"><input type="radio" name="options" id="option3"> Delivery Receipt Table</label>
                    <button data-toggle="modal" data-target="#reports" class="btn btn-white">Reports</button>  
                </div>
                <!--start Jcodes modal for reports daily and monthly-->
                {{Form::open(['route' => 'recover', 'method' => 'GET', 'autocomplete'=>'off'])}} 
                <div wire:ignore.self class="modal fade" id="reports" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Daily and Monthly Reports</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        <div class="modal-body">
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label for="feRequestAtt">Date:</label>
                                <input type="date" name="dailydate" id="dfrom" class="input-sm form-control" placeholder="Date From" >
                            </div>
                        </div> 
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{ Form::button('Print',['type' => 'submit','class'=>'btn btn-primary']) }}
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            <!--end start Jcodes modal for reports daily and monthly-->
            </div>
        </div>
    </div>
    
    {{-- SALES INVOICE LIST --}}
    @if ($siTable == true)
    @livewire('rr-smd-system.sales-invoice-list')        
    @endif
    
    {{-- CLIENT LEDGER LIST --}}
    @if ($clTable == true)
    @livewire('rr-smd-system.client-ledger-list')        
    @endif
    
    {{-- DELIVER RECEIPT LIST --}}
    @if ($drTable == true)
    @livewire('rr-smd-system.delivery-receipt-list')        
    @endif
    
    
</div>