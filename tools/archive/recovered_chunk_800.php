    <div class="container my-5 pt-5">
        <h3 class="fw-bold mb-4" style="color: #333;"><?= __('home.destinations_vn') ?></h3>
        <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=TP Hồ Chí Minh (SGN)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1559508551-44bff1de756b?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Vũng Tàu">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Vũng Tàu</h6>
                            <small class="text-muted">6.329 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=TP Hồ Chí Minh (SGN)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Hồ Chí Minh">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold
        const baggageSubmenu = document.getElementById('baggageSubmenu');
        const upgradeServiceItem = document.getElementById('upgradeServiceItem');
        const upgradeSubmenu = document.getElementById('upgradeSubmenu');

        function hideAllSubmenus() {
            if (baggageServiceItem) baggageServiceItem.classList.remove('active');
            if (baggageSubmenu) baggageSubmenu.style.display = 'none';
            if (upgradeServiceItem) upgradeServiceItem.classList.remove('active');
            if (upgradeSubmenu) upgradeSubmenu.style.display = 'none';
        }

        if (baggageServiceItem && baggageSubmenu) {
            baggageServiceItem.addEventListener('click', function(e) {
                e.preventDefault();
                const isActive = this.classList.contains('active');
                hideAllSubmenus();
                if (!isActive) {
                    this.classList.add('active');
                    baggageSubmenu.style.display = 'flex';
                }
            });
        }

        if (upgradeServiceItem && upgradeSubmenu) {
            upgradeServiceItem.addEventListener('click', function(e) {
                e.preventDefault();
                const isActive = this.classList.contains('active');
                hideAllSubmenus();
                if (!isActive) {
                    this.classList.add('active');
                    upgradeSubmenu.style.display = 'flex';
                }
            });
        }
    </script>
</body>
</html>