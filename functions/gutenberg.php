<?php

//Ред блоков Гутенбкрг
function wporg_block_wrapper( $block_content, $block ) {
    if ( $block['blockName'] === 'core/paragraph' ) {
        $content = '<div class="container wp-block-paragraph">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    } elseif ( $block['blockName'] === 'core/heading' ) {
        $content = '<div class="container wp-block-heading">';
        $content .= $block_content;
        $content .= '</div>';
        return $content;
    }
    return $block_content;
}
add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );


?>