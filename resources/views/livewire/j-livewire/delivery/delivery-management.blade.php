<div>
    <div>
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card card-small mb-1">
                    <ul class="nav nav-pills nav-tabs justify-content-end" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false" wire:ignore.self wire:click="function_dr_types_identifier(0)">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr-tab" data-toggle="tab" href="#dr" role="tab" aria-controls="dr" aria-selected="false" wire:ignore.self wire:click="function_dr_types_identifier(1)">OB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr-tab" data-toggle="tab" href="#dr" role="tab" aria-controls="dr" aria-selected="false" wire:ignore.self wire:click="function_dr_types_identifier(2)">FTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dr_report_settings-tab" data-toggle="tab" href="#dr_report_settings" role="tab" aria-controls="dr_report_settings" aria-selected="false" wire:ignore.self>DR Report Settings</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTab">
                        <input type="text" wire:model="wire_dr_types_identifier" name="input_dr_types_identifier" hidden>
                        <input type="text" wire:model="wire_dr_reports_identifier" name="input_dr_reports_identifier" hidden>
                        @include('livewire.j-livewire.delivery.delivery-dated-reports-modal') 
                        <div class="tab-pane fade show" id="dr_report_settings" role="tabpanel" aria-labelledby="dr_report_settings-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-management-config')
                        </div>
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>   
                            @include('livewire.j-livewire.delivery.delivery-home')
                        </div>
                        <div class="tab-pane fade show" id="dr" role="tabpanel" aria-labelledby="dr-tab" wire:ignore.self>    
                            <ul class="nav nav-pills nav-tabs justify-content-first" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home_dr-tab" data-toggle="tab" href="#home_dr" role="tab" aria-controls="home_dr" aria-selected="false" wire:ignore.self>HOME</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="create_dr-tab" data-toggle="tab" href="#create_dr" role="tab" aria-controls="create_dr" aria-selected="false" wire:ignore.self>CREATE DR</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="dr_number_report-tab" data-toggle="tab" href="#dr_number_report" role="tab" aria-controls="dr_number_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(1)">DR NUMBER REPORT</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="daily_dr_report-tab" data-toggle="tab" href="#daily_dr_report" role="tab" aria-controls="daily_dr_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(2)">DAILY DR REPORT</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="monthly_dr_report-tab" data-toggle="tab" href="#monthly_dr_report" role="tab" aria-controls="monthly_dr_report" aria-selected="false" wire:ignore.self wire:click="function_dr_reports_identifier(3)">MONTHLY DR REPORT</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTab">
                                <div class="tab-pane fade show active" id="home_dr" role="tabpanel" aria-labelledby="home_dr-tab" wire:ignore.self>  
                                    @include('livewire.j-livewire.delivery.delivery-home')
                                </div>
                                <div class="tab-pane fade show" id="create_dr" role="tabpanel" aria-labelledby="create_dr-tab" wire:ignore.self>  
                                    @if($wire_dr_types_identifier == 1)
                                    @include('livewire.j-livewire.delivery.delivery-create-dr')
                                    @endif
                                </div>
                                <div class="tab-pane fade show" id="dr_number_report" role="tabpanel" aria-labelledby="dr_number_repor-tab" wire:ignore.self>  
                                    <div class="card-header border-bottom">
                                        <div @if($wire_dr_types_identifier == 1) @else style="display:none" @endif>
                                        Generate one DR number report for OB <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                        </div>
                                        <div @if($wire_dr_types_identifier == 2) @else style="display:none" @endif>
                                        Generate one DR number report for FTS <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                        </div>
                                        @include('livewire.j-livewire.delivery.delivery-one-dr-report')
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="daily_dr_report" role="tabpanel" aria-labelledby="daily_dr_report-tab" wire:ignore.self>  
                                    <div class="card-header border-bottom">
                                        <div @if($wire_dr_types_identifier == 1) @else style="display:none" @endif>
                                            Generate Daily Report for OB <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                        </div>
                                        <div @if($wire_dr_types_identifier == 2) @else style="display:none" @endif>
                                            Generate Daily Report for FTS <label style="float:right;"> {{$drlistresult}} </label><br><br>
                                        </div>
                                        @include('livewire.j-livewire.delivery.delivery-daily-dr-reports')
                                    </div>
                                </div>
                                <div class="tab-pane fade show" id="monthly_dr_report" role="tabpanel" aria-labelledby="monthly_dr_report-tab" wire:ignore.self>  
                                    <div class="card-header border-bottom">
                                        <div @if($wire_dr_types_identifier == 1) @else style="display:none" @endif>
                                            Generate Monthly DR Report for OB <label style="float:right;"> {{$monthlydrlistresult}} </label><br><br>
                                        </div>
                                        <div @if($wire_dr_types_identifier == 2) @else style="display:none" @endif>
                                            Generate Monthly DR Report for FTS <label style="float:right;"> {{$monthlydrlistresult}} </label><br><br>
                                        </div>
                                        @include('livewire.j-livewire.delivery.delivery-monthly-dr-report')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>


















































































































</div>
</div> 
</div>