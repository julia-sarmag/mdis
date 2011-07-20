<?php
$this->load->helper('date');
	$pdf = new templateV( 'P' , 'mm' , 'A4' );
	$datestring = " %Y  %m  %d - %h:%i %a";
	$time = time();

    $array = $this->uri->uri_to_assoc (3, array ('tglAwal', 'tglAkhir'));
	
	//echo mdate($datestring, $time);
	$borderActive  = false;
	$pdf->borderActive = $borderActive;
	$pdf->lnHeader = 2;
	
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$columns = array();
	$filename = 'Daftar Persediaan Barang'.'.pdf';
	
	$pdf->SetFont('Arial','UB',12);
	$pdf->Cell(0,5,'Laporan Stock Barang :  ',$borderActive,1,'C');
	$pdf->Ln(4);
	
	$periode = ina_date($array['tglAwal']) .' - '. ina_date($array['tglAkhir']);
	$pdf->SetFont('Arial','UB',8);
	$pdf->Cell(0,5,'Periode Laporan :  '.$periode,$borderActive,1,'L');
	$pdf->Ln(4);
	
	$pdf->SetFont('Arial','',10);
	$thead  = array( '  No.   ','      Gudang               ','                       Kode Barang','                                      Barang  ','                    Satuan     ','               Jumlah Barang   ');
	
	$n = 0;
	
	foreach ( $thead as $val ):
		$w[] = strlen($thead[$n]);
		$pdf->Cell($w[$n],5,trim ( $thead[$n] ),'LTR',0,'C');
		$n++;
	endforeach;
	
	/*
	$arrayExample = array(
							array(
								'number'	=> '1-000',
								'name'		=> 'Asset',
								'type'		=> 'Cash/Bank',
								'parent'	=> '1-0000',
								'kode'		=> 'D',
							),
							array(
								'number'	=> '1-001',
								'name'		=> 'Asset',
								'type'		=> 'Cash/Bank',
								'parent'	=> '1-0000',
								'kode'		=> 'D',
							),
							array(
								'number'	=> '1-002',
								'name'		=> 'Asset',
								'type'		=> 'Cash/Bank',
								'parent'	=> '1-0000',
								'kode'		=> 'D',
							),
							
					);
	
	$listTable = $listTable ? $listTable : $arrayExample; 
	
	$listTable = array_merge( $listTable , $listTable );
	$listTable = array_merge( $listTable , $listTable );
	$listTable = array_merge( $listTable , $listTable );
	$listTable = array_merge( $listTable , $listTable );
	*/
	
	$pdf->Ln(); 
	$pdf->SetFont('Arial', '', 12);
	$urut = 1;
	$columns = array();  
	$hargaTotal = 0;
	if ( $dataView ) foreach( $dataView as $res ):
	//$res['currentSaldoJumlah'] = number_format($res['currentSaldoJumlah'], -2, ',', '.');
	$gudang = '[ '.$res['gudangKode'].' ] '.$res['gudangNama'];
	//$barang = '[ '.$res['barangKode'].' ] '.$res['barangNama'];
	$col = array();
	$n = 0;
	$col[] = array('text' => $urut++ . '.' ,'font_style' => '','font_size'=>'8','height'=>5, 'width' => $w[$n++], 'align' => 'C','linewidth'=>0.2, 'linearea'=>'LBRT');
	$col[] = array('text' =>  $gudang , 'width' => $w[$n++], 'align' => 'L');
	$col[] = array('text' => $res['barangKode'] , 'width' => $w[$n++], 'align' => 'L');
	$col[] = array('text' =>  $res['barangNama']  , 'width' => $w[$n++], 'align' => 'L');
	$col[] = array('text' => $res['satuanNama']  , 'width' => $w[$n++], 'align' => 'L');
	$col[] = array('text' => $res['persediaanBarangTotal']  , 'width' => $w[$n++], 'align' => 'R');
	
	$columns[] = $col;
	endforeach;
	
	$pdf->WriteTable($columns);
	
	$pdf->Output($filename , 'I' );