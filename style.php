<?php

wp_enqueue_style("normalize", plugins_url('css/normalize.css', __FILE__));
wp_enqueue_style('wpcvp_bootstrap', plugins_url('css/bootstrap.min.css', __FILE__));
wp_enqueue_style('wpcvp_bootstrap', plugins_url('css/bootstrap-grid.min.css', __FILE__));
wp_enqueue_style('wpcvp_bootstrap', plugins_url('css/bootstrap-reboot.min.css', __FILE__));
wp_enqueue_style('wpcvp_glyphicon', plugins_url('css/glyphicon.css', __FILE__));
wp_enqueue_style('wpcvp_style', plugins_url('css/wp_curriculo_style.css', __FILE__));

wp_enqueue_style('wpcvp_bugs', plugins_url('bugs.php', __FILE__));

wp_enqueue_script('jquery');
wp_enqueue_style("jquery-ui-core", '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
wp_enqueue_script("jquery-ui-autocomplete");
wp_enqueue_script('wpcvp_popper', plugins_url('js/popper.js', __FILE__));
wp_enqueue_script('wpcvp_bootstrap', plugins_url('js/bootstrap.min.js', __FILE__));
wp_enqueue_script('wpcvp_bootstrap', plugins_url('js/bootstrap.bundle.min.js', __FILE__));
wp_enqueue_script('wpcvp_scriptMask', plugins_url('js/jquery.maskedinput-1.1.4.pack.js', __FILE__));
wp_enqueue_script('wpcvp_scriptArea', plugins_url('js/scriptArea.js', __FILE__));
wp_enqueue_script('wpcvp_script', plugins_url('js/script.js', __FILE__));

// wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap.min.css', __FILE__));
// wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-grid.min.css', __FILE__));
// wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-reboot.min.css', __FILE__));
// wp_enqueue_style('glyphicon', plugins_url('../css/glyphicon.css', __FILE__));
// wp_enqueue_style('wpcvpa_style', plugins_url('css/style.css', __FILE__));
// wp_enqueue_script('jquery');
// wp_enqueue_script("jquery-ui-autocomplete");
// wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.min.js', __FILE__));
// wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.bundle.min.js', __FILE__));
// wp_enqueue_script('wpcvpa_scriptMask', plugins_url('../js/jquery.maskedinput-1.1.4.pack.js', __FILE__));
// wp_enqueue_script('wpcvpa_scriptArea', plugins_url('../js/scriptArea.js', __FILE__));
// wp_enqueue_script('wpcvpa_script', plugins_url('js/script.js', __FILE__));
?>
