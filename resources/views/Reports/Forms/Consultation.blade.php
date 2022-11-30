<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $filename }}</title>
</head>
<body>
<style>
        * {
            font-size: 13px;
            font-family: 'Times', Verdana, Tahoma, "DejaVu Sans", sans-serif;
        }

        .c{
            text-align:center;
        }

        .r{
            text-align:right;
        }

        table, td, th {
            border: 1px solid black;
        }

        table tr th {
            text-align:center;
        }

        table{
            border-collapse: collapse;
            width: 100%;
        }

        .nb {
            border: none;
        }

        .ns {
            border-left: none;
            border-right: none;
        }

        .nbt{
            border-top: none;
        }

        .nbl{
            border-left: none;
        }

        .nbr{
            border-right: none;
        }

        .nbb{
            border-bottom: none;
        }

        .ws{
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        .wt{
            border-top: 1px solid black;
        }

        .wb{
            border-bottom: 1px solid black;
        }

        .tu{
            text-transform: uppercase;
        }

        td {
            height: 18px;
        }

        .u {
            text-decoration: underline;
        }

        .chck { 
            font-family: DejaVu Sans, sans-serif;
        }

        input[type=checkbox]:before { font-family: DejaVu Sans; font-size: 20px; }
        input[type=checkbox] { display: inline; }
    </style>

    <table class="nb" cellpadding="2">
        <thead class="nb">
            <tr class="nb">
                @for($i=1; $i<=50; $i++)
                    <th class="nb" style="width: 2%"></th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="c">
                    <img src="storage/SystemFiles/logo.png" alt="logo" style="width: 50px;">
                </td>
                <td colspan="16">
                    BatStateU-ARASOF
                </td>
                <td colspan="16">
                    BatStateU-ARASOF
                </td>
                <td colspan="14">
                    BatStateU-ARASOF
                </td>
            </tr>
            <tr>
                <td colspan="50" class="c">
                    <b>MEDICAL CONSULTATION FORM</b>
                </td>
            </tr>
            <tr>
                <td colspan="25" class="nbr nbb">
                    Name: {{ $d->firstname.' '.$d->middlename.' '.$d->lastname }}
                </td>
                <td colspan="25" class="nbl nbb">
                    Program/ Office: {{ $d->cnslt_program_office }}
                </td>
            </tr>
            <tr>
                <td colspan="50" class="nbt">
                    Address: {{ $d->brgy_name.', '.$d->mun_name.', '.$d->prov_name }}
                </td>
            </tr>
            <tr>
                <td colspan="25" class="c">
                    <b>NURSE' NOTES</b>
                </td>
                <td colspan="25" class="c">
                    <b>DOCTOR'S NOTES</b>
                </td>
            </tr>
            <tr>
                <td colspan="6" class="c">Date</td>
                <td colspan="19" class="c">Notes</td>
                <td colspan="6" class="c">Date</td>
                <td colspan="19" class="c">Notes</td>
            </tr>
            <tr>
                <td colspan="6">
                    <div style="min-height: 1050px;">
                        @php 
                            if($d->cnslt_nnotes){
                                echo date_format(date_create($fd->form_date_created), "M d, Y");
                            }
                        @endphp 
                    </div>
                </td>
                <td colspan="19">
                    <div style="min-height: 1050px;">
                        @php 
                            echo $d->cnslt_nnotes;
                        @endphp 
                        @if($pd->position=='nurse' || $pd->position=='admin')
                            <b>Chief of Complain: </b> {{ $d->ccc_category }}
                            <br> <br>
                            <b>Assessment</b>
                                <ul>
                                    <li>BP: {{ $d->cnslt_bp }}</li>
                                    <li>Temp: {{ $d->cnslt_temp }}</li>
                                    <li>HR: {{ $d->cnslt_hr }}</li>
                                    <li>Oxygen Level: {{ $d->cnslt_ol }}</li>
                                    <li>Diagnosis: {{ $d->cnslt_diagnosis }}</li>
                                </ul>

                            <div style="text-align: center;">
                            <img src="{{ 'storage/signature/'.$pd->signature }}" alt="physician_signature" style="height: 60px; margin-bottom: -2rem; margin-top: 20px;"> <br> 
                                {{ $pd->ttl_title.'. '.$pd->firstname.' '.(($pd->middlename) ? $pd->middlename[0].'. ' : ' ').' '.$pd->lastname }} <br>
                                Nurse Signature
                            </div>
                        @endif
                    </div>
                </td>
                <td colspan="6">
                    <div style="min-height: 1050px;">
                        @php 
                            if($d->cnslt_dnotes){
                                echo date_format(date_create($fd->form_date_created), "M d, Y");
                            }
                        @endphp 
                    </div>
                </td>
                <td colspan="19">
                    <div style="min-height: 1050px;">
                        @php 
                            echo $d->cnslt_dnotes;
                        @endphp
                        @if($pd->position=='dentist' || $pd->position=='doctor')
                            <b>Chief of Complain</b>
                            <b>Assessment</b>
                                <ul>
                                    <li>BP: </li>
                                    <li>Temp: </li>
                                    <li>HR: </li>
                                    <li>Oxygen Level: </li>
                                    <li>Diagnosis: </li>
                                </ul>
                            <div style="text-align: center;">
                                <img src="{{ 'storage/signature/'.$pd->signature }}" alt="physician_signature" style="height: 60px; margin-bottom: -2rem; margin-top: 20px;"> <br> 
                                {{ $pd->ttl_title.'. '.$pd->firstname.' '.(($pd->middlename) ? $pd->middlename[0].'. ' : ' ').' '.$pd->lastname }} <br>
                                Doctor Signature
                            </div>
                        @endif
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>