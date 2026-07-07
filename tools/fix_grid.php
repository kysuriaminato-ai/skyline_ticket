<?php
$c = file_get_contents('app/Views/flights/search.php');

// We need to remove the remaining `<div class="dropdown">...</div></div>` which was orphaned
$c = preg_replace('/<div class="dropdown">\s*<button class="sort-dropdown-btn.*?<\/ul>\s*<\/div>\s*<\/div>/is', '', $c);

// Double check if there are any trailing </div>s that might break col-lg-9
// Wait, I can just match from `<div class="dropdown">` up to `</ul> </div> </div>`

file_put_contents('app/Views/flights/search.php', $c);
echo "Fixed grid layout by removing orphaned dropdown and extra closing tag.";
