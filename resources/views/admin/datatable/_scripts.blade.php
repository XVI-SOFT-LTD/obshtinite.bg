<script>
    function confirmDelete(id) {
        if (confirm('Сигурни ли сте, че искате да изтриете този запис?')) {
            $.ajax({
                url: '{{ route($routes . '.destroy', '') }}' + '/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('#row_' + id).fadeOut('slow');
                },
                error: function(xhr, status, error) {
                    alert('Възникна грешка при изтриването на записа!');
                }
            });
        }
    }
</script>
