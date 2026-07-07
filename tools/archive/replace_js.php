<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$search = <<<'EOD'
        // LOGIC TOGGLE BAGGAGE SUBMENU
        const baggageServiceItem = document.getElementById('baggageServiceItem');
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
EOD;

$replace = <<<'EOD'
        // LOGIC TOGGLE EXTRA SERVICES SUBMENUS
        const services = [
            { item: document.getElementById('baggageServiceItem'), menu: document.getElementById('baggageSubmenu') },
            { item: document.getElementById('upgradeServiceItem'), menu: document.getElementById('upgradeSubmenu') },
            { item: document.getElementById('shoppingServiceItem'), menu: document.getElementById('shoppingSubmenu') },
            { item: document.getElementById('hotelServiceItem'), menu: document.getElementById('hotelSubmenu') },
            { item: document.getElementById('insuranceServiceItem'), menu: document.getElementById('insuranceSubmenu') },
            { item: document.getElementById('otherServiceItem'), menu: document.getElementById('otherSubmenu') }
        ];

        function hideAllSubmenus() {
            services.forEach(s => {
                if(s.item) s.item.classList.remove('active');
                if(s.menu) s.menu.style.display = 'none';
            });
        }

        services.forEach(s => {
            if (s.item && s.menu) {
                s.item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isActive = this.classList.contains('active');
                    hideAllSubmenus();
                    if (!isActive) {
                        this.classList.add('active');
                        s.menu.style.display = 'flex';
                    }
                });
            }
        });
EOD;

if (strpos($content, $search) !== false) {
    $content = str_replace($search, $replace, $content);
    file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
    echo "Successfully updated JS logic!";
} else {
    echo "Failed to find the JS block in index.php!";
}
