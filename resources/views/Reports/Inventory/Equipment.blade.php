<style>
    * {
        font-size: 9px;
        font-family: 'Times';
    }

    .title, th{
        text-align:center;
        font-size: 10px;
    }

    table, td, th {
        border: 1px solid black;
    }

    table tr th {
        text-align:center;
    }

    table{
        font-size: 7px;
        border-collapse: collapse;
        width: 100%;
    }
</style>

<div class="title">
    <span>BATANGAS STATE UNIVERSITY-ARASOF</span><br>
    <span>NASUGBU, BATANGAS</span><br><br>
    <span style="font-weight: bold;">Inventory of Equipment For FY {{ $year }}</span><br>
</div>

<table cellpadding="2">
    <tr>
        <th scope="col" rowspan="2" width="4%">QTY</th>
        <th scope="col" rowspan="2" width="4%">UNIT</th>
        <th scope="col" rowspan="2" width="10%">DESCRIPTION</th>
        <th rowspan="1" colspan="12">MONTH</th>
    </tr>
    <tr>
        <th scope="col" rowspan="1">Jan</th>
        <th scope="col" rowspan="1">Feb</th>
        <th scope="col" rowspan="1">Mar</th>
        <th scope="col" rowspan="1">Apr</th>
        <th scope="col" rowspan="1">May</th>
        <th scope="col" rowspan="1">Jun</th>
        <th scope="col" rowspan="1">Jul</th>
        <th scope="col" rowspan="1">Aug</th>
        <th scope="col" rowspan="1">Sep</th>
        <th scope="col" rowspan="1">Oct</th>
        <th scope="col" rowspan="1">Nov</th>
        <th scope="col" rowspan="1">Dec</th>
    </tr>
    <tbody>
        @php $category = ''; @endphp
        @if(sizeof($items)>0)
            @foreach($items as $item) 
                @if($category != $item->ieid_category)
                    @php $category = $item->ieid_category @endphp
                <tr>
                        <td colspan="15" style="font-weight: bold; text-align: center;">{{ strtoupper($item->ieid_category).' (Category)' }}</td>
                </tr>
                @endif
                <tr>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->ieid_unit }}</td>
                    <td>
                        {{ $item->ien_name }}
                        @if($item->iet_type!='none')
                            <br> {{ $item->iet_type }}
                        @endif
                        @if($item->ieb_brand!='none')
                            <br> {{ $item->ieb_brand }}
                        @endif
                        @if($item->iep_place!='none')
                            <br> {{ $item->iep_place }}
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=1)
                                @if(($item->jan_1+$item->jan_0)>0)
                                    {{ 'Working: '.$item->jan_1 }} <br>
                                    {{ 'Not: '.$item->jan_0 }} <br>
                                    {{ 'Total: '.($item->jan_1+$item->jan_0) }}
                                @endif
                            @endif
                        @else
                            @if(($item->jan_1+$item->jan_0)>0)
                                {{ 'Working: '.$item->jan_1 }} <br>
                                {{ 'Not: '.$item->jan_0 }} <br>
                                {{ 'Total: '.($item->jan_1+$item->jan_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=2)
                                @if(($item->feb_1+$item->feb_0)>0)
                                    {{ 'Working: '.$item->feb_1 }} <br>
                                    {{ 'Not: '.$item->feb_0 }} <br>
                                    {{ 'Total: '.($item->feb_1+$item->feb_0) }}
                                @endif
                            @endif
                        @else
                            @if(($item->feb_1+$item->feb_0)>0)
                                {{ 'Working: '.$item->feb_1 }} <br>
                                {{ 'Not: '.$item->feb_0 }} <br>
                                {{ 'Total: '.($item->feb_1+$item->feb_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=3)
                                @if(($item->mar_1+$item->mar_0)>0)
                                    {{ 'Working: '.$item->mar_1 }} <br>
                                    {{ 'Not: '.$item->mar_0 }} <br>
                                    {{ 'Total: '.($item->mar_1+$item->mar_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->mar_1+$item->mar_0)>0)
                                {{ 'Working: '.$item->mar_1 }} <br>
                                {{ 'Not: '.$item->mar_0 }} <br>
                                {{ 'Total: '.($item->mar_1+$item->mar_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=4)
                                @if(($item->apr_1+$item->apr_0)>0)
                                    {{ 'Working: '.$item->apr_1 }} <br>
                                    {{ 'Not: '.$item->apr_0 }} <br>
                                    {{ 'Total: '.($item->apr_1+$item->apr_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->apr_1+$item->apr_0)>0)
                                {{ 'Working: '.$item->apr_1 }} <br>
                                {{ 'Not: '.$item->apr_0 }} <br>
                                {{ 'Total: '.($item->apr_1+$item->apr_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=5)
                                @if(($item->may_1+$item->may_0)>0)
                                    {{ 'Working: '.$item->may_1 }} <br>
                                    {{ 'Not: '.$item->may_0 }} <br>
                                    {{ 'Total: '.($item->may_1+$item->may_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->may_1+$item->may_0)>0)
                                {{ 'Working: '.$item->may_1 }} <br>
                                {{ 'Not: '.$item->may_0 }} <br>
                                {{ 'Total: '.($item->may_1+$item->may_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=6)
                                @if(($item->jun_1+$item->jun_0)>0)
                                    {{ 'Working: '.$item->jun_1 }} <br>
                                    {{ 'Not: '.$item->jun_0 }} <br>
                                    {{ 'Total: '.($item->jun_1+$item->jun_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->jun_1+$item->jun_0)>0)
                                {{ 'Working: '.$item->jun_1 }} <br>
                                {{ 'Not: '.$item->jun_0 }} <br>
                                {{ 'Total: '.($item->jun_1+$item->jun_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=7)
                                @if(($item->jul_1+$item->jul_0)>0)
                                    {{ 'Working: '.$item->jul_1 }} <br>
                                    {{ 'Not: '.$item->jul_0 }} <br>
                                    {{ 'Total: '.($item->jul_1+$item->jul_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->jul_1+$item->jul_0)>0)
                                {{ 'Working: '.$item->jul_1 }} <br>
                                {{ 'Not: '.$item->jul_0 }} <br>
                                {{ 'Total: '.($item->jul_1+$item->jul_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=8)
                                @if(($item->aug_1+$item->aug_0)>0)
                                    {{ 'Working: '.$item->aug_1 }} <br>
                                    {{ 'Not: '.$item->aug_0 }} <br>
                                    {{ 'Total: '.($item->aug_1+$item->aug_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->aug_1+$item->aug_0)>0)
                                {{ 'Working: '.$item->aug_1 }} <br>
                                {{ 'Not: '.$item->aug_0 }} <br>
                                {{ 'Total: '.($item->aug_1+$item->aug_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=9)
                                @if(($item->sep_1+$item->sep_0)>0)
                                    {{ 'Working: '.$item->sep_1 }} <br>
                                    {{ 'Not: '.$item->sep_0 }} <br>
                                    {{ 'Total: '.($item->sep_1+$item->sep_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->sep_1+$item->sep_0)>0)
                                {{ 'Working: '.$item->sep_1 }} <br>
                                {{ 'Not: '.$item->sep_0 }} <br>
                                {{ 'Total: '.($item->sep_1+$item->sep_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=10)
                                @if(($item->oct_1+$item->oct_0)>0)
                                    {{ 'Working: '.$item->oct_1 }} <br>
                                    {{ 'Not: '.$item->oct_0 }} <br>
                                    {{ 'Total: '.($item->oct_1+$item->oct_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->oct_1+$item->oct_0)>0)
                                {{ 'Working: '.$item->oct_1 }} <br>
                                {{ 'Not: '.$item->oct_0 }} <br>
                                {{ 'Total: '.($item->oct_1+$item->oct_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=11)
                                @if(($item->nov_1+$item->nov_0)>0)
                                    {{ 'Working: '.$item->nov_1 }} <br>
                                    {{ 'Not: '.$item->nov_0 }} <br>
                                    {{ 'Total: '.($item->nov_1+$item->nov_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->nov_1+$item->nov_0)>0)
                                {{ 'Working: '.$item->nov_1 }} <br>
                                {{ 'Not: '.$item->nov_0 }} <br>
                                {{ 'Total: '.($item->nov_1+$item->nov_0) }}
                            @endif
                        @endif
                    </td>
                    <td>
                        @if($year==date('Y'))
                            @if(date('m')>=12)
                                @if(($item->dec_1+$item->dec_0)>0)
                                    {{ 'Working: '.$item->dec_1 }} <br>
                                    {{ 'Not: '.$item->dec_0 }} <br>
                                    {{ 'Total: '.($item->dec_1+$item->dec_0) }}
                                @endif
                            @endif
                        @elseif($year < date('Y'))
                            @if(($item->dec_1+$item->dec_0)>0)
                                {{ 'Working: '.$item->dec_1 }} <br>
                                {{ 'Not: '.$item->dec_0 }} <br>
                                {{ 'Total: '.($item->dec_1+$item->dec_0) }}
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
