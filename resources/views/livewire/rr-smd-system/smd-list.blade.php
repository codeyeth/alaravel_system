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
    
    {{-- CLIENT LEDGER LIST --}}
    @if ($clTable == true)
    @livewire('rr-smd-system.client-ledger-list')        
    @endif
    
    {{-- DELIVER RECEIPT LIST --}}
    @if ($drTable == true)
    @livewire('rr-smd-system.delivery-receipt-list')        
    @endif
    
        <!--start Jcodes modal for reports daily and monthly-->
        {{Form::open(['route' => 'generic', 'method' => 'GET', 'autocomplete'=>'off'])}} 
    <div wire:ignore.self class="modal fade" id="modalSalesReports" tabindex="-1" role="dialog" aria-labelledby="modalSalesReports" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daily and Monthly Reports</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <ul class="nav nav-pills nav-tabs justify-content-end" id="myTab" role="tablist">
<li class="nav-item">
    <a class="nav-link" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="false" wire:ignore.self>Daily</a>
  </li> 
  <li class="nav-item">
    <a class="nav-link" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false" wire:ignore.self>Monthly</a>
  </li>
</ul>
<div class="tab-content" id="myTab">
<div class="tab-pane fade show" id="daily" role="tabpanel" aria-labelledby="daily-tab" wire:ignore.self>
<ul class="nav nav-pills nav-tabs justify-content-first" id="myTab" role="tablist">
<li class="nav-item">
    <a class="nav-link" id="generic-tab" data-toggle="tab" href="#generic" role="tab" aria-controls="daily" aria-selected="false" wire:ignore.self>Generic</a>
  </li> 
  <li class="nav-item">
    <a class="nav-link" id="specialized-tab" data-toggle="tab" href="#specialized" role="tab" aria-controls="specialized" aria-selected="false" wire:ignore.self>Specialized</a>
  </li>
</ul>
<div class="tab-content" id="myTab">
<div class="tab-pane fade show" id="generic" role="tabpanel" aria-labelledby="generic-tab" wire:ignore.self>
<div class="form-group">
{{Form::open(['route' => 'generic', 'method' => 'GET', 'autocomplete'=>'off'])}} 
<br>
<label for="feRequestAtt">Date:</label>
<input type="hidden" name="goods" id="goods" class="input-sm form-control" value="GENERIC">
<input type="date" name="dailydate" id="dfrom" class="input-sm form-control" >
</div>
<br>
<button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
{{ Form::button('Print',['type' => 'submit','class'=>'btn btn-primary']) }}
{{ Form::close() }}
</div>
<div class="tab-pane fade" id="specialized" role="tabpanel" aria-labelledby="specialized-tab" wire:ignore.self><div class="form-group">
{{Form::open(['route' => 'specialized', 'method' => 'GET', 'autocomplete'=>'off'])}} 
<br>
<label for="feRequestAtt">Date:</label>
<input type="hidden" name="goods" id="goods" class="input-sm form-control" value="SPECIALIZED">
<input type="date" name="dailydate" id="dfrom" class="input-sm form-control" >
</div>
<br>
<button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
{{ Form::button('Print',['type' => 'submit','class'=>'btn btn-primary']) }}
{{ Form::close() }}
</div>
</div>
</div>
<div class="tab-pane fade" id="monthly" role="tabpanel" aria-labelledby="monthly-tab" wire:ignore.self>
<div class="form-group">
{{Form::open(['route' => 'monthly', 'method' => 'GET', 'autocomplete'=>'off'])}} 
<br>
<div class="form-row">
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Reports datetime from:</strong>
                                            <input type="date" name="datefromdated" id="dfrom" class="input-sm form-control" placeholder="Date From" >
                                            </div>
                                        <div class="form-group col-md-6">
                                            <strong class="text-muted d-block mb-2">Reports datetime to:</strong>
                                            <input type="date" name="datetodated" id="dto"     class="input-sm form-control" placeholder="Date To" >
                                        </div>
                                    </div>
</div>
<br>
<button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
{{ Form::button('Print',['type' => 'submit','class'=>'btn btn-primary']) }}
{{ Form::close() }}
</div>
</div>    
                </div><!--end modal body-->
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <!--end start Jcodes modal for reports daily and monthly-->
</div>