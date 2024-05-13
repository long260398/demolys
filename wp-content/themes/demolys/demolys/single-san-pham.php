<?php 
get_header();
$desc = get_field('desc');
$gallery = get_field('gallery');
$info = get_field('info');
$thanh_phan = get_field('thanh_phan');
$hdsd = get_field('hdsd');
$info_more =get_field('info_more');
$video = get_field('video');
$customer = get_field('customer');
$khuyenmai= get_field('khuyenmai');
?>
<main>
    <section class="title-product">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-12 order-xl-1 order-lg-2">
                <div class="image">
                            <div class="image-main">
                                <div class="swiper-wrapper">
                                <?php foreach ($gallery as $value) { ?>
                                        <div class="child swiper-slide">
                                            <figure>
                                                <img src="<?= getimage($value) ?>" alt="">
                                            </figure>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="orther-img">
                                <div class="swiper-wrapper">
                                <?php foreach ($gallery as $value) { ?>
                                        <div class="child swiper-slide">
                                            <figure>
                                                <img src="<?= getimage($value) ?>" alt="">
                                            </figure>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-7 col-lg-12 order-xl-2 order-lg-1">
                    <h2 class="title">
                        <?= get_the_title() ?>
                    </h2>
                    <p class="desc"><span>Mã sản phẩm: </span>Mã sản phẩm <?= get_field('code_product') ?></p>
                    <hr>
                    <table>
                        <tr>
                            <td class="sub-title"><?= $desc['title'] ?></td>
                            <td class="sub-desc" style="padding-bottom:50px">
                            <?= apply_filters( 'the_content', $desc['content']) ?>
                            </td>
                        </tr>
                        <tr>
                        <tr>
                            <td class="sub-title">Giá bán</td>
                            <td class="sub-desc" style="padding-bottom:50px">
                               <span><?= money_check(get_field('prices')) ?> VND</span>
                            </td>
                        </tr>
                    </table>
                    <div class="shopping">
                        <div class="quantity">
                            
                                    <button class="count_sp minus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                            fill="none">
                                            <path d="M12.6667 7.33337H3.33341C3.1566 7.33337 2.98703 7.40361 2.86201 7.52864C2.73699 7.65366 2.66675 7.82323 2.66675 8.00004C2.66675 8.17685 2.73699 8.34642 2.86201 8.47145C2.98703 8.59647 3.1566 8.66671 3.33341 8.66671H12.6667C12.8436 8.66671 13.0131 8.59647 13.1382 8.47145C13.2632 8.34642 13.3334 8.17685 13.3334 8.00004C13.3334 7.82323 13.2632 7.65366 13.1382 7.52864C13.0131 7.40361 12.8436 7.33337 12.6667 7.33337Z"
                                                fill="black"/>
                                        </svg>
                                    </button>
                                    <input class="count_number" type="number" value="1">
                                    <button class="count_sp plus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                            fill="none">
                                            <path d="M12.6672 7.33329H8.66723V3.33329C8.66723 3.15648 8.597 2.98691 8.47197 2.86189C8.34695 2.73686 8.17738 2.66663 8.00057 2.66663C7.82376 2.66663 7.65419 2.73686 7.52916 2.86189C7.40414 2.98691 7.3339 3.15648 7.3339 3.33329V7.33329H3.3339C3.15709 7.33329 2.98752 7.40353 2.8625 7.52855C2.73747 7.65358 2.66724 7.82315 2.66724 7.99996C2.66724 8.17677 2.73747 8.34634 2.8625 8.47136C2.98752 8.59639 3.15709 8.66662 3.3339 8.66662H7.3339V12.6666C7.3339 12.8434 7.40414 13.013 7.52916 13.138C7.65419 13.2631 7.82376 13.3333 8.00057 13.3333C8.17738 13.3333 8.34695 13.2631 8.47197 13.138C8.597 13.013 8.66723 12.8434 8.66723 12.6666V8.66662H12.6672C12.844 8.66662 13.0136 8.59639 13.1386 8.47136C13.2637 8.34634 13.3339 8.17677 13.3339 7.99996C13.3339 7.82315 13.2637 7.65358 13.1386 7.52855C13.0136 7.40353 12.844 7.33329 12.6672 7.33329Z"
                                                fill="black"/>
                                        </svg>
                                    </button>
                            
                        </div>
                
                            <a href="javascript:;" class="by-now disabled_cart" data-toggle="modal" data-target="#tuvan"  data-cover="<?= get_the_ID() ?>" data-id="<?= get_the_ID() ?>">Mua
                                ngay </a>
                    </div>
                    <div class="camket">
                        <ul>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Cam kết sản phẩm chính hãng</p>
                            </li>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Hoàn tiền 100% nếu phát hiện hàng giả</p>
                            </li>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Miễn phí vận chuyển trên toàn quốc</p>
                            </li>
                            <li>
                                 <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                               Kiểm tra và thanh toán khi nhận hàng</p>
                            </li>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Bộ phận kinh doanh và giao hàng làm việc từ 8h đến 21h30 các ngày trong tuần</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
    <section class="detail-sp-2">
        <section class="section-1" style="background-image:url('<?= get_template_directory_uri() ?>/dist/img/bg-2.png')">
            <div class="container">
                <h2>
               <?= $info['title'] ?>
                </h2>
                <div class="row">
                    <?php foreach($info['content'] as $value): ?>
                    <div class="col-6 d-flex content-st">
                        <figure>
                            <img src="<?= getimage($value['img']) ?>" alt="">
                        </figure>
                        <p><?= $value['content'] ?></p>    
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="section-2" style="background:url('<?= get_template_directory_uri() ?>/dist/img/Vector4.png')">
                <div class="container">
                    <h2>
                   <?= $thanh_phan['title'] ?>
                    </h2>
                    <div class="text-desc">
                        <?= apply_filters( 'the_content', $thanh_phan['content'] ) ?>
                    </div>
                    <div class="content">
                        <img src="<?= getimage($thanh_phan['img'],'full_size') ?>" alt="">
                    </div>
                </div>
            </section>
    </section>
    <section class="section-hdsd">
        <div class="before">
            <figure>
                <img src="<?= get_template_directory_uri() ?>/dist/img/image259.png" alt="">
            </figure>
        </div>
        <div class="container">
        <h2>
                   <?= $hdsd['title'] ?>
                    </h2>
                    <div class="text-content">
                        <?= apply_filters( 'the_content', $hdsd['content'] ) ?>
                    </div>
        </div>
        <div class="after">
            <figure>
                <img src="<?= get_template_directory_uri() ?>/dist/img/c1.png" alt="">
            </figure>
        </div>
    </section>
    <section class="section-more-item" style="background-image:url('<?= getimage($info_more['background'],'full_size') ?>');background-size:cover;background-repeat: no-repeat">
        <div class="container">
        <div class="wrapper row">
        <?php foreach ($info_more['content'] as $k => $item): ?>
                            <?php if ($k % 2 == 0): ?>
                                <div class="content row  ">
                                <div class="col-lg-6">
                                    <div class="image">
                                        <figure style="position: relative;">
                                            <?php if (!empty($item['video'])): ?>
                                                <?php
                                                $iframe = $item['video'];
                                                ?>
                                                <a href="<?php echo $iframe; ?>" data-fancybox="video">
                                                    <img src="<?= getimage($item['img']) ?>"/>
                                                    <img class="icon"
                                                         src="<?php echo get_template_directory_uri() ?>/dist/img/play.svg"/>

                                                </a>
                                            <?php else: ?>
                                                <img src="<?= getimage($item['img']) ?>">
                                            <?php endif; ?>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="text">
                                        <div class="decs">
                                            <?= apply_filters( 'the_content', $item['content'] )  ?>
                                        </div>

                                    </div>
                                </div>
                                </div>
                            <?php else: ?>
                                <div class="content row">
                                <div class="col-lg-8">
                                    <div class="text">
                                        <div class="decs">
                                        <?= apply_filters( 'the_content', $item['content'] )  ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="image">
                                        <figure style="position: relative;">
                                            <?php if (!empty($item['video'])): ?>
                                                <?php
                                                $iframe = $item['video'];
                                                ?>
                                                <a href="<?php echo $iframe; ?>" data-fancybox="video">
                                                    <img src="<?= getimage($item['img']) ?>"/>
                                                    <img class="icon"
                                                         src="<?php echo get_template_directory_uri() ?>/dist/img/play.svg"/>

                                                </a>
                                            <?php else: ?>
                                                <img src="<?= getimage($item['img']) ?>">
                                            <?php endif; ?>
                                        </figure>
                                    </div>
                                </div>
                                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
        </div>
    </section>
    <section class="video-section">
        <div class="container">
        <figure style="position: relative;">
                                            <?php if (!empty($video['video'])): ?>
                                                <?php
                                                $iframe = $video['video'];
                                                ?>
                                                <a href="<?php echo $iframe; ?>" data-fancybox="video">
                                                    <img src="<?= getimage($video['img']) ?>"/>
                                                    <img class="icon"
                                                         src="<?php echo get_template_directory_uri() ?>/dist/img/play.svg"/>
                                                </a>
                                            <?php else: ?>
                                                <img src="<?= getimage($video['img']) ?>">
                                            <?php endif; ?>
                                        </figure>
        </div>
    </section>
    <section class="customer">
        <div class="container">
        <div class="title">
        <h2><?= $customer['title'] ?></h2>
        </div>
        <div class="content">
                <div class="wwd-slie-6 swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($customer['customer'] as $value): ?>
                            <div class="item-slide swiper-slide">
                            <div class="avatar">
                                        <figure>
                                            <img src="<?= getimage($value['avatar']) ?>" alt="">
                                        </figure>
                                    </div>
                                <div class="icon">
                                    <figure>
                                        <img src="<?= get_template_directory_uri() ?>/dist/img/21.png" alt="">
                                    </figure>
                                </div>
                                <div class="desc swiper-no-swiping">
                                    <?= apply_filters('the_content', $value['content']) ?>
                                </div>
                            
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- <div class="swiper-button swiper-button-prev">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
<g opacity="0.5">
<path d="M21.8749 29.0492L12.3666 19.5409C11.2437 18.418 11.2437 16.5805 12.3666 15.4576L21.8749 5.94922" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</g>
</svg>

                </div>
		        <div class="swiper-button swiper-button-next">
                <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
<g opacity="0.5">
<path d="M13.1251 5.95078L22.6334 15.4591C23.7563 16.582 23.7563 18.4195 22.6334 19.5424L13.1251 29.0508" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</g>
</svg>

                </div> -->
            </div>
        </div>
    </section>
    <section class="khuyenmai" style="background-image: url(<?= get_template_directory_uri() ?>/dist/img/bg-2.png)">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-left">
                    <div class="image">
                    <figure>
                        <img src="<?= getimage($khuyenmai['img']) ?>" alt="">
                    </figure> 
                    </div>
                </div>
                <div class="col-xl-7 col-right">
                    <div class="desc">
                        <div class="title">
                        <?= apply_filters('the_content', $khuyenmai['content_title']) ?>
                        </div>
                        <div class="content">
                        <ul>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Cam kết sản phẩm chính hãng</p>
                            </li>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Hoàn tiền 100% nếu phát hiện hàng giả</p>
                            </li>
                            <li>
                                <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Miễn phí vận chuyển trên toàn quốc</p>
                            </li>
                            <li>
                                 <p><svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 14L6.5118 8.64899C7.16273 8.01705 7.16273 6.98295 6.5118 6.35101L1 1" stroke="#F89422" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                               Kiểm tra và thanh toán khi nhận hàng</p>
                            </li>
                            
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-container">
                <h2>ĐẶT HÀNG NGAY NHẬN NHIỀU ƯU ĐÃI</h2>
                <form action="" class="form-co">
                <input type="text" placeholder="Họ và tên">
                <input type="text" placeholder="Số điện thoại">
                <input type="text" placeholder="Địa chỉ">
                            <button>
                                <span>Đặt hàng</span>
                               
                            </button>
                </form>
            </div>
        </div>
    </section>
</main>
<div class="modal fade" id="tuvan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                            <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Đặt mua sản phẩm: <?= get_the_title() ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
        <form id="form_tuvan">
          <div class="mb-3">
          <label for="validationCustom01">Họ tên</label>
                                                            <input type="text" name="hoten_tuvan" id="hoten_tuvan" class="form-control"
                                           placeholder="Họ tên bạn">          
          </div>
          <div class="mb-3">
          <label for="validationCustom02">Số điện thoại</label>
                            
                            <input type="text" name="sdt_tuvan" id="sdt_tuvan" class="form-control"
                                   placeholder="Số điện thoại">
          </div>
          <div class="mb-3">
          <label for="validationCustom02">Email</label>
                             
                             <input type="email" name="email_tuvan" id="email_tuvan" class="form-control"
                                    placeholder="Email của bạn">
          </div>
          <div class="mb-3">
          <label for="validationCustom04">Địa chỉ</label>
                             
                             <input type="text" name="diachi_tuvan" id="diachi_tuvan" class="form-control"
                                    placeholder="Địa chỉ của bạn">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy đặt</button>
        <button type="button" class="btn btn-primary btn-datmua">Đặt mua</button>
      </div>
            </div>

        </div>
    </div>
</div>
<?php
get_footer();
?>
<script>
    var productSlider = new Swiper('.image-main', {
        spaceBetween: 0,
        centeredSlides: false,
        loop: true,
        direction: 'horizontal',
        loopedSlides: 4,
        resizeObserver: true,
    });
    var productThumbs = new Swiper('.orther-img', {
        spaceBetween: 4,
        centeredSlides: false,
        loop: true,
        slideToClickedSlide: true,
        direction: 'horizontal',
        slidesPerView: 4,
        loopedSlides: 4,
    });
    productSlider.controller.control = productThumbs;
    productThumbs.controller.control = productSlider;

    new Swiper(".wwd-slie-6", {
      loop: true,
      speed: 1500,
      
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      slidesPerView: 3,
      spaceBetween: 20,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
          spaceBetween: 0,
          // allowTouchMove: true,
        },
        1024: {
          // allowTouchMove: false,
          slidesPerView: 3,
          spaceBetween: 20,
        }
      }
    });
</script>
<script>
    $(document).ready(function(){
        var ajaxurl = "<?= admin_url('admin-ajax.php') ?>";
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
        $(".btn-datmua").click(function() {
        // Lấy giá trị từ các trường nhập liệu
        var hoten = $("#hoten_tuvan").val().trim();
        var sdt = $("#sdt_tuvan").val().trim();
        var email = $("#email_tuvan").val().trim();
        var diachi = $("#diachi_tuvan").val().trim();

        // Kiểm tra xem các trường có rỗng không
        if (hoten === "") {
            alert("Vui lòng nhập họ tên của bạn.");
            return;
        }

        if (sdt === "") {
            alert("Vui lòng nhập số điện thoại của bạn.");
            return;
        }

        if (email === "") {
            alert("Vui lòng nhập địa chỉ email của bạn.");
            return;
        }

        if (diachi === "") {
            alert("Vui lòng nhập địa chỉ của bạn.");
            return;
        }

        // Kiểm tra định dạng email
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Địa chỉ email không hợp lệ.");
            return;
        }

        var $data = {
            'id': '<?= get_the_ID() ?>',
            'count': $('.count_number').val(),
            'hoten': hoten,
            'sdt': sdt,
            'email': email,
            'diachi': diachi,
            'action': 'buynow'
        };
        var $param = {
            'type': 'POST',
            'url': ajaxurl,
            'data': $data,
            'beforeSend': function () {
                $("#loader").show();
            },
            'complete': function () {
                $("#loader").hide();

            },
            'callback': function (data) {
                var res = JSON.parse(data);
                if (res.status === 0) {
                    // window.location.href = res.url;
                    $("#tuvan").modal("hide");
                Swal.fire({
                icon: "success",
                title: "Bạn đã đặt hàng thành công!",
                text: "Chúng tôi sẽ sớm liên hệ với bạn",
                showConfirmButton: false,
                timer: 1500
                });
                }else{
                    $("#tuvan").modal("hide");
                    Swal.fire({
                icon: "warning",
                title: "Bạn đã đặt hàng không thành công!",
                text: "Vui lòng kiểm tra lại",
                showConfirmButton: false,
                timer: 1500
                });
                }
            }
        };
        cms_adapter_ajax($param);
        // Sau khi xử lý xong, bạn có thể đóng modal bằng cách sử dụng: $("#tuvan").modal("hide");
    });
        $(".by-now").click(function(){
            var target = $(this).data("target");
            $(target).modal("show");
        });
        $(".count_sp.minus").click(function () {
            // Lấy giá trị hiện tại của input
            var currentValue = parseInt($(".count_number").val());

            // Kiểm tra nếu giá trị hiện tại lớn hơn giá trị tối thiểu (min)
            if (currentValue > 1) {
                // Giảm giá trị đi 1
                $(".count_number").val(currentValue - 1);
            }
            console.log($(".count_number").val());
        });

        // Lắng nghe sự kiện click trên nút "plus"
        $(".count_sp.plus").click(function () {
            // Lấy giá trị hiện tại của input
            var currentValue = parseInt($(".count_number").val());
                $(".count_number").val(currentValue + 1);
            
        });
    });
</script>
