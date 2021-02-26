<?php $options = get_field('program_filters', 'option'); ?>

<?php if ($options): ?>
<style>
  <?php foreach($options as $option): ?>
    <?php if ($option['hide_filter']): ?>
      
      #filter-<?php echo $option['filter_name']; ?> {
        display: none;
      }

    <?php endif; ?>
  <?php endforeach; ?>
</style>
<?php endif; ?>

<?php
get_theme_part( 'archive/program/hero' );
get_theme_part( 'archive/program/filters' );
get_theme_part( 'archive/program/cta' );