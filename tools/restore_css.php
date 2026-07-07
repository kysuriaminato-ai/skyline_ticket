<?php
$c = file_get_contents('app/Views/home/index.php');

$broken_css = <<<CSS
          /* HERO SECTION */
          .hero-section {
              background: 
url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2074&auto=format&fit=crop') no-repeat center 
center/cover;
              padding: 160px 0 40px;
              position: relative;
              display: flex;
              flex-direction: column;
              padding: 30px; 
              position: relative; 
          }
CSS;
$broken_css = str_replace(array("\r", "\n"), "", $broken_css);
$broken_css = preg_replace('/\s+/', ' ', $broken_css);

// We need to replace the broken CSS with the correct one.
// Let's use preg_replace on the file contents directly.
$pattern = '/\/\*\s*HERO SECTION\s*\*\/.*?\n\s*\.main-tabs\s*\{/is';

$fixed_css = <<<CSS
          /* HERO SECTION */
          .hero-section {
              background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2074&auto=format&fit=crop') no-repeat center center/cover;
              padding: 160px 0 40px;
              position: relative;
              display: flex;
              flex-direction: column;
              justify-content: center;
          }
          .hero-section::before {
              content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
              background: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 15%, rgba(0,0,0,0.3) 100%);
          }
          
          /* TABS CONTROLS */
          .search-container { position: relative; z-index: 20; margin-top: 20px; margin-bottom: 20px; }
          .search-box { 
              background: rgba(255, 255, 255, 0.5); 
              backdrop-filter: blur(20px); 
              -webkit-backdrop-filter: blur(20px);
              border: 1px solid rgba(255, 255, 255, 0.6);
              border-radius: 15px; 
              box-shadow: 0 15px 40px rgba(0,0,0,0.15); 
              padding: 30px; 
              position: relative; 
          }
          
          .main-tabs {
CSS;

$c = preg_replace($pattern, $fixed_css, $c);
file_put_contents('app/Views/home/index.php', $c);
echo "Restored CSS and fixed z-index.";
