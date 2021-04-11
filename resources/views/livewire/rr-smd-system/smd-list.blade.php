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
                </div>
                
            </div>
        </div>
    </div>
    
    {{-- SALES INVOICE LIST --}}
    @if ($siTable == true)
    @livewire('rr-smd-system.sales-invoice-list')        
    @endif
    
    {{-- CLIENT LEDGERE LIST --}}
    @if ($clTable == true)
    @livewire('rr-smd-system.client-ledger-list')        
    @endif
    
    
</div>