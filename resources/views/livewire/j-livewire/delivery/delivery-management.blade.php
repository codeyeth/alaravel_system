<div>
<div class="card-header border-bottom">
            <h6 class="m-0">Delivery Management <label style="float:right;">  </label></h6>
        </div>
    <div>
    
        <div class="row">
            <div class="col-lg-12 mb-4">
              
                <div class="card card-small mb-1">
                    <ul class="nav nav-pills nav-tabs " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false" wire:ignore.self>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="create_dr-tab" data-toggle="tab" href="#create_dr" role="tab" aria-controls="create_dr" aria-selected="false" wire:ignore.self>Create Delivery Receipt Number</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr_number_report-tab" data-toggle="tab" href="#dr_number_report" role="tab" aria-controls="dr_number_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(1)">Delivery Number Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="daily_dr_report-tab" data-toggle="tab" href="#daily_dr_report" role="tab" aria-controls="daily_dr_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(2)">Daily Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="monthly_dr_report-tab" data-toggle="tab" href="#monthly_dr_report" role="tab" aria-controls="monthly_dr_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(3)">Monthly Report</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr_report_settings-tab" data-toggle="tab" href="#dr_report_settings" role="tab" aria-controls="dr_report_settings" aria-selected="false" wire:ignore.self>Delivery Report Settings</a>
                        </li>
                    </ul>

                   
                    <div class="tab-content" id="myTab">
                        <input type="text" wire:model="wire_dr_reports_identifier" name="input_dr_reports_identifier" hidden >
                        @include('livewire.j-livewire.delivery.delivery-dated-reports-modal') 
                       
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-home')
                        </div>

                        <div class="tab-pane fade show" id="create_dr" role="tabpanel" aria-labelledby="create_dr-tab" wire:ignore.self> 
                            @include('livewire.j-livewire.delivery.delivery-create-dr')
                        </div>

                        <div class="tab-pane fade show" id="dr_number_report" role="tabpanel" aria-labelledby="dr_number_repor-tab" wire:ignore.self>  
                            <div class="card-header border-bottom">
                                Generate one Receipt Number Report <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                @include('livewire.j-livewire.delivery.delivery-one-dr-report')
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="daily_dr_report" role="tabpanel" aria-labelledby="daily_dr_report-tab" wire:ignore.self>  
                            <div class="card-header border-bottom">
                                Generate Daily Report <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                @include('livewire.j-livewire.delivery.delivery-daily-dr-reports')
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="monthly_dr_report" role="tabpanel" aria-labelledby="monthly_dr_report-tab" wire:ignore.self>  
                            <div class="card-header border-bottom">
                                Generate Monthly Report <label style="float:right;"> {{$monthlydrlistresult}} </label><br><br>
                                @include('livewire.j-livewire.delivery.delivery-monthly-dr-report')
                            </div>
                        </div>

                        <div class="tab-pane fade show" id="dr_report_settings" role="tabpanel" aria-labelledby="dr_report_settings-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-management-config')
                        </div>
                    </div>
    </div>
</div>


















































































































</div>
</div> 
</div>