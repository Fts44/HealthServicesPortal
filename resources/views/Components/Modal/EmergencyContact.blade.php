<div class="modal fade" id="patient_emergency_contact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_title" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_title">{{$patient_details->firstname."'"}}s Emergency Contact</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">          
                <label class="form-control border-0">
                    Name:
                    <input class="form-control" readonly value="{{ $patient_details->ec_firstname.' '.(($patient_details->ec_middlename) ? $patient_details->ec_middlename.' ' : '').$patient_details->ec_lastname.' '.$patient_details->ec_suffixname }}">    
                </label>
                
                <label class="form-control border-0">
                    Relation to patient:
                    <input class="form-control" readonly value="{{ $patient_details->ec_relationtopatient }}">
                </label>

                <label class="form-control border-0">
                    Bussiness Address:
                    <input class="form-control" readonly value="{{ $patient_details->ec_brgy_name.', '.$patient_details->ec_mun_name.', '.$patient_details->ec_prov_name }}">           
                </label>

                <label class="form-control border-0">
                    Contact:
                    <input class="form-control" readonly value="{{ $patient_details->ec_contact }}">
                </label>

                <label class="form-control border-0">
                    Landline:
                    <input class="form-control" readonly value="{{ $patient_details->ec_landline }}">
                </label>

                <label class="form-control border-0 text-end">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </label>
            </div>
        </div>    
    </div>
</div>