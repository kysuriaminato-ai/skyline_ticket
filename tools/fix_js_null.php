<?php
$c = file_get_contents('app/Views/flights/search.php');

// Fix: Add null check for sortFlights function
$c = str_replace(
    "function sortFlights(sortType, dropdownText) {\n            const container = document.getElementById('flightsListContainer');\n            const cards = Array.from(container.querySelectorAll('.flight-card'));",
    "function sortFlights(sortType, dropdownText) {\n            const container = document.getElementById('flightsListContainer');\n            if (!container) return;\n            const cards = Array.from(container.querySelectorAll('.flight-card'));",
    $c
);

// Also try with \r\n line endings
$c = str_replace(
    "function sortFlights(sortType, dropdownText) {\r\n            const container = document.getElementById('flightsListContainer');\r\n            const cards = Array.from(container.querySelectorAll('.flight-card'));",
    "function sortFlights(sortType, dropdownText) {\r\n            const container = document.getElementById('flightsListContainer');\r\n            if (!container) return;\r\n            const cards = Array.from(container.querySelectorAll('.flight-card'));",
    $c
);

// Fix applyFilters too
$c = str_replace(
    "const cards = document.querySelectorAll('.flight-card');\n            let visibleCount = 0;",
    "const cards = document.querySelectorAll('.flight-card');\n            if (cards.length === 0) return;\n            let visibleCount = 0;",
    $c
);
$c = str_replace(
    "const cards = document.querySelectorAll('.flight-card');\r\n            let visibleCount = 0;",
    "const cards = document.querySelectorAll('.flight-card');\r\n            if (cards.length === 0) return;\r\n            let visibleCount = 0;",
    $c
);

file_put_contents('app/Views/flights/search.php', $c);
echo "JS null-check fix applied!";
