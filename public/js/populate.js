function clear_select(input, default_text){
    $(input).empty();
    $(input).append($('<option>', {
        value: '',
        text: default_text
    }));
}

function ucwords(str){
	var result = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
    	return letter.toUpperCase();
	});
	return result;
}

function set_municipality(select_mun, mun_code, prov_code, select_brgy){
    $(select_mun).empty();
    clear_select(select_mun,'--- choose ---');
    clear_select(select_brgy,'--- choose ---');
    $.ajax({
        url: window.location.origin+"/populate/municipality/"+prov_code,
        type: "GET",
        success: function (response) {      
            $.each( response, function( key, item ) {
                $(select_mun).append($('<option>', { 
                    value: item.mun_code,
                    text : item.mun_name,
                    selected: (item.mun_code==mun_code) ? true : false
                }));
            });
        },
        error: function(response) {
            console.log(response);
        }
    });
};

function set_barangay(select_brgy, brgy_code, mun_code){
    $(select_brgy).empty();
    clear_select(select_brgy,'--- choose ---');
    $.ajax({
        url: window.location.origin+"/populate/barangay/"+mun_code,
        type: "GET",
        success: function (response) {      
            $.each( response, function( key, item ) {
                $(select_brgy).append($('<option>', { 
                    value: item.brgy_code,
                    text : item.brgy_name,
                    selected: (item.brgy_code==brgy_code) ? true : false
                }));
            });
        },
        error: function(response) {
            console.log(response);
        }
    });
};

function set_department(select_dept, dept_id, gl_id, select_program){
    $(select_dept).empty();
    $(select_program).empty();
    clear_select(select_dept,'--- choose ---');
    clear_select(select_program,'--- choose ---');
    $.ajax({
        url: window.location.origin+"/populate/department/"+gl_id,
        type: "GET",
        success: function (response) {      
            $.each( response, function( key, item ) {
                $(select_dept).append($('<option>', { 
                    value: item.dept_id,
                    text : item.dept_code,
                    selected: (item.dept_id==dept_id) ? true : false
                }));
            });
        },
        error: function(response) {
            console.log(response);
        }
    });
}

function set_program(select_prog, prog_id, dept_id){
    $(select_prog).empty();
    clear_select(select_prog,'--- choose ---');
    $.ajax({
        url: window.location.origin+"/populate/program/"+dept_id,
        type: "GET",
        success: function (response) {      
            $.each( response, function( key, item ) {
                $(select_prog).append($('<option>', { 
                    value: item.prog_id,
                    text : item.prog_code,
                    selected: (item.prog_id==prog_id) ? true : false
                }));
            });
        },
        error: function(response) {
            console.log(response);
        }
    });
}

