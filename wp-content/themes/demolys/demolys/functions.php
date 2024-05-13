<?php
/**
 * DemoLys functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package DemoLys
 */
define('error_code', 1);
define('success_code', 0);
if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
function returnajax($rs)
{
    echo json_encode($rs);
    die();
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function demolys_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on DemoLys, use a find and replace
		* to change 'demolys' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'demolys', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'demolys' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'demolys_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'demolys_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function demolys_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'demolys_content_width', 640 );
}
add_action( 'after_setup_theme', 'demolys_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function demolys_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'demolys' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'demolys' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'demolys_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function demolys_scripts() {
	wp_enqueue_style( 'demolys-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'demolys-style', 'rtl', 'replace' );

	wp_enqueue_script( 'demolys-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'demolys_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
function money_check($srt)
{
    return number_format($srt, 0, '.', ',');
}
function getimage($id, $size = 'large', $true = '')
{

    if ($true == 'post') {
        if (get_the_post_thumbnail($id) != null) {
            return get_the_post_thumbnail_url($id, $size);
        }
    } else {
        $attachment_url = wp_get_attachment_image_url($id, $size);
        if ($attachment_url) {
            return $attachment_url;
        }
    }
    return get_field('image_no_image', 'option');

}
function register_ajaxurl()
{
    echo '<script type="text/javascript">
    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
    var cms_adapter_ajax = function cms_adapter_ajax($param) {
         var beforeSend = $param.beforeSend || function() {};
  var complete = $param.complete || function() {}; //
            $.ajax({
                url: $param.url,
                type: $param.type,
                data: $param.data,
                beforeSend: beforeSend, 
                async: true,
                success: $param.callback,
                complete: complete 
  });
        };
  </script>';
}
function no_sql_injection($input)
{
    $arr = array("from", "select", "insert", "insert", "delete", "where", "drop", "drop table", "show tables", "*", "=", "update");
    $sql = str_replace($arr, "", $input);
    return trim(strip_tags(addslashes($sql))); #strtolower()
}

function xss($input)
{
    $input = str_replace('=', '', $input);
    $input = str_replace(';', '', $input);
    $input = str_replace(':', '', $input);
    $input = str_replace('[', '', $input);
    $input = str_replace(']', '', $input);
    $input = str_replace('?', '', $input);
    $input = str_replace('AND', '', $input);
    $input = str_replace('OR ', '', $input);
//    $input = str_replace('&', '', $input);
    $input = str_replace('\'', '', $input);
    $input = str_replace('"', '', $input);
    $input = str_replace('`', '', $input);
    $input = str_replace("'", '', $input);
    $input = str_replace('%', '', $input);
    $input = str_replace('<', '', $input);
    $input = str_replace('>', '', $input);
    $input = str_replace('*', '', $input);
    $input = str_replace('+', '', $input);
    $input = str_replace('#', '', $input);
    $input = str_replace(')', '', $input);
    $input = str_replace('(', '', $input);
    $input = str_replace('\\', '', $input);
    $input = str_replace('\/', '', $input);
//    $input = str_replace('-', '', $input);
    $input = str_replace('SHUTDOWN', '', $input);
    $input = str_replace('DROP', '', $input);
    $input = preg_replace("/[`]/", '', $input);
    $input = addslashes($input);
    $input = htmlspecialchars($input);
    $input = strip_tags($input);

    return $input;
}
add_action('wp_ajax_nopriv_buynow', 'buynow');
add_action('wp_ajax_buynow', 'buynow');

function buynow()
{

    global $wpdb;
   
        if (!isset($_POST['id'])) {
            $rs['status'] = error_code;
            $rs['mess'] = messerror . " Lỗi Validate";
            returnajax($rs);
        }
		
        $product_id = no_sql_injection(xss($_POST['id']));
        if (!empty($_POST['count'])) {
            $count = no_sql_injection(xss($_POST['count']));
        } else {
            $count = 1;
        }
		$hoten = no_sql_injection(xss($_POST['hoten']));
		$sdt = no_sql_injection(xss($_POST['sdt']));
		$email = no_sql_injection(xss($_POST['email']));
		$diachi = no_sql_injection(xss($_POST['diachi']));
		$order = array();
		$order['phone_number'] = $sdt;
		$order['address'] = $diachi;
		$order['full_name'] = $hoten;
		$cart = array(
            'img'=> getimage($product_id,'large','post'),
			'name_sp'=> get_the_title($product_id),
			'count' => $count,
			'dongia'=> get_field('prices',$product_id)
		);
		$order['data_product'] = json_encode($cart);
		$order['email'] = $email;
		$order['time_order'] = time();
		$order['price'] = get_field('prices',$product_id)*$count;
       $cartcode = generate_order_code('tt_orders');
	   
$order['order_code'] = $cartcode;
$order['year'] = date('Y');

$res = $wpdb->insert('tt_orders', $order);
if ($res !== false) {
    $title = get_the_title($product_id);
    $tong_2 = get_field('prices',$product_id) * $count;
    $table = '<table style="width: 1000px;
    border: solid 1px;
    text-align: center;
    border-collapse: collapse;">
                        <thead style="    background: #e5c9c9;">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
</thead>
<tbody>
               <tr>
               <td style="border: solid 1px;">1</td>
               <td style="border: solid 1px;">' . $title . '</td>
               <td style="border: solid 1px;">' . $count . '</td>
               <td style="border: solid 1px;">' . money_check(get_field('prices',$product_id)) . ' VND</td>
               <td style="border: solid 1px;">' . money_check($tong_2) . ' VND</td>
</tr>    
</tbody></table>';
$me = 'Đang thực hiện thanh toán';
            
                $headers = array('Content-Type: text/html; charset=UTF-8');
                $body = get_field('email_order', 'option');
                $body = str_replace('{{__order__}}', $order['order_code'], $body);
                $body = str_replace('{{__name__}}',$order['full_name'], $body);
                $body = str_replace('{{__address__}}', $order['address'], $body);
                $body = str_replace('{{__status__}}', $me, $body);
                $body = str_replace('{{__email__}}', $order['email'], $body);
                $body = str_replace('{{__phone__}}', $order['phone_number'], $body);
                $body = str_replace('{{__table__}}', $table, $body);
                $body = str_replace('{{__money__}}', money_check($order['price']), $body);
                $email_admin = get_field('email_admin','option');
                wp_mail($order['email'], 'Thông tin đơn hàng DemoLys', $body, $headers);
                wp_mail($email_admin, 'Thông tin đơn hàng '. $order['order_code'], $body, $headers);
	$rs['order_code'] = $order['order_code'];
	$rs['status'] = success_code;
	returnajax($rs);
} else {
	$rs['status'] = error_code;
	$rs['mess'] = "Xử lý thông tin không thành công, vui lòng kiểm tra lại thông tin đặt hàng";
	returnajax($rs);
}
        returnajax($rs);
}

function generate_order_code($table_name)
{
    global $wpdb;

    // Tạo mã đơn hàng ban đầu
    $cartcode = 'DH_' . date('Y');

    // Lấy số lượng đơn hàng cho năm hiện tại
    $sql_select = $wpdb->prepare("SELECT count(*) FROM $table_name WHERE year = %d", date('Y'));
    $idcart = $wpdb->get_var($sql_select) + 1;

    // Định dạng $idcart với số 0 ở đầu
    $idcart = sprintf("%05d", $idcart);

    // Ghép chuỗi $idcart đã định dạng vào mã đơn hàng
    $cartcode .= $idcart;

    // Kiểm tra xem mã đơn hàng đã được tạo có tồn tại trong cơ sở dữ liệu chưa
    $existing_order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE order_code = %s", $cartcode));

    // Vòng lặp để đảm bảo mã đơn hàng là duy nhất
    while ($existing_order !== null) {
        $idcart++; // Tăng giá trị của $idcart
        $idcart = sprintf("%05d", $idcart); // Định dạng với số 0 ở đầu
        $cartcode = 'DH_' . date('Y') . $idcart; // Tạo mã đơn hàng mới
        $existing_order = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE order_code = %s", $cartcode));
    }

    return $cartcode;
}
add_action('wp_ajax_nopriv_changePaymentStatus', 'changePaymentStatus');
add_action('wp_ajax_changePaymentStatus', 'changePaymentStatus');

function changePaymentStatus() {
    global $wpdb;
    if(!isset($_POST['status']) || !isset($_POST['orderId'])) {
        $rs['status'] = error_code;
        $rs['mess'] = messerror . " Lỗi Validate";
        returnajax($rs);
    }
    $status = no_sql_injection(xss($_POST['status']));
    $orderId = no_sql_injection(xss($_POST['orderId']));
    if($status < 0 || $status > 8) {
        $rs['status'] = error_code;
        $rs['mess'] = messerror . " Lỗi Validate";
        returnajax($rs);
    }
    $getOrder = $wpdb->get_row("SELECT * FROM tt_orders WHERE id = {$orderId}");
    if(empty($getOrder)) {
        $rs['status'] = error_code;
        $rs['mess'] = "Không tìm thấy đơn hàng. Mời kiểm tra và thử lại.";
        returnajax($rs);
    }
    $wpdb->update(
        'tt_orders',
        array('status' => $status),
        array('id' => $orderId)
    );
    $arr = json_decode( $getOrder->data_product);

    $title = $arr['name_sp'];
    $tong_2 = $arr['dongia'] * $arr['count'];
    $table = '<table style="width: 1000px;
    border: solid 1px;
    text-align: center;
    border-collapse: collapse;">
                        <thead style="    background: #e5c9c9;">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
</thead>
<tbody>
               <tr>
               <td style="border: solid 1px;">1</td>
               <td style="border: solid 1px;">' . $title . '</td>
               <td style="border: solid 1px;">' . $arr['count'] . '</td>
               <td style="border: solid 1px;">' . money_check($arr['dongia']) . ' VND</td>
               <td style="border: solid 1px;">' . money_check($tong_2) . ' VND</td>
</tr>    
</tbody></table>';
if($status == 2){
    $me = 'Thanh toán thành công';
}elseif($status == 3){
    $me = 'Hủy đơn hàng'.' - '. $getOrder->error_payment;

}else{
    $me = 'Đang thực hiện thanh toán';
}
            
                $headers = array('Content-Type: text/html; charset=UTF-8');
                $body = get_field('email_order', 'option');
                $body = str_replace('{{__order__}}', $getOrder->order_code, $body);
                $body = str_replace('{{__name__}}',$getOrder->full_name, $body);
                $body = str_replace('{{__address__}}', $getOrder->address, $body);
                $body = str_replace('{{__status__}}', $me, $body);
                $body = str_replace('{{__email__}}', $getOrder->email, $body);
                $body = str_replace('{{__phone__}}', $getOrder->phone_number, $body);
                $body = str_replace('{{__table__}}', $table, $body);
                $body = str_replace('{{__money__}}', money_check($getOrder->price), $body);
                wp_mail($getOrder->email,'Thông tin đơn hàng DemoLys', $body, $headers);
    $rs['status'] = success_code;
    $rs['mess'] = "Cập nhật trạng thái thành công!";
    returnajax($rs);
}
if (function_exists('acf_add_options_page')) {
    // add parent
    $parent = acf_add_options_page(array(
        'page_title' => 'Tùy chỉnh',
        'menu_title' => 'Tùy chỉnh',
        'redirect' => false
    ));
    // add sub page
    acf_add_options_sub_page(array(
        'page_title' => 'Nội dung gửi mail',
        'menu_title' => 'Nội dung gửi mail',
        'parent_slug' => $parent['menu_slug'],
    ));

}

show_admin_bar(false);