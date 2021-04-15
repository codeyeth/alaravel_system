<script>
    Livewire.on('newSalesInvoiceAdded', event => {
        Livewire.emit('refreshTable');
    })
</script>