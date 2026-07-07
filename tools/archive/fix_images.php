<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$search = <<<EOD
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1564507592227-0b0b5c0658e7?auto=format&fit=crop&w=200&q=80" alt="Nhà thờ"><span>Nhà thờ Hồi giáo</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1473580044384-7ba9967e16a0?auto=format&fit=crop&w=200&q=80" alt="Sa mạc"><span>Sa mạc</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1502602898657-3e907a5ea58f?auto=format&fit=crop&w=200&q=80" alt="Tháp"><span>Tháp</span></a>
EOD;

$replace = <<<EOD
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1542820229-081e0c12af0b?auto=format&fit=crop&w=200&q=80" alt="Nhà thờ"><span>Nhà thờ Hồi giáo</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1509316785289-025f5b846b35?auto=format&fit=crop&w=200&q=80" alt="Sa mạc"><span>Sa mạc</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1524397057412-257a075e7703?auto=format&fit=crop&w=200&q=80" alt="Tháp"><span>Tháp</span></a>
EOD;

$content = str_replace($search, $replace, $content);
file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Fixed category images!";
