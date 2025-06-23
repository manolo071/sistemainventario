<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Artisan;
use File;


class CronController extends Controller
{
    public function index()
    { 
      Artisan::call('db:seed');
      $this->copyImageBackupFiles();
    }

    public function copyImageBackupFiles(){
      if (File::isWritable(public_path('uploads/itemPic')) && File::isWritable(public_path('uploads/logo')) ){
         
         File::cleanDirectory(public_path('uploads/itemPic'));
         File::cleanDirectory(public_path('uploads/logo'));



       /* itemPic copy start */
          $files_item         = scandir(public_path('uploads/back_up/itemPic'));
          $source_images      = public_path('uploads/back_up/itemPic/');
          $destination_images = public_path('uploads/itemPic/');

          foreach ($files_item as $file) {
            if (in_array($file, array(".",".."))) continue;
            copy($source_images.$file, $destination_images.$file);
          }
      /* itemPic copy end */

      /* logos copy start */
            $files_logos       = scandir(public_path('uploads/back_up/logo'));
            $source_logos      = public_path('uploads/back_up/logo/');
            $destination_logos = public_path('uploads/logo/');

            foreach ($files_logos as $file) {
              if (in_array($file, array(".",".."))) continue;
              copy($source_logos.$file, $destination_logos.$file);
            }
      /* logos copy end */
      
      }


    }


}
