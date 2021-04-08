<script>
    Livewire.on('newSoftcopyAdded', event => {
        Livewire.emit('refreshTable');
        $('#modalPublication').scrollTop(0);
    })
</script>