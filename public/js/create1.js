function alertDelete(el, event){
    event.preventDefault();
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Get form dan URL
            const form = el.closest('form');
            const url = form.action;
            const formData = new FormData(form);

            // AJAX Request
            fetch(url, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Berhasil - hapus row dari tabel
                    Swal.fire({
                        title: "Deleted!",
                        text: data.message,
                        icon: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
                    
                    // Hapus baris tabel
                    el.closest('tr').remove();
                } else {
                    // Gagal
                    Swal.fire({
                        title: "Error!",
                        text: data.message,
                        icon: "error"
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: "Error!",
                    text: "Terjadi kesalahan saat menghapus data",
                    icon: "error"
                });
            });

        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelled",
                text: "Data aman :)",
                icon: "info"
            });
        }
    });
}