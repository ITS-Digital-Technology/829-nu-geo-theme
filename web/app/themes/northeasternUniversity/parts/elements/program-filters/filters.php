<?php //TODO: update styles to change width of element to same as browse-programs ?>
<?php //get_template_part('filter-options'); ?>

<?php
$program_types   = isset( $program_types ) ? $program_types : [];
$countries       = isset( $countries ) ? $countries : [];
$terms           = isset( $terms ) ? $terms : [];
$fields_of_study = isset( $fields_of_study ) ? $fields_of_study : [];
$mobile_modal    = isset( $mobile_modal ) ? $mobile_modal : false;
$block_class[] = 'program-filters';
if($mobile_modal){
    $block_class[] = 'program-filters--modal';
}
?>
<div class="<?php echo implode( ' ', $block_class ); ?>">
    <button class="program-filters__trigger-mobile"><?php _e("Search Programs",'northeasternUniversity'); ?></button>
    <div role="dialog" id="program-mobile-modal" aria-label="program filters" aria-modal="true" class="program-filters__wrapper-outer">
        <div class="container">
            <div class="program-filters__wrapper">
                <div class="program-filters__inner-wrapper-header">
                    <button class="program-filters__mobile-close">
                        <span class="sr-only">Close</span>
                        <span class="icon-close"></span>
                    </button>
                </div>
                <div class="program-filters__scroll">
                    <div class="program-filters__inner-wrapper-content">
                        <div class="program-filters__filters-wrapper">
                        <?php
                            get_theme_part(
                                'elements/program-filters/filter',
                                [
                                    'taxonomy'  => 'program_type',
                                    'label'     => __( 'Program Type','northeasternUniversity' ),
                                    'types'     => $program_types,
                                    'countries' => $countries,
                                    'terms'     => $terms,
                                    'fields_of_study' => $fields_of_study,
                                    'current_label' => __('Program Type', 'northeasternUniversity'),
                                ]
                            );
                            get_theme_part(
                                'elements/program-filters/filter',
                                [
                                    'taxonomy'  => 'country',
                                    'label'     => __( 'Country', 'northeasternUniversity' ),
                                    'types'     => $program_types,
                                    'countries' => $countries,
                                    'terms'     => $terms,
                                    'fields_of_study' => $fields_of_study,
                                    'current_label' => __('Country', 'northeasternUniversity')
                                ]
                            );
                            get_theme_part(
                                'elements/program-filters/filter',
                                [
                                    'taxonomy'  => 'term',
                                    'label'     => __( 'Term', 'northeasternUniversity' ),
                                    'types'     => $program_types,
                                    'countries' => $countries,
                                    'terms'     => $terms,
                                    'fields_of_study' => $fields_of_study,
                                    'current_label' => __('Term', 'northeasternUniversity')
                                ]
                            );
                            get_theme_part(
                                'elements/program-filters/filter',
                                [
                                    'taxonomy'  => 'field_of_study',
                                    'label'     => __( 'Field of Study', 'northeasternUniversity' ),
                                    'types'     => $program_types,
                                    'countries' => $countries,
                                    'terms'     => $terms,
                                    'fields_of_study' => $fields_of_study,
                                    'current_label' => __('Field of Study', 'northeasternUniversity')
                                ]
                            );
                            ?>
                        </div>
                        <div class="program-filters__search-wrapper">
                            <a href="<?php echo get_post_type_archive_link('program') ;?>" class="c-btn c-btn-primary c-btn-color-normal"><span class="sr-only"><?php _e('Click to ','northeasternUniversity');?></span><?php _e('Search Program','northeasternUniversity');?><span class="sr-only"><?php _e(' with selected filters','northeasternUniversity');?></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
