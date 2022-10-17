function clear_input(input_id){
    $(input_id).val('');
}

function disable_input(input_id){
    $(input_id).attr('disabled', true);
}

function enable_input(input_id){
    $(input_id).attr('disabled', false);
}

function clear_disable_enable_input(basis_input_id,input_id){
    basis = $(basis_input_id).val();
    
    console.log(basis);

    if(basis=="yes" || basis==true){
        enable_input(input_id);
    }
    else{
        clear_input(input_id);
        disable_input(input_id);
    }
}
