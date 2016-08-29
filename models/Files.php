<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Description of UploadFiles
 *
 * @author 111
 */

class Files extends Model 
{
    public $xlsFiles;

    public function rules()
    {
        return [
            [['xlsFiles'], 
                'file', 
                'skipOnEmpty' => false, 
                'extensions' => 'xls, xlsx, XLS, XLSX', 
                'checkExtensionByMimeType'=>false,
                'maxFiles' => 100,
                'maxSize' => 1024 * 1024 * 10],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->xlsFiles as $file) {
                $file_name = '../uploads/' . md5(basename($file->baseName).time()) . '.' . $file->extension;
                $file->saveAs($file_name);
                $this->imp($file_name);
                unlink($file_name);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * Yii2 phpexcel import
     */
    public function imp ($fileName) {
        $data = \moonland\phpexcel\Excel::import($fileName);
        foreach ($data as $sheet) {
            foreach ($sheet as $row) {
                $post = new Post();
                foreach ($row as $key => $value) {
                    switch ($key) {
                        case 'title':
                            $post->title = $value;
                            break;
                        case 'excerpt':
                            $post->excerpt = $value;
                            break;
                        case 'text':
                            $post->text = $value;
                            break;
                        case 'keywords':
                            $post->keywords = $value;
                            break;
                        case 'description':
                            $post->description = $value;
                            break;
                        default:
                            null;
                            break;
                    }
                }
                $post->save();
            }
        }
        unset($data);
        unset($sheet);
        unset($row);
    }
    
}