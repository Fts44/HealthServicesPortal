<div class="pagetitle mb-2">
    <h1 class="mb-1">Inventory Equipment</h1>
    <div class="page-nav">
        <nav class="btn-group">   
            <a href="{{ route('AdminInventoryEquipmentAll') }}" class="btn btn-sm btn-outline-primary {{(route('AdminInventoryEquipmentAll')==url()->current()) ? 'active' : ''}}">All</a> 
            <a href="{{ route('AdminInventoryEquipmentItem') }}" class="btn btn-sm btn-outline-primary {{(route('AdminInventoryEquipmentItem')==url()->current()) ? 'active' : ''}}">Items</a>
            <a href="{{ route('AdminInventoryEquipmentReport', ['year'=>2022]) }}" class="btn btn-sm btn-outline-primary {{(str_contains(url()->current(), '/admin/inventory/equipment/report')) ? 'active' : ''}}">Report</a>
        </nav>
    </div>
</div>