<div class="pagetitle mb-2">
    <h1 class="mb-1">Inventory Medicine</h1>
    <div class="page-nav">
        <nav class="btn-group">   
            <a href="{{ route('AdminInventoryMedicineAll') }}" class="btn btn-sm btn-outline-primary {{(route('AdminInventoryMedicineAll')==url()->current()) ? 'active' : ''}}">All</a> 
            <a onclick="$('#inv_med').submit();" class="btn btn-sm btn-outline-primary {{(route('AdminInventoryMedicineItem')==url()->current()) ? 'active' : ''}}">Items</a>
            <a onclick="$('#inv_med_report').submit();" class="btn btn-sm btn-outline-primary {{(route('AdminInventoryMedicineReport')==url()->current()) ? 'active' : ''}}">Report</a>
        </nav>
    </div>
</div>