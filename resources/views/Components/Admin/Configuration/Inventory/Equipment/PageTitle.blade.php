<div class="pagetitle mb-2">
    <h1 class="mb-1">Configuration Inventory Equipment</h1>
    <div class="page-nav">
        <nav class="btn-group">   
            <a href="{{ route('AdminConfigurationInventoryEquipmentName') }}" class="btn btn-sm btn-outline-primary {{(route('AdminConfigurationInventoryEquipmentName')==url()->current()) ? 'active' : ''}}">Name</a>
            <a href="{{ route('AdminConfigurationInventoryEquipmentBrand') }}" class="btn btn-sm btn-outline-primary {{(route('AdminConfigurationInventoryEquipmentBrand')==url()->current()) ? 'active' : ''}}">Brand</a>
            <a href="{{ route('AdminConfigurationInventoryEquipmentType') }}" class="btn btn-sm btn-outline-primary {{(route('AdminConfigurationInventoryEquipmentType')==url()->current()) ? 'active' : ''}}">Type</a>           
            <a href="{{ route('AdminConfigurationInventoryEquipmentPlace') }}" class="btn btn-sm btn-outline-primary {{(route('AdminConfigurationInventoryEquipmentPlace')==url()->current()) ? 'active' : ''}}">Place</a>
        </nav>
    </div>
</div>