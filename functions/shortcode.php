<?php
// ===== Шорткоды =====
function year() {
$year = date('Y');
return $year;
}
add_shortcode('year', 'year');


?>