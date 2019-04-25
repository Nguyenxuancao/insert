//Automatic internal link
add_filter( 'the_content', 'lv_auto_internal_links' );
add_filter( 'the_excerpt', 'lv_auto_internal_links' );
function lv_auto_internal_links( $text ) {
    $replace = array(
        'Automatic internal link' => '<a title="Automatic internal link" href="http://longvietweb.com/automatic-internal-link-tu-dong-lien-ket-noi-bo.html">Automatic internal link</a>',
        'SEO On Page' => '<a title="SEO On Page" href="http://longvietweb.com/automatic-internal-link-tu-dong-lien-ket-noi-bo.html">SEO On Page</a>',
    );
    $text = str_replace( array_keys($replace), $replace, $text );
    return $text;
}
