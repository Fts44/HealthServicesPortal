@extends('Layouts.PatientMain')

@push('title')
    <title>Announcement</title>
@endpush

@section('content')
<main id="main" class="main">
    <div class="pagetitle mb-2">
        <h1 class="mb-1">Announcement</h1>
        <div class="page-nav">
        </div>
    </div>
    <section class="section mt-2">

        <div class="row">
            
            <div class="row d-flex justify-content-center">
                @foreach($announcements as $a)
                    <div class="card col-lg-8">
                        <div class="card-body p-4">  
                            <h5><b>{{ $a->anm_title }}</b></h5>
                            <!-- <label>By: {{ $a->position." ".$a->firstname }}</label><br> -->
                            <label>Status: 
                                @if($a->anm_active_until>=date('Y-m-d'))
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Not Active</span>
                                @endif
                            </label>
                            <br><br>

                            <div class="col-lg-12">
                                @php echo $a->anm_body; @endphp
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>        
        
    </section>

    {{ $announcements->links() }}
</main>
@endsection

@push('script')
    <!-- datatable js -->
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
@endpush