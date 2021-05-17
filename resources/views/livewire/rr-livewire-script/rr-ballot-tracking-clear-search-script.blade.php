<script>
    window.addEventListener('clearSearch', event => {
        $("#search_input").focus();
    })
    
    window.onload = function() {
        document.getElementById("search_input").focus();
    };
</script>