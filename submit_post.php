<?php
/**
 * @package WordPress
 * @subpackage oo-bento_Theme
 */
?>

<?php
/**
 * Template Name: tougao
 * 作者：露兜
 * 博客：http://www.ludou.org/
 *
 * 更新记录
 *  2010年09月09日 ：
 *  首个版本发布
 *  
 *  2011年03月17日 ：
 *  修正时间戳函数，使用wp函数current_time('timestamp')替代time()
 *  
 *  2011年04月12日 ：
 *  修改了wp_die函数调用，使用合适的页面title
 *  
 *  2013年01月30日 ：
 *  错误提示，增加点此返回链接
 *  
 *  2013年07月24日 ：
 *  去除了post type的限制；已登录用户投稿不用填写昵称、email和博客地址
 */
   
if (!isset($_SESSION)) {
    session_start();
    session_regenerate_id(TRUE);
}
 
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send') {
  if(empty($_POST['captcha_code'])
    || empty($_SESSION['ludou_lcr_secretword'])
    || (trim(strtolower($_POST['captcha_code'])) != $_SESSION['ludou_lcr_secretword'])
  ) {
    wp_die('验证码不正确！<a href="'.$current_url.'">点此返回</a>');
  }
    global $wpdb;
    $current_url = 'http://blog.suse.org.cn/contribute/';   // 注意修改此处的链接地址

    $last_post = $wpdb->get_var("SELECT `post_date` FROM `$wpdb->posts` ORDER BY `post_date` DESC LIMIT 1");

    // 博客当前最新文章发布时间与要投稿的文章至少间隔120秒。
    // 可自行修改时间间隔，修改下面代码中的120即可
    // 相比Cookie来验证两次投稿的时间差，读数据库的方式更加安全
    if ( current_time('timestamp') - strtotime($last_post) < 120 ) {
        wp_die('您投稿也太勤快了吧，先歇会儿！<a href="'.$current_url.'">点此返回</a>');
    }
       
    // 表单变量初始化
    $name = isset( $_POST['tougao_authorname'] ) ? trim(htmlspecialchars($_POST['tougao_authorname'], ENT_QUOTES)) : '';
    $email =  isset( $_POST['tougao_authoremail'] ) ? trim(htmlspecialchars($_POST['tougao_authoremail'], ENT_QUOTES)) : '';
    $blog =  isset( $_POST['tougao_authorblog'] ) ? trim(htmlspecialchars($_POST['tougao_authorblog'], ENT_QUOTES)) : '';
    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
    $category =  isset( $_POST['cat'] ) ? (int)$_POST['cat'] : 0;
    $content =  isset( $_POST['tougao_content'] ) ? trim($_POST['tougao_content']) : '';
    $content = str_ireplace('?>', '?&gt;', $content);
    $content = str_ireplace('<?', '&lt;?', $content);
    $content = str_ireplace('<script', '&lt;script', $content);
    $content = str_ireplace('<a ', '<a rel="external nofollow" ', $content);
   
    // 表单项数据验证
    if ( empty($name) || mb_strlen($name) > 20 ) {
        wp_die('昵称必须填写，且长度不得超过20字。<a href="'.$current_url.'">点此返回</a>');
    }
   
    if ( empty($email) || strlen($email) > 60 || !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
        wp_die('Email必须填写，且长度不得超过60字，必须符合Email格式。<a href="'.$current_url.'">点此返回</a>');
    }
   
    if ( empty($title) || mb_strlen($title) > 100 ) {
        wp_die('标题必须填写，且长度不得超过100字。<a href="'.$current_url.'">点此返回</a>');
    }
   
    if ( empty($content) || mb_strlen($content) > 3000 || mb_strlen($content) < 10) {
        wp_die('内容必须填写，且长度不得超过3000字，不得少于100字。<a href="'.$current_url.'">点此返回</a>');
    }
   
    $post_content = '昵称: '.$name.'<br />Email: '.$email.'<br />blog: '.$blog.'<br />内容:<br />'.$content;
   
    $tougao = array(
        'post_title' => $title,
        'post_content' => $post_content,
        'post_category' => array($category)
    );


    // 将文章插入数据库
    $status = wp_insert_post( $tougao );
 
    if ($status != 0) {
        // 投稿成功给博主发送邮件
        // somebody#example.com替换博主邮箱
        // My subject替换为邮件标题，content替换为邮件内容
        wp_mail("somebody#example.com","投稿成功","您在 openSUSE 中国站点的投稿已成功。");

        wp_die('投稿成功！感谢投稿！<a href="'.$current_url.'">点此返回</a>', '投稿成功');
    }
    else {
        wp_die('投稿失败！<a href="'.$current_url.'">点此返回</a>');
    }
}
?>

<?php get_header(); ?>


<!-- Start: Main Content Area -->
<div id="content" class="container_16 ui-oo-content-wrapper">
  <div class="box box-shadow grid_12 alpha main">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post" id="post-<?php the_ID(); ?>">
      <h2><?php the_title(); ?></h2>
        <div class="entry">
          <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

<!-- 关于表单样式，请自行调整-->
<form class="ludou-tougao" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; $current_user = wp_get_current_user(); ?>">
    <div style="text-align: left; padding-top: 10px; margin-left: 10px;">
        <label for="tougao_authorname">昵称:*</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_login; ?>" id="tougao_authorname" name="tougao_authorname" />
    </div>

    <div style="text-align: left; padding-top: 10px; margin-left: 10px;">
        <label for="tougao_authoremail">E-Mail:*</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_email; ?>" id="tougao_authoremail" name="tougao_authoremail" />
    </div>
                   
    <div style="text-align: left; padding-top: 10px; margin-left: 10px;">
        <label for="tougao_authorblog">您的博客:</label>
        <input type="text" size="40" value="<?php if ( 0 != $current_user->ID ) echo $current_user->user_url; ?>" id="tougao_authorblog" name="tougao_authorblog" />
    </div>

    <div style="text-align: left; padding-top: 10px; margin-left: 10px;">
        <label for="tougao_title">文章标题:*</label>
        <input type="text" size="40" value="" id="tougao_title" name="tougao_title" />
    </div>

    <div style="text-align: left; padding-top: 10px; margin-left: 10px;">
        <label for="tougaocategorg">分类:*</label>
        <?php wp_dropdown_categories('hide_empty=0&id=tougaocategorg&show_count=1&hierarchical=1'); ?>
    </div>
                   
    <div style="text-align: left; padding-top: 10px; margin-left: 10px;">
        <label style="vertical-align:top" for="tougao_content">文章内容:*</label>
        <textarea rows="15" cols="80" id="tougao_content" name="tougao_content"></textarea>
    </div>
                   
<div style="text-align: left; padding-top: 10px; margin-left: 10px;">
  <label for="CAPTCHA">验证码:
    <input id="CAPTCHA" style="width:110px;*float:left;" class="input" type="text" tabindex="24" size="10" value="" name="captcha_code" /> 看不清？<a href="javascript:void(0)" onclick="document.getElementById('captcha_img').src='<?php bloginfo('template_url'); ?>/captcha/captcha.php?'+Math.random();document.getElementById('CAPTCHA').focus();return false;">点击更换</a>
  </label>
</div>
   
<div style="text-align: left; padding-top: 10px; margin-left: 10px;">
  <label>
    <img id="captcha_img" src="<?php bloginfo('template_url'); ?>/captcha/captcha.php" />
  </label>
</div>
           
<br clear="all">

    <div style="text-align: left; padding-top: 10px; margin-left: 75px;">
        <input type="hidden" value="send" name="tougao_form" />
        <input type="submit" value="提交" />
        <input type="reset" value="重填" />
    </div>
</form>
<script charset="utf-8" src="<?php bloginfo('template_url'); ?>/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="<?php bloginfo('template_url'); ?>/kindeditor/lang/zh_CN.js"></script>
<script>
/* 编辑器初始化代码 start */
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('#tougao_content', {
        resizeType : 1,
        allowPreviewEmoticons : false,
        allowImageUpload : true, /* 开启图片上传功能，不需要就将true改成false */
        items : [
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link']
        });
    });
/* 编辑器初始化代码 end */
</script>



          <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

        </div>
      </div>
      <?php endwhile; endif; ?>
    <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

  </div>

  <?php get_sidebar(); ?>

</div>
<!-- End: Main Content Area -->

<?php get_footer(); ?>
