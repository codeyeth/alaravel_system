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
        
        <div class="col-lg-6 col-md-12">
            <div class="card card-small mb-2">
                <div class="card-header border-bottom">
                    <h6 class="m-0">Actions</h6>
                </div>
                
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item p-3">
                            <span class="d-flex mb-2">
                                <i class="material-icons mr-1">add</i>
                                <strong class="mr-1">Total Sales Invoice for Today:</strong>
                                <strong class="text-success"> 1 </strong>
                                <a class="ml-auto" href="#">View</a>
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
                            <button class="btn btn-sm btn-accent" data-toggle="modal" data-target="#modalSalesInvoice">
                                <i class="material-icons">add</i> Encode Sales Invoice
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
        
        {{-- SALES INVOICE MODULE --}}
        @livewire('rr-smd-system.sales-invoice-module')
        
        {{-- CLIENT DATABASE --}}
        @livewire('rr-smd-system.client-database-module')
        
    </div>
</div>