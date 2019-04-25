add_shortcode('member', 'stsv_member_check_shortcode');
function stsv_member_check_shortcode($vip, $content = null) {
  if (is_user_logged_in() && !is_null($content) && !is_feed()) {
 
    return $content;
 
    } else {
   $vip = '<div class="warning">Xin lỗi! Nội dung này chỉ dành riêng cho thành viên của blog.
 
 Click <a href="/wp-login.php?action=register">vào đây</a> để đăng ký thành viên</div>';
 
     return $vip;
}
}
[member]
 
Nội dung cần ẩn với người xem chưa đăng ký thành viên.
 
[/member]
