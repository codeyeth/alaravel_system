<div>
    <h2 style="text-align: center" class="mb-1">
        <strong> COURIER VIEW DETAILS</strong>
    </h2>
    
    <br>
    
    <h5 class="mb-1"><b>COURIER NAME:</b> {{ $courierName }} - {{ $contactNo }}</h5>
    <h5 class="mb-1"><b>COMPANY NAME:</b> {{ $companyName }}</h5>
    <h5 class="mb-1"><b>COMPANY ADDRESS:</b> {{ $companyAddress }}</h5>
    <h5 class="mb-1"><b>VEHICLE TYPE:</b> {{ $vehicleType }}</h5>
    <h5 class="mb-1"><b>DR CLAIMED:</b> {{ $drNo }}</h5>
    
    <hr class="hr_dashed">
    
    <iframe src="{{ asset ('/storage/courier_files/') }}/{{ $fileUpload }}" style="border:none;" title="Courier Attached File" height="1080px" width="100%"></iframe>
</div>
