<div class="modal fade" id="patient_vaccination_details" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">{{$patient_details->firstname."'"}}s Vaccination Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">          
                <label class="form-control border-0">
                    Vacciination Status:
                    <input class="form-control" readonly value="{{ ucwords($vs->vs_status) }}">    
                </label>

                <label class="form-control border-0">
                    Phil Health No: 
                    <input class="form-control" readonly value="{{ $vs->vs_philhealth_no }}">    
                </label>

                <label class="form-control border-0">
                    Insurance:
                    <input class="form-control" readonly value="{{ $vs->vs_others }}">    
                </label>

                <label class="form-control border-0">Dossage Details</label>
                @foreach($vdd as $d)
                    <label class="form-control border-0">
                        <label for="" class="form-control">
                            Dossage: {{ $d->vdd_dose_number }} <br>
                            Brand: {{ $d->cvb_brand }} <br>
                            Date: {{ date_format(date_create($d->vdd_date), 'F d, Y') }} <br>
                            Lot No: {{ $d->vdd_lot_number }} <br>
                            Location: {{ $d->mun_name.', '.$d->prov_name }}
                        </label>
                    </label>
                @endforeach 

                

                <label class="form-control border-0 text-end">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </label>
            </div>
        </div>    
    </div>
</div>
