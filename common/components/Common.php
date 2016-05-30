<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 05.05.2016
 * Time: 19:34
 */

namespace common\components;

use app\models\Categories;
use app\models\Products;
use app\modules\admin\models\Roles;
use Yii;

class Common
{
    const PRODUCT_PHOTO_URL = 'uploads/products/';
    const PRODUCT_PHOTO_THUMB_URL = self::PRODUCT_PHOTO_URL . 'thumbs/';
    const URL = '/url/default';

    public static function getCategoryDropdown($parent_selectable = true)
    {
        $options = [];

        $parents = Categories::find()->where("parent_category_id is null ")->all();
        foreach ($parents as $id => $parent) {
            $children = Categories::find()->where("parent_category_id=:parent_category_id",
                [":parent_category_id" => $parent->category_id])->all();
            if ($parent_selectable) {
                $options[$parent->category_id] = $parent->category_name;

                foreach ($children as $child) {
                    $options[$child->category_id] = "---" . $child->category_name;
                }
            } else {
                $child_options = [];
                foreach ($children as $child) {
                    $child_options[$child->category_id] = $child->category_name;
                }
                $options[$parent->category_name] = $child_options;
            }

        }
        return $options;
    }

    public static function getCategoryDropdownParents()
    {
        $options = [0 => ""];
        $parents = Categories::find()->where("parent_category_id is null ")->all();
        foreach ($parents as $id => $parent) {
            $options[$parent->category_id] = $parent->category_name;
        }
        return $options;
    }

    public static function getRolesDropdown()
    {
        $options = [];
        $parents = Roles::find()->all();
        foreach ($parents as $id => $parent) {
            $options[$parent->role_id] = $parent->name;
        }
        return $options;
    }

    /* public static function getControllersDropdown()
     {
         $controllerlist = [];
         if ($handle = opendir('../controllers')) {
             while (false !== ($file = readdir($handle))) {
                 if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                     $controllerlist[] = $file;
                 }
             }
             closedir($handle);
         }
         asort($controllerlist);

         $options = [];
         $parents = Roles::find()->all();
         foreach ($parents as $id => $parent) {
             $options[$parent->role_id] = $parent->name;
         }
         return $options;
     }*/
    public static function getControllersDropdown()
    {
        $controllerlist = [];
        $dir = Yii::$app->basePath . '/modules/admin/controllers/';
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                    $controllerlist[substr($file, 0, -4)] = substr($file, 0, -4);
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        return $controllerlist;
    }

    public static function getControllersActionsDropdown()
    {
        $controllerlist = [];
        $dir = Yii::$app->basePath . '/modules/admin/controllers/';
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && substr($file, strrpos($file, '.') - 10) == 'Controller.php') {
                    $controllerlist[] = $file;
                }
            }
            closedir($handle);
        }
        asort($controllerlist);
        $fulllist = [];
        foreach ($controllerlist as $controller):
            $handle = fopen($dir . $controller, "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    if (preg_match('/public function action(.*?)\(/', $line, $display)):
                        if (strlen($display[1]) > 2):
                            $fulllist[substr($controller, 0, -4)][$display[1]] = strtolower($display[1]);
                        endif;
                    endif;
                }
            }
            fclose($handle);
        endforeach;
        return $fulllist;
    }

    public static function getMainProducts()
    {
        return Products::find()->all();
        //return Products::find()->where('price>21')->limit(60);
    }

    public static function aliExpress($cmodel)
    {
        $mainpage = self::getContent($cmodel->url);
//        file_put_contents('page.html', $mainpage);
//        $mainpage = file_get_contents('page.html');
        preg_match_all("/class=\"picCore( pic-Core-v|)\" (image-|)src=\"(.*)_220x220.jpg\"/i", $mainpage, $_images);
        $images = $_images[3];

        preg_match_all("/_220x220.jpg\"  alt=\"(.*)\"/i", $mainpage, $_titles);
        $titles = $_titles[1];
        preg_match_all("/itemprop=\"price\"\>(.*)\<\/span\>/i", $mainpage, $_prices);
        $prices = $_prices[1];

        for ($it = 0; $it < count($titles); $it++) {
            $model = new Products();
            $model->product_category_id = $cmodel->category_id;
            $model->product_name = $titles[$it];
            $model->product_price = str_replace('US $', '', $prices[$it]);
            //$model->product_created_date = new \DateTime();
            $model->save();
            $product_id = $model->product_id;
        }
    }

    public static function getContent($url)
    {
        $uagent = "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, __DIR__ . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, __DIR__ . "/cookie.txt");

        $content = curl_exec($ch);
        $error = curl_error($ch);
        if ($error != '') return $error;
        curl_close($ch);
        return $content;
    }

    public static function imgThumb($photo)
    {
        return '/' . self::PRODUCT_PHOTO_THUMB_URL . $photo;
    }
    public static function imgUrl($photo)
    {
        return '/' . self::PRODUCT_PHOTO_URL . $photo;
    }
}