<?php

namespace App;


class Common
{


	public static function csv_download($data, $file_name='page-data-export', $first_row=true, $save_file=false)
	{
		if(!$data) return;

		if($save_file){
			$fp = fopen(storage_path("exports/{$file_name}.csv"), 'w');
		}else{
			header('Content-Description: File Transfer');
			header('Content-Type: application/csv');
			header("Content-Disposition: attachment; filename={$file_name}.csv");
			// header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			
			$fp = fopen('php://output', 'w');			
		}
		// ob_clean();

		if($first_row){

			$first = [];

			foreach ($data[0] as $key => $value) {
				$first[] = $key;
			}
			fputcsv($fp, $first);

		}

		foreach ($data as $key => $value) {
			fputcsv($fp, $value);
		}
		// ob_flush();
		fclose($fp);
	}
}
