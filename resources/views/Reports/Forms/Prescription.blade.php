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
    </style>

    <table class="nb" cellpadding="2">
        <thead class="nb">
            <tr class="nb">
                @for($i=1; $i<=20; $i++)
                    <th class="nb" style="width: 5%;"></th>
                @endfor
            </tr>
        </thead>
        <tbody>
            <tr class="nb">
                <td class="ws c" colspan="1">
                    <img src="storage/SystemFiles/logo.png" alt="logo" style="width: 50px;">
                </td>
                <td class="ws" colspan="4">
                    Reference No. <br>
                    BatStateU
                </td>
                <td class="ws" colspan="4">
                    Effectivity Date:
                </td>
                <td class="ws wr" colspan="3">
                    Rev No.#
                </td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="ws c nbb" colspan="12">
                    <b> BATANGAS STATE UNIVERSITY </b><br>
                    <b> National Engineering University </b><br>
                    ARASOF <br>
                    Bucana St, Nasugbu, Batangas <br>
                    <br>
                    <b>MEDICAL PRESCRIPTION PAD</b>
                </td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="ws r nbt nbb" colspan="12">
                    Date: <u>{{ date_format(date_create($pres->form_date_created), 'F d, Y') }}</u> &nbsp;
                </td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="ws nbt nbb" colspan="12">&nbsp; Name: <u>{{ $pres->pfn.' '.(($pres->pmn) ? $pres->pmn.'. ' : '').$pres->pln }}</u></td>
                <td class="nb" coslpan="8"></td>
            </tr>
            @php
                $date = new DateTime($pres->birthdate);
                $now = new DateTime($pres->form_date_created);
                $interval = $now->diff($date);
            @endphp 
            <tr class="nb">
                <td class="ws nbt nbb" colspan="12">&nbsp; Age/Sex/Status: <u>{{ $interval->y."/".ucwords($pres->pg)."/".ucwords($pres->civil_status) }}</u></td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="ws nbt nbb" colspan="12"><br>&nbsp; <b>Rx</b></td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="ws nbt nbb" colspan="12">
                    <div style="padding-left: 10px; padding-left: 5px;">
                        @php 
                            echo $pres->pres_body;
                        @endphp 
                    </div>
                </td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="ws nbt nbb c" colspan="12">
                    --- Nothing follows ---
                    <br> <br>
                </td>
                <td class="nb" coslpan="8"></td>
            </tr>
            <tr class="nb">
                <td class="nb ws wb c" colspan="12">
                    <img src="storage/signature/{{ $pres->ds }}" alt="" style="height: 70px; margin-bottom: -2rem;"> <br>
                    <b><u>{{ strtoupper($pres->dt.'. '.$pres->dfn.' '.(($pres->dmn) ? $pres->dmn[0].'. ' : $pres->dln).$pres->dln) }}</u></b> <br>
                    Attending Physician <br>
                    License No. <b><u>{{ $pres->dlicense }}</u></b> <br><br>
                </td>
                <td class="nb" coslpan="8"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>