
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
               
<div class="box box-default">
    <div class="box-header with-border hidden">
        <h3 class="box-title">Request Form</h3>
    </div>
    
    {!! Form::open(['action' => 'MotorpoolRequestjController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data' ,
    'autocomplete' => 'off', 'class' => 'create-twoot-panel' ]) !!}
    @csrf
<div class="box-body">

    
    <div class="form-group">
        <label for="newTwootType"><strong>REQUESTING EMPLOYEE: <br> </strong>
            <span class="required"> PLEASE ALWAYS INCLUDE YOUR FULLNAME *</span>
        </label>
        <input type="text" class="form-control" id="empName" name="empName" required wire:model="empName" />
    </div>
    
    <div class="form-group">
        <label for="newTwootType"><strong>AUTHORIZING SUPERVISOR/DIVISION CHIEF:</strong>
            <span class="required"> *</span>
        </label>
        <input type="text" class="form-control" id="chiefName" name="chiefName" required wire:model="chiefName" />
    </div>
    
    <div class="form-group">
        <label for="newTwootType"><strong>DESTINATION: (  {{ strlen($destination) }}  / 120 ) </strong>
            <span class="required">*</span>
        </label>
        <textarea id="destination" name="destination" rows="4" class="form-control" maxlength="120" wire:model="destination" required></textarea>
    </div>
    
    <div class="form-group">
        <label for="newTwootType"><strong>DATE OF USE:</strong>
            <span class="required"> *</span>
        </label>
        <input type="text" class="form-control" id="date" name="date" required data-date-format="dd MM yyyy"  data-link-format="dd MM yyyy"/>
   
        <script type="text/javascript">
            $('#date').datetimepicker({
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                minView: 2,
                forceParse: 0
            });
        </script>
    </div>
    
    <div class="form-group">
        <label for="newTwootType"><strong>TIME OF USE:</strong>
            <span class="required"> *</span>
        </label>
        <input type="text" class="form-control" id="time" name="time" required data-date-format="HH:ii p" data-link-field="dtp_input3" data-link-format="hh:ii"/>
        <script type="text/javascript">
            $('#time').datetimepicker({
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 1,
                minView: 0,
                maxView: 1,
                forceParse: 0,
                showMeridian: 1
            });
        </script>
    </div>
    
    <div class="form-group">
        
        <label for="newTwootType"><strong>PURPOSE:</strong>
            <span class="required"> *</span>
        </label>
        <input type="text" class="form-control" id="purpose" name="purpose" required wire:model="purpose" />
    </div>
    
</div>

  
<div class="box-footer">
<button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-flat">SUBMIT REQUEST</button>
    </div>
    
   
            </div>
           
        </div>
    </div>
</div>
{!! Form::close() !!}


















