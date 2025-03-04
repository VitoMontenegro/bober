<?php	if($prods && count($prods)){
			$total = $total_old = 0;
		?>
		<link rel="stylesheet" id="dashicons-css" href="https://bober.services/wp-content/themes/bober/css/kp-pdf.css" type="text/css" media="all">
						
			<div class="pdf">
			
			<div class="phones_wrap">
				<div class="pdf_logo">
					<img src="https://bober.services/wp-content/themes/bober/images/header-logo.jpg">
				</div>
				<div class="phone1">
					<img class="phone1_img" src="https://bober.services/wp-content/themes/bober/images/phone.jpg">
					<p class="phone1_p"><b>8 800 250 52 70</b><br>
					Бесплатно по России</p>
				</div>

                <?php if($manager=get_field('kp_manager', $kp_id)){ ?>
                    <div class="phone2">
                        <img class="phone2_img" src="https://bober.services/wp-content/themes/bober/images/time.jpg">
                        <p class="phone2_p"><b><?=get_the_title($manager)?></b><br>
                            <b><?=get_field('manager_phone', $manager)?></b><br>
                            <?=get_field('manager_email', $manager)?></p>
                    </div>

                <?php } else { ?>

                    <div class="phone2">
                        <img class="phone2_img" src="https://bober.services/wp-content/themes/bober/images/time.jpg">
                        <p class="phone2_p"><b>+7 911 928 22 42</b><br>
                            Круглосуточно</p>
                    </div>
                <?php } ?>



			</div>
			<h1>Коммерческое предложение <span>от <?=$date?></span></h1>

				<?php foreach($prods as $item): ?>
					<?php
						$k = $item['product'];
						$count = $item['count'];
						$type = $item['type'];
						$sale = $item['sale'];
						$orig_price = $item['price'];
						
						$_product = wc_get_product($k);
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($k), 'thumbnail' );
						$price = $_product->get_price();
						if(isset($orig_price) && $orig_price)
							$price = $orig_price;
						if($sale)
							$sale_price = ($type=='percent')?round($price-$price*$sale/100):$price-$sale;
					?>
					<div class="prod__line">
						<div class="prod__img">
							<?php if(isset($image[0])): ?>
								<img src="<?=$image[0]?>">
							<?php else: ?>
								<img src="https://bober.services/wp-content/uploads/woocommerce-placeholder-300x300.png">
							<?php endif ?>
						</div>
						<div class="prod__name">
							<a href="<?=get_permalink($k)?>">
								<?=$_product->get_title()?>
							</a>
						</div>
						<div class="prod__price">
							<?php if($sale): ?>
								<?php 
									$total += $sale_price*$count; 
									$total_old += $price*$count;
								?>
								<div class="old_price"><?=number_format($price, 0, '.', ' ')?> ₽ x <?=$count?></div>
								<div class="prod__price_num">
									<?=number_format($sale_price, 0, '.', ' ')?> ₽ x <?=$count?>
								</div>
								<p class="total_price"><?=number_format(($sale_price*$count), 0, '.', ' ')?> ₽</p>
							<?php else: ?>
								<?php 
									$total += $price*$count; 
									$total_old += $price*$count;
								?>
								<div class="prod__price_num">
									<?=number_format($price, 0, '.', ' ')?> ₽ x <?=$count?>
								</div>
								<p class="total_price"><?=number_format(($price*$count), 0, '.', ' ')?> ₽</p>
							<?php endif ?>
						</div>
					</div>
				<?php endforeach ?>

                <div class="total">Итого:
                    <span class="total_num"><?=number_format($total, 0, '.', ' ')?> ₽</span>
                    <?php if($total_old && $total_old > $total): ?>
                        <span class="old_total"><?=number_format($total_old, 0, '.', ' ')?> ₽</span>
                    <?php endif ?>
                </div>

			<div class="link_kp">
				<a href="https://bober.services/kp/<?=$kp_id?>">Посмотреть КП на сайте</a>
			</div>
			
			<div class="kp_ach">
				<div class="kp_ach__item">
					<img src="/wp-content/themes/bober/ico/v1.svg">
					<span>Высокотехнологичный сервисный центр</span>
				</div>
				<div class="kp_ach__item">
					<img src="/wp-content/themes/bober/ico/v2.svg">
					<span>В течение 40 минут выезд по заявке</span>
				</div>
				<div class="kp_ach__item">
					<img src="/wp-content/themes/bober/ico/v3.svg">
					<span>Техническая поддержка 24 / 7</span>
				</div>
			</div>
			
			<?php if($manager=get_field('kp_manager', $kp_id)): ?>
				<div class="kp_manager">
					<div class="kp_manager__left">
						<div class="kp_manager_bold">Ваш менеджер</div>
						<div class="kp_manager_text"><?=get_the_title($manager)?></div>
					</div>
					<div class="kp_manager__right">
						<div class="kp_manager_text"><?=get_field('manager_phone', $manager)?></div>
						<div class="kp_manager_text"><?=get_field('manager_email', $manager)?></div>
					</div>
				</div>
			<?php endif ?>
			
			</div>
		<?php
		}
		?>
		
<script type="text/javascript" src="https://bober.services/wp-content/themes/bober/js/jquery.min.js" id="jquery-js"></script>
<script>
	$(document).ready(function(){
		var totalh = 0,
			page1 = $('<div class="page"></div>');
			pahge1_h = 0;
			pahge2_h = 0;
			pahge3_h = 0;
			page2 = $('<div class="page"></div>');
			page3 = $('<div class="page"></div>');
			page4 = $('<div class="page"></div>');
			page5 = $('<div class="page"></div>');
			page_h = 1320;
		$('.pdf>*').each(function(i){
			let h = $(this).outerHeight(true),
				next_h = $(this).next().outerHeight(true);
			
			totalh += h;
			
			console.log(totalh);
			if(totalh<=page_h){
				$(this).appendTo(page1);
				pahge1_h += h;
			} else if(totalh>page_h && totalh<=(page_h*2)){
				$(this).appendTo(page2);
				pahge1_h += h;
			} else {
				$(this).appendTo(page3);
			}
		});
		console.log('sd '+pahge1_h);
		console.log('sd2 '+pahge2_h);
		$('.pdf').append(page1);
		$('.pdf').append(page2);
		$('.pdf').append(page3);
		
		if(page3.find('*').length == 0){
			page3.remove();
			page2.css('marginBottom', 0);
		}
		if(page2.find('*').length == 0){
			page2.remove();
			page1.css('marginBottom', 0);
		}
	});
</script>
