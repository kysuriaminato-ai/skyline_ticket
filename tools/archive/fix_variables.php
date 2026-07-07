<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

// Fix missing $data array usage
$content = str_replace('$recommended', '$data[\'recommended\']', $content);
$content = str_replace('$topDomestic', '$data[\'topDomestic\']', $content);
$content = str_replace('$topIntl', '$data[\'topIntl\']', $content);
$content = str_replace('$imageMapping', '$data[\'imageMapping\']', $content);

// Ensure the airline carousel has its CSS
$css_to_add = <<<EOD
    /* AIRLINES CAROUSEL */
    .airlines-carousel-wrapper { position: relative; width: 100%; overflow: hidden; }
    .airlines-carousel { display: flex; gap: 15px; overflow-x: auto; scroll-behavior: smooth; scrollbar-width: none; -ms-overflow-style: none; padding: 10px 5px; }
    .airlines-carousel::-webkit-scrollbar { display: none; }
    .airline-pill { display: flex; align-items: center; gap: 10px; background: rgba(255,255,255,0.7); border-radius: 50px; padding: 10px 15px; cursor: pointer; transition: 0.3s; white-space: nowrap; text-decoration: none; min-width: 160px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .airline-pill:hover { background: rgba(255,255,255,0.95); transform: translateY(-3px); }
    .airline-logo-wrap { width: 35px; height: 35px; border-radius: 50%; background: #fff; display: flex; align-items: center; justify-content: center; overflow: hidden; }
    .airline-name { font-weight: 700; font-size: 13px; color: #333; }
    .carousel-arrow { position: absolute; top: 50%; transform: translateY(-50%); width: 35px; height: 35px; border-radius: 50%; background: #234b4e; border: none; color: white; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; box-shadow: 0 4px 12px rgba(0,0,0,0.2); }
    .carousel-arrow.left { left: 0; }
    .carousel-arrow.right { right: 0; }
EOD;

if (strpos($content, '.airlines-carousel-wrapper') === false) {
    $content = str_replace('</style>', $css_to_add . "\n</style>", $content);
}

// Replace the hardcoded airlines block with the full interactive one
$old_airlines = <<<EOD
            <!-- SEARCH TOP AIRLINES -->
            <div class="glass-panel">
                <h3>Search Top Airlines</h3>
                <div class="airlines-carousel-wrapper" style="padding: 0;">
                    <div class="airlines-carousel" style="padding: 10px 0;">
                        <!-- Vietnam Airlines -->
                        <a href="<?= BASEURL ?>/flight/search?airline=vn" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                            <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://vietnamairlines.com" alt="VNA" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name" style="font-size: 13px;">VN Airlines</span>
                        </a>
                        <!-- Vietjet Air -->
                        <a href="<?= BASEURL ?>/flight/search?airline=vj" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                            <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://vietjetair.com" alt="VJ" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name" style="font-size: 13px;">Vietjet Air</span>
                        </a>
                        <!-- Bamboo Airways -->
                        <a href="<?= BASEURL ?>/flight/search?airline=qh" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                            <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://bambooairways.com" alt="QH" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name" style="font-size: 13px;">Bamboo Airways</span>
                        </a>
                    </div>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>
EOD;

$new_airlines = <<<EOD
            <!-- SEARCH TOP AIRLINES -->
            <div class="glass-panel">
                <h3>Search Top Airlines</h3>
                <div class="airlines-carousel-wrapper">
                    <button class="carousel-arrow left" id="airlineArrowLeft"><i class="fas fa-chevron-left"></i></button>
                    <div class="airlines-carousel" id="airlinesCarousel">
                        <!-- Vietnam Airlines -->
                        <a href="<?= BASEURL ?>/flight/search?airline=vn" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://vietnamairlines.com" alt="VNA" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">VN Airlines</span>
                        </a>
                        <!-- Vietjet Air -->
                        <a href="<?= BASEURL ?>/flight/search?airline=vj" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://vietjetair.com" alt="VJ" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">Vietjet Air</span>
                        </a>
                        <!-- Bamboo Airways -->
                        <a href="<?= BASEURL ?>/flight/search?airline=qh" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://bambooairways.com" alt="QH" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">Bamboo Airways</span>
                        </a>
                        <!-- Emirates -->
                        <a href="<?= BASEURL ?>/flight/search?airline=emirates" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://emirates.com" alt="Emirates" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">Emirates</span>
                        </a>
                        <!-- Qatar Airways -->
                        <a href="<?= BASEURL ?>/flight/search?airline=qatar" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://qatarairways.com" alt="Qatar" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">Qatar Airways</span>
                        </a>
                        <!-- ANA -->
                        <a href="<?= BASEURL ?>/flight/search?airline=ana" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://ana.co.jp" alt="ANA" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">ANA</span>
                        </a>
                        <!-- Cathay Pacific -->
                        <a href="<?= BASEURL ?>/flight/search?airline=cathay" class="airline-pill">
                            <div class="airline-logo-wrap"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://cathaypacific.com" alt="Cathay" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name">Cathay Pacific</span>
                        </a>
                    </div>
                    <button class="carousel-arrow right" id="airlineArrowRight"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>
EOD;

$content = str_replace($old_airlines, $new_airlines, $content);
file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Fixed data arrays and airlines carousel!";
