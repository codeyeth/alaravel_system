<script>
    window.addEventListener('clearSearch', event => {
        $("#search_input").focus();
    })
    
    window.onload = function() {
        document.getElementById("search_input").focus();
    };
    
    Livewire.on('showConfirmationButtons', id => {
        $('#quickUpdateDiv_' + id).attr('hidden', 'hidden');
        $('#quickUpdateConfirmationDiv_' + id).removeAttr('hidden', 'hidden');
    })
    
    Livewire.on('hideConfirmationButtons', id => {
        $('#quickUpdateDiv_' + id).removeAttr('hidden', 'hidden');
        $('#quickUpdateConfirmationDiv_' + id).attr('hidden', 'hidden');
    })
</script>