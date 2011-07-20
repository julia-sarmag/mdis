<?php

	$pdf = new MYFPDF('P','mm','A4');
	
	$borderActive  = false;
//	$pdf->borderActive = $borderActive;

	$fontSizeContent = 9 ;
	$fontSizeTitle = $fontSizeContent + 4 ;
	$fontSizeSubTitle = $fontSizeContent + 2 ;
	
	
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$filename = 'Faktur-Pajak'.'.pdf';
	
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(140,3,'',$borderActive,0,'C');
	$pdf->Cell(50,3,'Lampiran 1 A',$borderActive,2,'L');
	$pdf->Cell(50,3,'Keputusan Direktur Jenderal Pajak',$borderActive,2,'L');
	$pdf->Cell(50,3,'No. : [ PER-13/PJ/2010 ]',$borderActive,2,'L');
	$pdf->Cell(50,3,'Tanggal  : [24 Maret 2010]',$borderActive,2,'L');
	
	$pdf->Ln(4);
	$pdf->SetFont('Arial','B',$fontSizeTitle);
	$pdf->Cell(0,5,'FAKTUR PAJAK',$borderActive,0,'C');
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(0,2,'','LTR',1);
	$pdf->Cell(50,5,'Kode dan Nomor Seri Faktur Pajak ','L',0);
	$pdf->SetFont('Arial','B',$fontSizeSubTitle);
	$pdf->Cell(0,5,' : [ 073.000-10.00061275 ]','R',1);
	$pdf->Cell(0,2,'','LBR',1);
	
	$pdf->SetFont('Arial','B',$fontSizeContent);
	$pdf->Cell(0,5,'Pengusaha Kena Pajak',1,1);
	
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(30,7,'Nama','LT',0);
	$pdf->Cell(2,7,':','T',0);
	$pdf->SetFont('Arial','B',$fontSizeSubTitle);
	$pdf->MultiCell(0,7,'[ PT. DITAJAYA MITRA PERKASA ]','TR');
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(30,5,'Alamat','L',0);
	$pdf->Cell(2,5,':','',0);
	$pdf->MultiCell(0,5,'[ Perk. Kencana Niaga I Jl. Tmn. Aries Blok D.1 No.2-p, Meruya Utara, Kembangan - Jakarta Barat 11520 ]','R');
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(30,7,'NPWP','L',0);
	$pdf->Cell(2,7,':','',0);
	$pdf->Cell(0,7,'[ 01.084.43242.4324.000 ]','R',1);
	
	$pdf->SetFont('Arial','B',$fontSizeContent);
	$pdf->Cell(0,5,'Pembeli Barang Kena Pajak / Penerima Jasa Kena Pajak ',1,1);
	
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(30,7,'Nama','LT',0);
	$pdf->Cell(2,7,':','T',0);
	$pdf->SetFont('Arial','B',$fontSizeSubTitle);
	$pdf->MultiCell(0,7,'[ PT. DAELIM INDOENESIA ]','TR');
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(30,5,'Alamat','L',0);
	$pdf->Cell(2,5,':','',0);
	$pdf->MultiCell(0,5,'[ Kawasan Industri Cikarang Blok E No.6-7-8  Cikarang BEKASI 12700 ]','R');
	$pdf->SetFont('Arial','',$fontSizeContent);
	$pdf->Cell(30,7,'NPWP','L',0);
	$pdf->Cell(2,7,':','',0);
	$pdf->Cell(0,7,'[ 01.085.73824.4234.0004 ]','R',1);
	
	$thead  = array( '  No.   ','                Nama Barang Kena Pajak / Jasa Kena Pajak                                    ','                                    Harga Jual / Pengganti /  Uang Muka / Termin ( Rp. )  ');
	  
	
	$n = 0;
	foreach ( $thead as $val ):
		$w[] = strlen($thead[$n]);
		$pdf->Cell($w[$n],5,trim ( $thead[$n] ),1,0,'C');
		$n++;
	endforeach;
	
	$dataExample = array();
	
	$dataExample = array(
						array( 
								'namaBarang' 		=> 'Oil Filter 204324 ( EQ 6.1 324 )',
								'hrg' 	 			=> 4320000,
								),
						array( 
								'namaBarang' 		=> 'Cool Fan AO 849 ( EQ 6.1 324 )',
								'hrg' 	 			=> 439200,
								),
						);	
						
	$dataExample  =  array_merge($dataExample,$dataExample);
	$dataExample  =  array_merge($dataExample,$dataExample);
	$dataExample  =  array_merge($dataExample,$dataExample);
	
	$dataExample = array();

	$count = count($dataExample);
	$heightspace =   ( 113   ) - ( $count * 5  ) ; 
	$heightspace =  $heightspace <= 0 ? 5 : $heightspace ;
						
	$pdf->Ln(); 
	$pdf->SetFont('Arial', '', 12);
	$urut = 1;
	$columns = array();  
	$hargaTotal = 0;
	if ( $dataExample ) foreach( $dataExample as $res ):
	$col = array();
	$n = 0;
	
	$linearea = $urut <= 1 ? 'LTR' : 'LR' ;
	
	$col[] = array('text' => $urut++ . '.', 'width' => $w[$n++], 'align' => 'C','linewidth'=>0.2,'linearea'=>$linearea,'font_size'=>$fontSizeContent);
	$col[] = array('text' =>  $res['namaBarang'] , 'width' => $w[$n++], 'align' => 'L');
	$col[] = array('text' => number_format( $res['hrg']  ) , 'width' => $w[$n++], 'align' => 'R');
	
	$columns[] = $col;
	
	endforeach;
	
	$col = array();
	$n = 0;
	$col[] = array('text' => '', 'width' => $w[$n++],'height'=> $heightspace, 'align' => 'C','linewidth'=>0.2);
	$col[] = array('text' => '' , 'width' => $w[$n++], 'align' => 'L');
	$col[] = array('text' => '', 'width' => $w[$n++], 'align' => 'R'); 
	$columns[] = $col;
	
	$pdf->WriteTable($columns);
	
	$pdf->Cell($w[0] + $w[1] , 5,'Harga Jual / Penggantian / Uang Muka / Termin',1,0);
	$pdf->Cell($w[2] , 5,'[ '.number_format( 3210000 ) . ' ]',1,1,'R');
	
	$pdf->Cell($w[0] + $w[1] , 5,'Dikurangi Potongan Harga ',1,0);
	$pdf->Cell($w[2] , 5,'[ '.number_format( 3210000 ) . ' ]',1,1,'R');
	
	$pdf->Cell($w[0] + $w[1] , 5,'Dikurangi Uang Muka Yang Telah Diterima',1,0);
	$pdf->Cell($w[2] , 5,'[ '.number_format( 3210000 ) . ' ]',1,1,'R');
	
	$pdf->Cell($w[0] + $w[1] , 5,'Dasar Pengenaan Pajak',1,0);
	$pdf->Cell($w[2] , 5,'[ '.number_format( 3210000 ) . ' ]',1,1,'R');
	
	$pdf->Cell($w[0] + $w[1] , 5,'PPN = 10 % x Dasar Pengenaan Pajak ',1,0);
	$pdf->Cell($w[2] , 5,'[ '.number_format( 3210000 ) . ' ]',1,1,'R');
	
	$pdf->Cell(0,5,'','LRT',1);
	$pdf->Cell(0,5,'     Pajak Penjualan Atas Barang Mewah ','LR',1);
	
	$thead  = array( '  Tarif   ','                                     DPP         ','                                     PPn BM  ');
	  
	
	$n = 0;
	foreach ( $thead as $val ):
		$z[] = strlen($thead[$n]);
		$pdf->Cell($z[$n],5,trim ( $thead[$n] ),1,0,'C');
		$n++;
	endforeach;
	
	$pdf->Cell(30);
	$pdf->Cell(0,5,'[ Jakarta, Tanggal 18 Juni 2010 ]','R',1,'C');
	
	$dataExample2 = array(
						array( 
								'tarif' 		=> 20,
								'dpp' 	 			=> 4320000,
								'ppnBm' 	 			=> 4320000,
								),
						array( 
								'tarif' 		=> 10,
								'dpp' 	 			=> 4320000,
								'ppnBm' 	 			=> 4320000,
								),
						);	
						
	
	$columns = array();  
	$hargaTotal = 0;
	if ( $dataExample2 ) foreach( $dataExample2 as $res ):
	$col = array();
	$n = 0;
	
	$col[] = array('text' => $res['tarif'], 'width' => $z[$n++],'height'=>5, 'align' => 'C','linewidth'=>0.2,'linearea'=>'LTBR');
	$col[] = array('text' =>  number_format( $res['dpp'] ), 'width' => $z[$n++], 'align' => 'L');
	$col[] = array('text' => number_format( $res['ppnBm']  ) , 'width' => $z[$n++], 'align' => 'R');
	$col[] = array('text' => '', 'width' => 86, 'align' => 'R','linearea'=>'LR');
	
	$columns[] = $col;
	endforeach;
	$pdf->WriteTable($columns);
	
	$pdf->Cell($z[0] + $z[1] , 5,'Jumlah',1,0);
	$pdf->Cell($z[2] , 5,'[ Rp. '.number_format( 3210000 ) . ' ]',1,0,'R');
	$pdf->Cell(30);
	$pdf->Cell(0,5,'[ Nama      Netrodam Kaban ]','R',1,'C');
	
	$pdf->SetFont('Arial', '', $fontSizeContent - 2);
	$hargaTotal = 0;
	$pdf->Cell(0,5,'','LR',1);
	$pdf->Cell(0,5,'*) Coret yang tidak perlu','LBR',1);
	
	/*
	 * save in local and give file to user 
	 */
//	$pdfpath	= MEDIA_PATH . DS . 'private' . DS . 'pdf' . DS . 'purchasing'. DS . getUserId() . DS . date('Y/m/d') . DS .time() . '-' . $filename  ;
//	@mkdir( dirname( $pdfpath ),0755,true );
//	$pdf->Output($pdfpath, 'F');
//	
//	$files =  file_properties( array( 'file' => $pdfpath , 'application' => 'application/pdf', 'userId' => getUserId() ) );
//	file_download($files);
	
	$pdf->Output( $filename ,'I');