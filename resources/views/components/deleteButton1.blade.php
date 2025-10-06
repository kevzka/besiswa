<div id="ButtonModal" style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.25);justify-content:center;align-items:center;">
    <div style="background:#fff;padding:48px 32px 36px 32px;border-radius:6px;box-shadow:0 2px 16px #0002;min-width:400px;max-width:90vw;text-align:center;">
        <div style="font-size:2em;font-weight:500;margin-bottom:36px;color:black;">{{ $title }}</div>
        <div style="display:flex;justify-content:center;gap:32px;">
            <button id="ButtonYes" style="background:#7cf34a;color:#111;font-size:2em;font-weight:600;padding:8px 38px;border:none;border-radius:6px;box-shadow:0 2px 4px #0001;cursor:pointer;">YA</button>
            <button id="ButtonNo" style="background:#d81c1c;color:#111;font-size:2em;font-weight:600;padding:8px 28px;border:none;border-radius:6px;box-shadow:0 2px 4px #0001;cursor:pointer;">TIDAK</button>
        </div>
    </div>
</div>

<script>
// Variable untuk menyimpan form yang akan disubmit
let currentFormToSubmit = null;

// Function untuk show modal - otomatis cari parent form
function showButtonModal(clickedElement) {
    // Cari parent form dari element yang diklik
    currentFormToSubmit = clickedElement.closest('form');
    
    document.getElementById('ButtonModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

// Hide modal on TIDAK
document.getElementById('ButtonNo').onclick = function() {
    console.log('no clicked');
    document.getElementById('ButtonModal').style.display = 'none';
    document.body.style.overflow = '';
    currentFormToSubmit = null;
}

// Submit form on YA
document.getElementById('ButtonYes').onclick = function() {
    console.log('yes clicked');
    
    if (currentFormToSubmit) {
        currentFormToSubmit.submit();
    }
    
    document.getElementById('ButtonModal').style.display = 'none';
    document.body.style.overflow = '';
    currentFormToSubmit = null;
}

// Hide modal when clicking outside
document.getElementById('ButtonModal').onclick = function(e) {
    if (e.target === this) {
        document.getElementById('ButtonModal').style.display = 'none';
        document.body.style.overflow = '';
        currentFormToSubmit = null;
    }
}
</script>