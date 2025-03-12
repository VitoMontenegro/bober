<?php
global $wpdb;
$pdf_dir = get_home_path().'/wp-content/kp_pdf';
require(__DIR__.'/../vendor/tfpdf/tfpdf.php');
require(__DIR__.'/../vendor/autoload.php');

$hash = 'c83359f5d1c162e42a68476035181b54';
$results = $wpdb->get_results( "SELECT * FROM kp WHERE hash = '".$hash."'", OBJECT );

if($results || count($results)){

	$mpdf = new \Mpdf\Mpdf([
		'mode' => 'utf-8', // кодировка (по умолчанию UTF-8)
		'format' => 'A4', // - формат документа
		'tempDir' => get_temp_dir()
		//'orientation' => 'L' // - альбомная ориентация
	]);
	$mpdf->SetTitle('КП bober.services');
	$mpdf->SetAuthor('bober.services');

	$stylesheet = '
			*{
                font-family: sans-serif;
            }
            .page1-div {
                padding: 0;
                margin: 0;
                font-family: sans-serif;
                /*background-image:url($img);*/
                background-image:url($img);
                background-position:0 0;
                background-size:cover;
                height:297mm;
                width:100%;
                padding: 0 5mm 0 7.5mm;
            }
			.logo{
				text-align: center;
			}
			.logo_img{
				width: 40mm;
			}
			.phone1,
			.phone2{
				width:50%;
				float: left;
				box-sizing: border-box;
			}
			.phones_wrap{
				margin-top: 5mm;
			}
			.phone1_img, .phone1_p{
				float: left;
			}
			.phone1_img{
				margin-right: 3mm;
				position: absolute;
				top: 3mm;
			}
			.phone1_p{
				position:relative;
				top: -2mm;
			}
	';
	$html = '
		<div class="logo">
			<a target="_blank" href="' . get_site_url() . '">
				<img class="logo_img" src="'.get_site_url().'/wp-content/themes/bober/images/header-logo.jpg">
			</a>
		</div>
		<div class="phones_wrap">
			<div class="phone1">
				<img class="phone1_img" src="' . get_site_url() . '/wp-content/themes/bober/images/phone.jpg">
				<p class="phone1_p">8 800 250 52 70<br>
				Бесплатно по России</p>
			</div>
			<div class="phone2">
				+7 911 928 22 42<br>
				Круглосуточно
			</div>
		</div>
	';

	$mpdf->WriteHTML($stylesheet, 1);
	$mpdf->WriteHTML($html, 2);
	$attachment = $pdf_dir.'/2.pdf';
	$mpdf->Output($attachment, \Mpdf\Output\Destination::FILE);

	//var_dump($results[0]->created);

	$pdf = new tFPDF('P', 'pt', 'A4', true, 'utf-8');
	$pdf->AddPage();
	$pdf->addFont('DejaVu','','DejaVuSansCondensed.ttf',true);
	$pdf->addFont('dejavusansB','','DejaVuSansCondensed-Bold.ttf',true);
	$pdf->Image(get_home_path().'/wp-content/themes/bober/images/header-logo.jpg', 250,30,100);

	$pdf->SetFont('Arial', '', 16);
	$pdf->Image(get_home_path().'/wp-content/themes/bober/images/phone.jpg', 25,90,30);
	$pdf->SetFont('dejavusansB', '', 10);
	$pdf->SetTextColor(102, 77, 71);
	$pdf->SetY(95);
	$pdf->SetX(53);
	$pdf->Cell(100, 10, '8 800 250 52 70');
	$pdf->SetY(105);
	$pdf->SetX(53);
	$pdf->Cell(100, 10, 'Бесплатно по России');

	$full_w = 535;

	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Image(get_home_path().'/wp-content/themes/bober/images/time.jpg', 200,90,30);
	$pdf->SetFont('dejavusansB', '', 10);
	$pdf->SetY(95);
	$pdf->SetX(235);
	$pdf->Cell(100, 10, '+7 911 928 22 42');
	$pdf->SetY(105);
	$pdf->SetX(235);
	$pdf->Cell(100, 10, 'Круглосуточно');
	$pdf->Ln(40);

	$pdf->SetTextColor(0);
	$pdf->SetFont('dejavusansB', '', 16);
	$pdf->Cell($full_w, 0, 'Коммерческое предложение от '.date('d.m.y', $results[0]->created), 0, 0, 'C');

	$pdf->Ln(40);
	$pdf->SetFont('dejavusansB', '', 10);
	$pdf->Cell($full_w*0.5, 0, 'Товар', 0, 0, 'L');
	$pdf->Cell($full_w*0.25, 0, '', 0, 0, 'L');
	$pdf->Cell($full_w*0.25, 0, 'Итого', 0, 0, 'L');

	$pdf->SetFont('DejaVu', '', 10);
	$arr = json_decode($results[0]->json,true);
	$start_image_h = 200;
	$left_start_cell = 0;
	foreach($arr as $item){
		foreach($item as $k=>$item2){
			$_product = wc_get_product($k);
			$image = wp_get_attachment_image_src( get_post_thumbnail_id($k), 'thumbnail' );
			$pdf->Ln(20);
			//$pdf->SetFont('Arial', 'B', 14);
			if($image[0]){
				$pdf->Image($image[0], 25, $pdf->GetY(), 90);
			} else {
				$pdf->Image( get_site_url() . '/wp-content/uploads/woocommerce-placeholder-300x300.png', 25, $pdf->GetY(), 90);
			}

			$current_y = $pdf->GetY();
			$current_x = $pdf->GetX();
			$pdf->SetXY($current_x + 100, $current_y);

			$pdf->MultiCell($full_w*0.5, 30, $_product->get_title(), 1, 'L');
			$pdf->Ln();

			$start_image_h += 100;
		}
	}


	$pdf->Output('F', $pdf_dir.'/1.pdf');
}
