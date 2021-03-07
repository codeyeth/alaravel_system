<div>
<div>

      <!-- Small Stats Blocks -->
      <div class="row">

              <div class="col-lg col-md-6 col-sm-6 mb-4">
                <div class="stats-small stats-small--1 card card-small">
                  <div class="card-body p-0 d-flex">
                    <div class="d-flex flex-column m-auto">
                      <div class="stats-small__data text-center">
                        <span class="stats-small__label text-uppercase">Total Ballot ID of Delivery With DR No</span>
                        <h6 class="stats-small__value count my-3">2,390</h6>
                      </div>
                      <div class="stats-small__data">
                       <!--if you want to add percentage od increase
                            <span class="stats-small__percentage stats-small__percentage--increase">4.7%</span>
                        -->
                      </div>
                    </div>
                    <canvas height="120" class="blog-overview-stats-small-1"></canvas>
                  </div>
                </div>
              </div>
            </div>
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card card-small mb-1">
                <div class="card-header border-bottom">
                    <h6 class="m-0">All Ballots scanned in delivery</h6>
                </div>
                <div class="card-body pt-0 pb-3 text-center">
                    <div class="row border-bottom py-2 mb-0 bg-light">
                        <div class="col-12 col-sm-12">
                            <input class="form-control form-control-lg mb-0" type="text" placeholder="Search by Ballot ID or DR No." wire:model="search">
                        </div>
                    </div>
                </div>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item p-0 pb-3 text-center">
                
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col" class="border-0">Ballot ID</th>
                                    <th scope="col" class="border-0">DR NO.</th>
                                    <th scope="col" class="border-0">City / Municipality / Province</th>
                                    <th scope="col" class="border-0">Clustered Precint</th>
                                    <th scope="col" class="border-0">Quantity</th>
                                    <th scope="col" class="border-0">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
            
                            </tbody>
                        </table>
                   
                        <br>
                        <p style="text-align: center">Not found.</p>    
                     
                    </li>
                    <li class="list-group-item px-3">
                      
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
