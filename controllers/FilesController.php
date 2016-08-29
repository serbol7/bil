<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Files;
use yii\web\UploadedFile;


/**
 * Description of FileController
 *
 * @author 111
 */
class FilesController extends Controller 
{
    public function actionIndex()
    {
        $model = new Files();

        if (Yii::$app->request->isPost) {
            $model->xlsFiles = UploadedFile::getInstances($model, 'xlsFiles');
            if ($model->upload()) {
                null;
                // echo "Files loaded!";
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('index', ['model' => $model]);
    }

}