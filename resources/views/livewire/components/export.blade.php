<div class="col-md-4 text-right">
    <div class="row d-flex">
        <div class="col-md-6 text-right">
            <div class="action-buttons">
                <select wire:model="exportFormat" class="form-control" id="exportFormat">
                    <option value="">Export As...</option>
                    <option value="exportToCSV">CSV</option>
                    <option value="exportToExcel">Excel</option>
                    <option value="exportToPDF">PDF</option>
                    <option value="print">Print</option>
                    <option value="copy">Copy</option>
                </select>
            </div>
        </div>
    
        <div class="col-md-6 text-right">
            <button wire:click="export(exportFormat)" class="btn btn-primary export">Export</button>
        </div>

    </div>
</div>
