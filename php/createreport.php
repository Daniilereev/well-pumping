<?php
ob_start();
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{Font, Border, Alignment};
$letters = ['A','B','C','D','E','F','G','H'];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet ->getActiveSheet();
$sheet->setCellValue('E1', '№ скв.');
$sheet->setCellValue('F1', 'Q, м3/сут');
$sheet->setCellValue('G1', 'R, м');
$sheet->setCellValue('H1', 'Sвл, м');
$num = 0;
for ($k=0; $k<17; $k++) {
  for ($l=1; $l<8; $l++){
    $sheet->getStyle($letters[$l].$k+1)->applyFromArray([
      'alignment' => [
          'horizontal' => Alignment::HORIZONTAL_CENTER,
          'vertical' => Alignment::VERTICAL_CENTER,
          'wrapText' => true,
      ]
  ]);
  }
}
//Задаем гг параметры
$t =  (float) str_replace(',', '.', $_POST['trans']);
$a =  (float) str_replace(',', '.', $_POST['pezo']);
$q =  (float) str_replace(',', '.', $_POST['debit']);
$r =  (float) str_replace(',', '.', $_POST['radius']);
$time =  (float) str_replace(',', '.', $_POST['time']);
$forlabel = [$t,$a,$q,$r,$time,'','','','',''];
//Если параметры введены верно
if (is_numeric($t) && is_numeric($q) && is_numeric($a) && is_numeric($r) && is_numeric($time) && $t>0 && $q!=0 && $a>0 && $r>0 && $time>0) {
  //Делаем панель с параметрами
  $label = ['T, м2/сут','a, м2/сут','Q, м3/сут','r, м','t, сут',' ',' ','Sскв','Sвл сум','Sсум'];
  for ($c=0; $c<count($label); $c++) {
    $sheet->setCellValue('A'.$c+1, $label[$c]);
    $sheet->setCellValue('B'.$c+1, $forlabel[$c]);
  }
  //считаем понижения от соседних
  $par = $_POST['datasamewell'];
  $ssum = 0;
  $well = ($q / 4 / 3.14 / $t * log(2.25 * $a * $time /$r / $r));
  $sheet->setCellValue('B8', $well);
  for ($num=0; $num < $_POST['numberwell']; $num++) {
    $letters = ['E','F','G','H'];
    $sheet->setCellValue('E'.($num+2), ($num+1));
    $i=$num*2;
    $qq=(float) str_replace(',', '.', $par[$i]);
    $rr=(float) str_replace(',', '.', $par[$i+1]);
    if (is_numeric($qq) && is_numeric($rr) && $rr>0) {
        $swell = ($qq / 4 / 3.14 / $t * log(2.25 * $a * $time / $rr / $rr));
        if ($swell < 0) {$swell = 0;};
        $sheet->setCellValue('F'.$num+2, $qq);
        $sheet->setCellValue('G'.$num+2, $rr);
        $sheet->setCellValue('H'.$num+2, $swell);
        $ssum = $ssum + $swell;
        $sheet->setCellValue('B9', $ssum);
        $sheet->setCellValue('B10', $well+$ssum);
      } else if (empty($qq) && empty($rr)) {
        continue;
      }
        else if (!empty($qq) || !empty($rr) || !is_numeric($qq) || !is_numeric($rr)) {
        $sheet->removeRow(1, $sheet->getHighestRow());
        $sheet->setCellValue('C1', 'Введены некорректные данные');
        break;
      }
    }
} else {
  if (!is_numeric($t) || !is_numeric($q) || !is_numeric($a) || !is_numeric($r) || !is_numeric($time) || !empty($t) || !empty($q) || !empty($a) || !empty($r) || !empty($time)) {
    $sheet->removeRow(1, $sheet->getHighestRow());
    $sheet->setCellValue('C1', 'Введены некорректные данные');
  }
}
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="hello'.$num.'.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('../reports/hello'.$num.'.xlsx');
ob_end_clean();
readfile('../reports/hello'.$num.'.xlsx');
unlink('../reports/hello'.$num.'.xlsx');

?>
