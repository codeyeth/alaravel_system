<div>
    <div class="row">
        
        <style>
            input { 
                text-transform: uppercase;
            }
            ::-webkit-input-placeholder { /* WebKit browsers */
                text-transform: none;
            }
        </style>
        
        <div class="col-lg-12 col-md-12">
            <div class="card card-small mb-2">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">login</i>
                                <strong class="mr-1">Logbook System:</strong> 
                                <a class="text-accent" href="{{ asset('/logbook_system') }}" target="_blank"><b> View </b></a>
                            </span>
                            
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">add</i>
                                <strong class="mr-1">Total Sales Invoice Today:</strong>
                                <strong class="text-success"> {{ $salesInvoiceTodayCount }} </strong>
                            </span>
                            
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">add</i>
                                <strong class="mr-1">Total Posted Transactions Today:</strong>
                                <strong class="text-success"> {{ $postedTransactionCount }} </strong>
                            </span>
                            
                        </li>
                        <li class="list-group-item d-flex px-3">
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAddProduct">
                                <i class="material-icons">add</i> Add Product
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalProductItem">
                                <i class="material-icons">add</i> Add Item/s to Product
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalClientDatabase">
                                <i class="material-icons">add</i> Client Database
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalCourierDatabase">
                                <i class="material-icons">add</i> Courier Info Database
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalPurchaseOrder">
                                <i class="material-icons">add</i> Log Purchase Order
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalSalesInvoice">
                                <i class="material-icons">add</i> Encode Sales Invoice
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalAccomplished">
                                <i class="material-icons">add</i> Accomplished S.I
                            </button>
                            <div style="margin-left: 10px;"></div>
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalSalesReports">
                                <i class="material-icons">text_snippet</i> Sales Report
                            </button>
                            <div style="margin-left: 10px;"></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        {{-- PRODUCT MODULE --}}
        @livewire('rr-smd-system.product-module')
        
        {{-- PRODUCT ITEM/S MODULE --}}
        @livewire('rr-smd-system.product-item-module')
        
        {{-- PURCHASE ORDER MODULE --}}
        @livewire('rr-smd-system.purchase-order')
        
        {{-- SALES INVOICE MODULE --}}
        @livewire('rr-smd-system.sales-invoice-module')
        
        {{-- CLIENT DATABASE --}}
        @livewire('rr-smd-system.client-database-module')
        
        {{-- ACCOMPLISED SALES INVOICE --}}
        @livewire('rr-smd-system.sales-invoice-accomplished')
        
        {{-- COURIER INFO DATABASE --}}
        @livewire('rr-smd-system.courier-info-database')
        
        {{-- J DAILY AND MONTHLY GENERIC SPECIALIZED CLAIMED UNCLAIMED REPORTS --}}
        @include('livewire.j-livewire.smd.jreports_modal')  

        
    </div>
</div>