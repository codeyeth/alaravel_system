



<div class='card card-small mb-3'>
    
    
    
    
    <div class="card-header border-bottom">
        <ul class="nav nav-tabs justify-content-end" role="tablist">
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('/delivery_ob') }}" >OB</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" >FTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ asset('/delivery_configuration') }}">Settings</a>
            </li>
        </ul>
        
        







<ul class="nav nav-tabs" id="myTab" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" wire:ignore.self>Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="profile-tab" data-toggle="tab" href="#create" role="tab" aria-controls="create" aria-selected="false" wire:ignore.self>Create DR</a>
</li>
<li class="nav-item">
<a class="nav-link" id="contact-tab" data-toggle="tab" href="#dr" role="tab" aria-controls="dr" aria-selected="false" wire:ignore.self>DR Number Report</a>
</li>
<li class="nav-item">
<a class="nav-link" id="ballot-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="false" wire:ignore.self>Daily DR Report</a>
</li>
</ul>





<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show" id="daily" role="tabpanel" aria-labelledby="daily-tab" wire:ignore.self>
@include('livewire.j-livewire.delivery.delivery-fts-daily-report')
</div>
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" wire:ignore.self>
@include('livewire.j-livewire.delivery.delivery-fts-home')
</div>
<div class="tab-pane fade show" id="create" role="tabpanel" aria-labelledby="create-tab" wire:ignore.self>
@include('livewire.j-livewire.delivery.delivery-create-fts')
</div>
<div class="tab-pane fade" id="dr" role="tabpanel" aria-labelledby="dr-tab" wire:ignore.self>
@include('livewire.j-livewire.delivery.delivery-fts-dr-report')
</div>
</div>
</div>














































</div>


</ul>

</div>

