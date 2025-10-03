function alertDelete(el, event) {
    event.preventDefault();

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: "Deleting...",
                text: "Please wait...",
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                },
            });

            // Get form dan URL
            const form = el.closest("form");
            const url = form.action;
            const formData = new FormData(form);

            // AJAX Request
            fetch(url, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Berhasil - hapus row dari tabel
                        Swal.fire({
                            title: "Deleted!",
                            text: data.message,
                            icon: "success",
                            timer: 1500,
                            showConfirmButton: false,
                        });

                        // Hapus baris tabel
                        el.closest("tr").remove();
                    } else {
                        // Gagal
                        Swal.fire({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan saat menghapus data",
                        icon: "error",
                    });
                });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelled",
                text: "Data aman :)",
                icon: "info",
            });
        }
    });
}
document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.getElementById("submitBtnForm");
    submitBtn.addEventListener("click", function (event) {
        console.log("tombol ditekan");
        alertSuccessForm(submitBtn, event);
    });
});

function alertSuccessForm(el, event) {
    console.log("Clicked from external JS");
    event.preventDefault();

    // Show loading
    Swal.fire({
        title: "Tambah Kegiatan...",
        text: "Please wait...",
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });

    // Get form dan URL
    const form = el.closest("form");
    const url = form.action;
    const formData = new FormData(form);

    // AJAX Request
    fetch(url, {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("Response data:", data);
            if (data.success) {
                Swal.fire({
                    title: "Published!",
                    text: data.message || "Content published successfully",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false,
                }).then(() => {
                    // // Reset form
                    // form.reset();
                    // resetFilePreview();

                    // Reload table data
                    reloadTableData();
                });
            } else {
                // Gagal
                Swal.fire({
                    title: "Error!",
                    text: data.message,
                    icon: "error",
                });
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            Swal.fire({
                title: "Error!",
                text: "Terjadi kesalahan saat menambah kegiatan",
                icon: "error",
            });
        });
}

function reloadTableData() {
    // Show loading di tabel
    console.log("Reloading table data...");
    const tableBody = document.querySelector(".table-card table tbody");
    if (tableBody) {
        tableBody.innerHTML = '<tr><td colspan="5" style="text-align: center;">Loading...</td></tr>';
    }

    // Determine activity type based on current URL
    const currentPath = window.location.pathname;
    let activityType = 1; // default bimbingan
    
    if (currentPath.includes('bimbingan')) {
        activityType = 1;
    } else if (currentPath.includes('prestasi')) {
        activityType = 2;
    } else if (currentPath.includes('ekskul')) {
        activityType = 3;
    }

    // Fetch data terbaru dengan POST request dan type parameter
    fetch('/api/crud/create', {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            type: activityType
        })
    })
        .then((response) => response.json())
        .then((data) => {
            console.log("API Response:", data);
            if (data.success !== false && data.data) {
                updateTableContent(data.data);
            } else {
                console.error("API returned error:", data.message || 'Unknown error');
                tableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: red;">Error loading data</td></tr>';
            }
        })
        .catch((error) => {
            console.error("Error reloading table:", error);
            const tableBody = document.querySelector(".table-card table tbody");
            if (tableBody) {
                tableBody.innerHTML = '<tr><td colspan="5" style="text-align: center; color: red;">Failed to load data</td></tr>';
            }
        });
}

function updateTableContent(activities) {
    const tableBody = document.querySelector(".table-card table tbody");
    if (!tableBody) return;

    tableBody.innerHTML = "";

    activities.forEach((item, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${item.title}</td>
            <td>${formatDate(item.date)}</td>
            <td></td>
            <td class="table-actions">
                <!-- Action buttons sama seperti di blade -->
            </td>
        `;
        tableBody.appendChild(row);
    });
}
