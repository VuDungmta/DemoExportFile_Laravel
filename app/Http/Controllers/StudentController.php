<?php

namespace App\Http\Controllers;
use App\student;
use DB;
use PDF;
use Excel;
use input;
use App\Http\Requests;
//use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function downloadFile($type)
    {
     $path1='./TemplateFileReport/InfoStudents.xlsx'; 
      
    return  Excel::load($path1, function($reader) {
    
      $sheet = $reader->setActiveSheetIndex(0);
      
     
    
    $i1=8;
  $datadl=student::get();
  foreach($datadl as $value)
  {
  if($i1<=19)
  {
 $sheet->setCellValue('F'.$i1, (string)$value->id);
  $sheet->setCellValue('H'.$i1, (string)$value->name);
  $sheet->setCellValue('J'.$i1, (string)$value->address);
  $sheet->setCellValue('L'.$i1, (string)$value->email);
  
  
  $i1++;
  }
  
  }
			})->download($type); 
    return back;
    }
    public function exportPDF()
	{
	   $data = student::get()->toArray();
	   return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
		$excel->sheet('mySheet', function($sheet) use ($data)
	    {
			$sheet->fromArray($data);
	    });
	   })->export('pdf');
       return back;
	}
}
