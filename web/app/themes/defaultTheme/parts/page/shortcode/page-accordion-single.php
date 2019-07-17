<?php
$acc_class = 'single-accordion';
$acc_style = '';
if($vars['state'] === 'open') {
    $acc_class .= ' active';
    $acc_style = ' style="display:block;"';
}
?>
<div class="<?php echo $acc_class; ?>">
	<div class="single-accordion__title"><h4><?php echo $vars['title']; ?><span class="single-accordion__icons"></span></h4></div>
    <div class="single-accordion__content"<?php echo $acc_style; ?>><?php echo do_shortcode($content); ?></div>
</div>
