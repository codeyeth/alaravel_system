
<div class='card card-small mb-3'>
    <div class="card-header border-bottom mb-3">
        <form class="col-12">
        <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                <ul class="nav nav-tabs justify-content-end" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active">OB</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ asset('/delivery_fts') }}" >FTS</a>
                </li>
            </ul>
            <ul class="nav nav-tabs"  role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Create DR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab" aria-controls="hats">DR Number Report </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab" aria-controls="hats">Daily DR Report </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#hats" role="tab" id="hats-tab" data-toggle="tab" aria-controls="hats">Batch DR Report </a>
                </li>
            </ul>
        </form>
    </div>
    <div class='card-body p-0'>
        <ul class="list-group list-group-flush">
        <div class="col-lg-12 col-md-12">
            <div class="card card-small mb-3"><!-- Add New Post Form -->
                <div>
                        <div >
                        <div >
                        @include('livewire.j-livewire.delivery.delivery-ob-home')
                            </div> 
                            <div >
                            @include('livewire.j-livewire.delivery.delivery-create-ob')
                            </div>
                         </div>
                        <div >
                        @include('livewire.j-livewire.delivery.delivery-ob-dr-report')
                        </div>
                        <div >
                        @include('livewire.j-livewire.delivery.delivery-ob-daily-report')
                        </div>
                        <div >
                        @include('livewire.j-livewire.delivery.delivery-ob-batch-report')
                        </div>
          
            </div>
            <br />
    </div> <!-- / Add New Post Form -->

                    

                    


































































                    
        </div>
        
                 
            </ul>
            
</div>

