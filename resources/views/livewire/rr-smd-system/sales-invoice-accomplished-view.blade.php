<div>
    <h2 style="text-align: center" class="mb-2">
        <strong> SALES SECTION </strong>
    </h2>
    <h5 style="text-align: center" class="mb-2">Sales and Marketing Division</h5>
    <h5 style="text-align: center"><b> MONTHLY REPORT ON INDIVIDUAL ACCOMPLISHMENTS (PER PROCESSED S.I) </b></h5>
    <h5 style="text-align: center">{{ Str::title($monthSelected) }} {{ $dateSiFrom->day }}-{{ $dateSiTo->day }}, {{ $dateSiTo->year }}</h5>
    
    <div class="col-sm-12 col-md-12">
        @if (count($accomplishedResult) > 0 && count($getCount) > 0 )
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="text-align: center">NAME</th>
                    <th style="text-align: center">1ST WEEK <br> (1-7)</th>
                    <th style="text-align: center">2ND WEEK <br> (8-15)</th>
                    <th style="text-align: center">3RD WEEK <br> (16-22)</th>
                    <th style="text-align: center">4TH WEEK <br> (23- {{ $endOfMonth }} )</th>
                    <th style="text-align: center">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accomplishedResult as $accomplished_result)
                <tr>
                    <td style="text-align: center">{{ $accomplished_result['name'] }}</td>
                    
                    @foreach ($getCount as $get_count)
                    @if ( $accomplished_result['name'] == $get_count['belongs_to'] )
                    <td style="text-align: center"> {{ $get_count['count'] }} </td>
                    @endif
                    
                    @endforeach
                    
                    <td style="text-align: center">
                        {{ $getCountCollection->where('belongs_to', $accomplished_result['name'])->sum('count') }}
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align: center" class="text-danger"><b> {{ $getCountCollection->sum('count') }} </b>
                    </td>
                </tr>
            </tfoot>
        </table>
        
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="d-flex">
                    <div class="col-sm-12 col-md-6">
                        <h6 class="mb-1"><b>Prepared by:</b></h6>
                        <br>
                        <br>
                        <p style="text-align: center" class="mb-1"> {{ $preparedBy }}</p> 
                        <p style="text-align: center"> {{ $prepPosition }}</p> 
                    </div>
                    
                    <div class="col-sm-12 col-md-6">
                        <h6 class="mb-1"><b>Submitted by:</b></h6>
                        <br>
                        <br>
                        <p style="text-align: center" class="mb-1">{{ $submittedBy }}</p> 
                        <p style="text-align: center">{{ $subPosition }}</p> 
                    </div>
                </div>
            </div>
        </div>
        
        @else
        <br>
        <p style="text-align: center">No Accomplished S.I Found.</p>
        @endif
    </div>
</div>
