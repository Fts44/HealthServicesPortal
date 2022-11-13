<div class="pagetitle mb-2">
    <h1 class="mb-1">Configuration Inventory Medicine</h1>
    <div class="page-nav">
        <nav class="btn-group">   
            <a href="{{ route('AdminConfigurationInventoryMedicineGenericName') }}" class="btn btn-sm btn-outline-primary {{(route('AdminConfigurationInventoryMedicineGenericName')==url()->current()) ? 'active' : ''}}">Generic Name</a>
            <a href="{{ route('AdminConfigurationInventoryMedicineBrand') }}" class="btn btn-sm btn-outline-primary {{(route('AdminConfigurationInventoryMedicineBrand')==url()->current()) ? 'active' : ''}}">Brand</a>
        </nav>
    </div>
</div>