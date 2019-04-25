//Insert ads after second paragraph of single post content.

add_filter( 'the_content', 'prefix_insert_post_ads' );

function prefix_insert_post_ads( $content ) {

    $ad_code = '<div>Ads code goes here</div>';

    if ( is_single() && ! is_admin() ) {
        return prefix_insert_after_paragraph( $ad_code, 4, $content );
    }

    return $content;
}

// Parent Function that makes the magic happen

function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {

        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }

        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }

    return implode( '', $paragraphs );
}
////////////////////////
/**
 * Add JS AD vao trang AMP.
 */
function isa_load_amp_adsense_script( $data ) {
    $data['amp_component_scripts']['amp-ad'] = 'https://cdn.ampproject.org/v0/amp-ad-0.1.js';
    return $data;
}
add_filter( 'amp_post_template_data', 'isa_load_amp_adsense_script' );
/**
 * Het JS AD vao trang AMP.
 */
/**
 * Hien thi quang cao phia tren noi dung va ben trong noi dung
 */
add_action( 'pre_amp_render_post', 'isa_amp_add_content_filter' );
 
function isa_amp_add_content_filter() {
    add_filter( 'the_content', 'isa_amp_adsense_above_within_content' );
}
 
function isa_amp_adsense_above_within_content( $content ) {
 
    $publisher_id = 'ca-pub-6962064044804442';
 
    $ad_slot = '3538290840';
 
    $ad_code_end = ' type="adsense" data-ad-client="' . $publisher_id . '" data-ad-slot="' . $ad_slot . '"></amp-ad>';
 
 
    $btf_ad_code = '<amp-ad layout="responsive" width="300" height="250"' . $ad_code_end;

    // Hien thi quang cao trong noi dung sau doan so 1 cua noi dung
    $new_content = isa_insert_after_paragraph( $btf_ad_code, 1, $content );
 
    return $atf_ad_code . $new_content;
 
}
function isa_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '
';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }
        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }
    return implode( '', $paragraphs );
}
