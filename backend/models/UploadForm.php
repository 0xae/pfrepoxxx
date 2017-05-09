<?php
namespace backend\models;

use Yii;

/**
 * Login form
 */
class UploadForm {
    public static function upload($file, $subdir) {
        $uploads = Yii::getAlias("@webroot");
        $n1 = "{$uploads}/../passafree_uploads/{$subdir}";
        $ext = end((explode(".", $file)));
        $randomName = Yii::$app->security->generateRandomString().".{$ext}";
        $filename = $n1.'/'.$randomName;
        $file->saveAs($filename, false);

        return "{$subdir}/{$randomName}";
    }
}

