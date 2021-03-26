<script>
    Livewire.on('newUserAdded', event => {
        Livewire.emit('refreshTable');
    })
</script>