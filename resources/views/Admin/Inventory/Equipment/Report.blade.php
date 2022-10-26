@extends('Layouts.AdminMain')

@push('title')
    <title>Inventory Equipment</title>
@endpush

@section('content')
<main id="main" class="main">
    @include('Components.Admin.Inventory.EquipmentPageTitle')   

    <section class="section mt-2">

        <div class="card" id="card-table">

            <div class="card-body px-4">

                <h5 class="card-title">Equipment Report</h5>

                <div class="row mb-2 d-flex flex-row-reverse">
                    <label class="col-lg-2" style="max-width: 90px;">
                        <button class="btn btn-sm btn-secondary" id="search">Search</button>
                    </label>
                    <label class="col-lg-4 p-0" style="max-width: 120px;">
                        <select class="form-select" name="year" id="year">
                            @for($i=2020; $i<=date('Y'); $i++)
                                <option value="{{$i}}" {{ ($i==$year) ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                    </label>
                    
                </div>
                <table id="datatable" class="table table-bordered" style="width: 100%;">
                    <thead class="table-light">
                        <th scope="col">Category</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Description</th>
                        <th class="no-sort" scope="col">Jan</th>
                        <th class="no-sort" scope="col">Feb</th>
                        <th class="no-sort" scope="col">Mar</th>
                        <th class="no-sort" scope="col">Apr</th>
                        <th class="no-sort" scope="col">May</th>
                        <th class="no-sort" scope="col">Jun</th>
                        <th class="no-sort" scope="col">Jul</th>
                        <th class="no-sort" scope="col">Aug</th>
                        <th class="no-sort" scope="col">Sep</th>
                        <th class="no-sort" scope="col">Oct</th>
                        <th class="no-sort" scope="col">Nov</th>
                        <th class="no-sort" scope="col">Dec</th>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{ $item->ieid_category }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->ieid_unit }}</td>
                        <td>
                            {{ 'NAME: '.$item->ien_name }} <br>
                            {{ 'TYPE: '.$item->iet_type }} <br>
                            {{ 'BRAND: '.$item->ieb_brand }} <br>
                            {{ 'PLACE: '.$item->iep_place }} <br>
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=1)
                                    @if(($item->jan_1+$item->jan_0)>0)
                                        {{ 'Working: '.$item->jan_1 }} <br>
                                        {{ 'Not working: '.$item->jan_0 }} <br>
                                        {{ 'Total: '.($item->jan_1+$item->jan_0) }}
                                    @endif
                                @endif
                            @else
                                @if(($item->jan_1+$item->jan_0)>0)
                                    {{ 'Working: '.$item->jan_1 }} <br>
                                    {{ 'Not working: '.$item->jan_0 }} <br>
                                    {{ 'Total: '.($item->jan_1+$item->jan_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=2)
                                    @if(($item->feb_1+$item->feb_0)>0)
                                        {{ 'Working: '.$item->feb_1 }} <br>
                                        {{ 'Not working: '.$item->feb_0 }} <br>
                                        {{ 'Total: '.($item->feb_1+$item->feb_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->feb_1+$item->feb_0)>0)
                                    {{ 'Working: '.$item->feb_1 }} <br>
                                    {{ 'Not working: '.$item->feb_0 }} <br>
                                    {{ 'Total: '.($item->feb_1+$item->feb_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=3)
                                    @if(($item->mar_1+$item->mar_0)>0)
                                        {{ 'Working: '.$item->mar_1 }} <br>
                                        {{ 'Not working: '.$item->mar_0 }} <br>
                                        {{ 'Total: '.($item->mar_1+$item->mar_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->mar_1+$item->mar_0)>0)
                                    {{ 'Working: '.$item->mar_1 }} <br>
                                    {{ 'Not working: '.$item->mar_0 }} <br>
                                    {{ 'Total: '.($item->mar_1+$item->mar_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=4)
                                    @if(($item->apr_1+$item->apr_0)>0)
                                        {{ 'Working: '.$item->apr_1 }} <br>
                                        {{ 'Not working: '.$item->apr_0 }} <br>
                                        {{ 'Total: '.($item->apr_1+$item->apr_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->apr_1+$item->apr_0)>0)
                                    {{ 'Working: '.$item->apr_1 }} <br>
                                    {{ 'Not working: '.$item->apr_0 }} <br>
                                    {{ 'Total: '.($item->apr_1+$item->apr_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=5)
                                    @if(($item->may_1+$item->may_0)>0)
                                        {{ 'Working: '.$item->may_1 }} <br>
                                        {{ 'Not working: '.$item->may_0 }} <br>
                                        {{ 'Total: '.($item->may_1+$item->may_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->may_1+$item->may_0)>0)
                                    {{ 'Working: '.$item->may_1 }} <br>
                                    {{ 'Not working: '.$item->may_0 }} <br>
                                    {{ 'Total: '.($item->may_1+$item->may_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=6)
                                    @if(($item->jun_1+$item->jun_0)>0)
                                        {{ 'Working: '.$item->jun_1 }} <br>
                                        {{ 'Not working: '.$item->jun_0 }} <br>
                                        {{ 'Total: '.($item->jun_1+$item->jun_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->jun_1+$item->jun_0)>0)
                                    {{ 'Working: '.$item->jun_1 }} <br>
                                    {{ 'Not working: '.$item->jun_0 }} <br>
                                    {{ 'Total: '.($item->jun_1+$item->jun_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=7)
                                    @if(($item->jul_1+$item->jul_0)>0)
                                        {{ 'Working: '.$item->jul_1 }} <br>
                                        {{ 'Not working: '.$item->jul_0 }} <br>
                                        {{ 'Total: '.($item->jul_1+$item->jul_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->jul_1+$item->jul_0)>0)
                                    {{ 'Working: '.$item->jul_1 }} <br>
                                    {{ 'Not working: '.$item->jul_0 }} <br>
                                    {{ 'Total: '.($item->jul_1+$item->jul_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=8)
                                    @if(($item->aug_1+$item->aug_0)>0)
                                        {{ 'Working: '.$item->aug_1 }} <br>
                                        {{ 'Not working: '.$item->aug_0 }} <br>
                                        {{ 'Total: '.($item->aug_1+$item->aug_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->aug_1+$item->aug_0)>0)
                                    {{ 'Working: '.$item->aug_1 }} <br>
                                    {{ 'Not working: '.$item->aug_0 }} <br>
                                    {{ 'Total: '.($item->aug_1+$item->aug_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=9)
                                    @if(($item->sep_1+$item->sep_0)>0)
                                        {{ 'Working: '.$item->sep_1 }} <br>
                                        {{ 'Not working: '.$item->sep_0 }} <br>
                                        {{ 'Total: '.($item->sep_1+$item->sep_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->sep_1+$item->sep_0)>0)
                                    {{ 'Working: '.$item->sep_1 }} <br>
                                    {{ 'Not working: '.$item->sep_0 }} <br>
                                    {{ 'Total: '.($item->sep_1+$item->sep_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=10)
                                    @if(($item->oct_1+$item->oct_0)>0)
                                        {{ 'Working: '.$item->oct_1 }} <br>
                                        {{ 'Not working: '.$item->oct_0 }} <br>
                                        {{ 'Total: '.($item->oct_1+$item->oct_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->oct_1+$item->oct_0)>0)
                                    {{ 'Working: '.$item->oct_1 }} <br>
                                    {{ 'Not working: '.$item->oct_0 }} <br>
                                    {{ 'Total: '.($item->oct_1+$item->oct_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=11)
                                    @if(($item->nov_1+$item->nov_0)>0)
                                        {{ 'Working: '.$item->nov_1 }} <br>
                                        {{ 'Not working: '.$item->nov_0 }} <br>
                                        {{ 'Total: '.($item->nov_1+$item->nov_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->nov_1+$item->nov_0)>0)
                                    {{ 'Working: '.$item->nov_1 }} <br>
                                    {{ 'Not working: '.$item->nov_0 }} <br>
                                    {{ 'Total: '.($item->nov_1+$item->nov_0) }}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($year==date('Y'))
                                @if(date('m')>=12)
                                    @if(($item->dec_1+$item->dec_0)>0)
                                        {{ 'Working: '.$item->dec_1 }} <br>
                                        {{ 'Not working: '.$item->dec_0 }} <br>
                                        {{ 'Total: '.($item->dec_1+$item->dec_0) }}
                                    @endif
                                @endif
                            @elseif($year < date('Y'))
                                @if(($item->dec_1+$item->dec_0)>0)
                                    {{ 'Working: '.$item->dec_1 }} <br>
                                    {{ 'Not working: '.$item->dec_0 }} <br>
                                    {{ 'Total: '.($item->dec_1+$item->dec_0) }}
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <label class="colg-lg-4">
                        <a class="btn btn-sm btn-primary" href="{{ route('AdminInventoryEquipmentReportPrint', ['year'=>$year]) }}"><i class="bi bi-printer"></i> Print</a>
                    </label>
                </div>
            </div>

        </div>

    </section>

</main>
@endsection

@push('script')

    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>

    <script>
        $(document).ready(function(){
            datatable_no_btn_class('#datatable');
            $('#hamburgerMenu').click(function(){
                setTimeout(function() { 
                    redraw_datatable_class('#datatable');
                }, 300);
            });

            $('#search').click(function(){
                var url = "{{ route('AdminInventoryEquipmentReport', ['year'=>'year']) }}";
                window.location.href = url.replace('year', $('#year').val());
            });
        });
    </script>
@endpush