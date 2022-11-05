<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $filename }}</title>
</head>
<body>
<style>
        * {
            font-size: 13px;
            font-family: 'Times';
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

        .tu{
            text-transform: uppercase;
        }

        td {
            height: 25px;
        }

        .u {
            text-decoration: underline;
        }

        input[type=checkbox]:before { font-family: DejaVu Sans; font-size: 15px; }
        input[type=checkbox] { display: inline; }
    </style>

    <table class="nb" cellpadding="2">
        <thead class="nb">
            <tr class="nb">
                @for($i=1; $i<=24; $i++)
                    <th width="10%" class="nb"></th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2" class="c">
                    <img src="storage/SystemFiles/logo.png" alt="logo" style="width: 50px;">
                </td>
                <td colspan="7">Something is here</td>
                <td colspan="7">Something is here</td>
                <td colspan="8">Something is here</td>
            </tr>
            <tr>
                <td colspan="11" class="nbr" style="height: 50px;">
                    Date of Medical Examination: {{ date_format(date_create($d->shr_med),'F d, Y') }}
                </td>
                <td colspan="4" class="nbl nbr c">
                    SR-Code: {{ $d->shr_srcode }}
                </td>
                <td colspan="9" class="nbl r">Program: {{ $d->prog_name }}</td>
            </tr> 
            <tr>
                <td colspan="18"></td>
                <td colspan="6" class="c">
                    <img src="storage/forms/shr/pictures/3_1667577924.jpg" alt="logo" style="width: 150px;">
                </td>
            </tr>
            <tr class="ws">
                <td colspan="8" class="nb">
                    <b>LAST NAME:</b><span class="tu"> {{ $d->shr_lastname." ".$d->shr_suffixname }}</span>
                </td>
                <td colspan="8" class="nb">
                    <b>MIDDLE NAME:</b><span class="tu"> {{ $d->shr_middlename }}</span>
                </td>
                <td colspan="8" class="nb">
                    <b>FIRST NAME:</b><span class="tu"> {{ $d->shr_firstname }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="24" class="nb">
                    <b>HOME ADDRESS:</b><span class="tu"> {{ $d->shr_home_address }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="24" class="nb">
                    <b>DORMITORY ADDRESS:</b><span class="tu"> {{ $d->shr_dorm_address }}</span>
                </td>
            </tr>
            <tr class="ws">
                <td colspan="4" class="nb"><b>GENDER:</b><span class="tu"> {{ $d->shr_gender }}</span></td>
                <td colspan="2" class="nb"><b>AGE:</b><span class="tu">{{ $d->shr_age }}</span></td>
                <td colspan="6" class="nb"><b>CIVIL STATUS:</b><span class="tu">{{ $d->shr_civil_status }}</span></td>
                <td colspan="7" class="nb"><b>RELIGION:</b><span class="tu">{{ $d->shr_religion }}</span></td>
                <td colspan="5" class="nb"><b>CONTACT:</b><span class="tu">{{ $d->shr_contact }}</span></td>
            </tr>
            <tr>
                <td colspan="5">
                    <input type="checkbox" {{ ($d->shr_past_illness_heart_disease) ? 'checked' : ''  }}> Heart Disease
                </td>
                <td>
                    <span class="u">soeajtheioahtpo</span>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>