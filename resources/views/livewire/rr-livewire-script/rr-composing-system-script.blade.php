<script>
    Livewire.on('newSoftcopyAdded', event => {
        Livewire.emit('refreshTable');
    })
</script>