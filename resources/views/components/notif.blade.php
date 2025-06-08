{{-- filepath: resources/views/components/notif.blade.php --}}
@if (session('success'))
<div id="alert-success" class="notif-alert notif-success">
    <span class="notif-icon">&#10003;</span>
    <span class="notif-message">{{ session('success') }}</span>
    <button class="notif-close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
</div>
@endif

@if (session('error'))
<div id="alert-error" class="notif-alert notif-error">
    <span class="notif-icon">&#9888;</span>
    <span class="notif-message">{{ session('error') }}</span>
    <button class="notif-close" onclick="this.parentElement.style.display='none'" aria-label="Tutup">&times;</button>
</div>
@endif

<style>
.notif-alert {
    position: fixed;
    top: 32px;
    right: 32px;
    min-width: 260px;
    max-width: 350px;
    z-index: 9999;
    display: flex;
    align-items: center;
    padding: 16px 22px;
    border-radius: 12px;
    font-size: 1rem;
    box-shadow: 0 6px 24px rgba(44,62,80,0.13);
    background: #fff;
    color: #222;
    border-left: 6px solid #4ade80;
    margin-bottom: 10px;
    animation: notif-fadein 0.5s;
    transition: opacity 0.5s;
}
.notif-success {
    border-color: #4ade80;
    background: linear-gradient(90deg, #e8fbe9 80%, #d1fae5 100%);
}
.notif-error {
    border-color: #f87171;
    background: linear-gradient(90deg, #fbeaea 80%, #fee2e2 100%);
}
.notif-icon {
    font-size: 1.5em;
    margin-right: 14px;
    display: flex;
    align-items: center;
}
.notif-message {
    flex: 1;
    font-size: 1.05em;
    font-weight: 500;
    letter-spacing: 0.01em;
}
.notif-close {
    background: none;
    border: none;
    color: #888;
    font-size: 1.3em;
    margin-left: 18px;
    cursor: pointer;
    transition: color 0.2s, transform 0.2s;
    padding: 0 4px;
    line-height: 1;
}
.notif-close:hover {
    color: #222;
    transform: scale(1.2) rotate(90deg);
}
@keyframes notif-fadein {
    from { opacity: 0; transform: translateY(-20px);}
    to   { opacity: 1; transform: translateY(0);}
}
@media (max-width: 600px) {
    .notif-alert {
        right: 10px;
        left: 10px;
        top: 16px;
        min-width: unset;
        max-width: unset;
        font-size: 0.97rem;
        padding: 12px 10px;
    }
    .notif-message { font-size: 1em; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var s = document.getElementById('alert-success');
        var e = document.getElementById('alert-error');
        if(s) { s.style.opacity = 0; setTimeout(()=>s.remove(), 500);}
        if(e) { e.style.opacity = 0; setTimeout(()=>e.remove(), 500);}
    }, 5000); // tampil 5 detik
});
</script>