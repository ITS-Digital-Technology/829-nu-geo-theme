<?php
function show_post_tags($id = false) {
    $tags = get_the_tags($id);

    if (!empty($tags)) :
?>
<ul class="post-tags">
    <?php
    foreach ($tags as $tag) :
        $name = $tag->name;
        $url = get_tag_link($tag);
    ?>
    <li class="post-tags__tag">
        <a class="post-tags__link" href="<?php echo $url; ?>">
            <?php echo $name; ?>
        </a>
    </li>
    <?php
    endforeach;
    ?>
</ul>
<?php
    endif;
}