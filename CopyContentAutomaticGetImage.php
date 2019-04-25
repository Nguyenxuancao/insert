// Copy content automatic get image, automatic set featured image.
if ( !class_exists( 'CopyContentAutomaticGetImage' ) ) {
	class CopyContentAutomaticGetImage{

		function __construct(){

		add_filter( 'content_save_pre',array($this,'post_save_images') ); 
		add_action('save_post',array($this,'_l_save_post') );
		}

		function post_save_images( $content ){
			if( ($_POST['save'] || $_POST['publish'] )){
			set_time_limit(240);
			global $post;
			$post_id=$post->ID;
			$preg=preg_match_all('/<img.*?src="(.*?)"/',stripslashes($content),$matches);
				if($preg){
					foreach($matches[1] as $image_url){
					if(empty($image_url)) continue;
						$pos=strpos($image_url,$_SERVER['HTTP_HOST']);
						if($pos===false){
							$res=$this->save_images($image_url,$post_id);
							$replace=$res['url'];
							$content=str_replace($image_url,$replace,$content);
						}
					}
				}
			}
			remove_filter( 'content_save_pre', array( $this, 'post_save_images' ) );
			return $content;
		}

		function save_images($image_url,$post_id){
			$file=file_get_contents($image_url);
			$post = get_post($post_id);
			$posttitle = $post->post_title;
			$postname = sanitize_title($posttitle);
			$im_name = "$postname-$post_id.jpg";
			$res=wp_upload_bits($im_name,'',$file);
			$this->insert_attachment($res['file'],$post_id);
			return $res;
		}

		function insert_attachment($file,$id){
			$dirs=wp_upload_dir();
			$filetype=wp_check_filetype($file);
			$attachment=array(
				'guid'=>$dirs['baseurl'].'/'._wp_relative_upload_path($file),
				'post_mime_type'=>$filetype['type'],
				'post_title'=>preg_replace('/\.[^.]+$/','',basename($file)),
				'post_content'=>'',
				'post_status'=>'inherit'
				);
			$attach_id=wp_insert_attachment($attachment,$file,$id);
			$attach_data=wp_generate_attachment_metadata($attach_id,$file);
			wp_update_attachment_metadata($attach_id,$attach_data);
			return $attach_id;
		}
		function _l_save_post($post_id) {
			if (!defined('DOING_AUTOSAVE')||!DOING_AUTOSAVE) {
			if (!($id=wp_is_post_revision($post_id)))
				$id=$post_id;
				if (isset($_POST['content'])&&!get_post_thumbnail_id($id)) {
					$match=array();
					preg_match('/"[^"]*wp\-image\-(\d+)/',$_POST['content'],$match);
				if (isset($match[1])) set_post_thumbnail($post_id,intval($match[1]));
				}
			}
		}
	}
	new CopyContentAutomaticGetImage();
}
