<script>
    Livewire.on('newSalesInvoiceAdded', event => {
        Livewire.emit('refreshTable');
    })

    Livewire.on('newPurchaseOrderAdded', event => {
        Livewire.emit('refreshTable');
    })
</script>