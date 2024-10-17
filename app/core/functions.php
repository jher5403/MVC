<?php
defined('ROOTPATH') OR exit('Error: Access denied');
check_extensions();

/**
 * Checks if PHP server has all required extensions.
 */
function check_extensions()
{
    $required_extensions = [
        'mysqli',
        'curl',
        'fileinfo',
        'gettext',
        'exif',
        'pdo_mysql',
        'pdo_sqlite',

    ];

    $not_loaded = [];

    foreach ($required_extensions as $ext) {
        if(!extension_loaded($ext))
        {
            $not_loaded[] = $ext;
        }
    }

    if (!empty($not_loaded))
    {
        show("Please load the following extensions into php.ini: <br>".implode("<br>", $not_loaded));
        die;
    }
}

/**
 * Prints parameter.
 */
function show($stuff) 
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

/**
 * Exits page? Is here to prevent code injection.
 */
function esc($str) 
{
    return htmlspecialchars($str);
}

/**
 * Redirects page to path parameter.
 */
function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
}

/**
 * Gets image. If image doesn't exist, displays placeholder image instead.
 */
function get_image(mixed $file = '', string|null $type = 'post'):string 
{
    $file = $file ?? '';
    if(file_exists($file))
    {
        return ROOT . "/" . $file;
    }

    if($type == 'user') {
        return ROOT . "/assets/images/placeholder_user.jpg";
    } else {
        return ROOT . "/assets/images/placeholder.png";
    }
}

/**
 * Returns pagination links. (IE: probably for pages of table elements)
 */
function get_pagination_vars():array
{
    $vars = [];
    $vars['page']       = $_GET['page'] ?? 1;
    $vars["page"]       = (int)$vars['page'];
    $vars['prev_page']  = $vars['page'] <= 1 ? 1 : $vars['page'] - 1;
    $vars['next_page']  = $vars['page'] + 1;

    return $vars;
}

/**
 * Saves or displays a message to the user.
 */
function message(string $msg = null, bool $clear = false)
{
    $ses = new Core\Session();

    if(!empty($msg)) {
        $ses->set('message', $msg);
    } else {
        if(!empty($ses->get('message'))) {
            $msg = $ses->get('message');
        }
        if($clear) {
            $ses->pop('message');
        }
        return $msg;
    }
    return false;
}

function URL($key):mixed
{
    switch ($key) {
        case 'page':
        case 0:
            return APP('URL')[0] ?? null;
            break;
        case 'section':
        case 'slug':
        case 1:
            return APP('URL')[1] ?? null;
            break;
        case 'action':
        case 2:
            return APP('URL')[2] ?? null;
            break;
        case 'id':
            return APP('URL')[3] ?? null;
            break;
        default:
            return null;
            break;
    }
}

/**
 * Retains checkbox input after page refresh or error.
 */
function old_checked(string $key, string $value, mixed $default = ""):string 
{
    if (isset($_POST[$key]))
    {
        if($_POST[$key] == $value) {
            return ' checked ';
        }
    } else {
        if($_SERVER['REQUEST_METHOD'] == 'GET' && $default == $value) {
            return ' checked ';
        }
    }
}

/**
 * Retains text inputs after page refresh or error. (Emails, Passwords, etc)
 * 
 * Example: <input value="old_value('email')">
 * If error occurs, function will check the global POST and GET arrays and return the key ('email') if found.
 */
function old_value(string $key, mixed $default = "", string $mode = 'post'): mixed
{
    $POST = ($mode == 'post') ? $_POST : $_GET;
    if (isset($POST[$key]))
    {
        return $POST['key'];
    }
    return $default;
}

/**
 * Retains selection inputs after page refresh or error.
 */
function old_select(string $key, mixed $value, mixed $default = "", string $mode = 'post'):string
{
    $POST = ($mode == 'post') ? $_POST : $_GET;
    if (isset($POST[$key]))
    {
        if ($POST[$key] == $value) {
            return ' selected ';
        }
    } else {
        if ($default == $value)
        {
            return ' selected ';
        }
    }
    return '';
}

/**
 * Returns date as formatted string.
 */
function get_date($date)
{
    return date('jS, M, Y', strtotime($date));
}

/**
 * Converts image paths from relative to absolute.
 */
function add_root_to_images($content)
{
    preg_match_all('/<img[^>]+>/', $content, $matches);
    if (is_array($matches) && count($matches) > 0) {
        foreach ($matches[0] as $match) {
            preg_match('/src="[^"]+/', $match, $matches2);
            if(!strstr($matches2[0], 'http'))
            {
                $content = str_replace($matches2[0], 'src="' . ROOT . '/' . str_replace('src="', "", $matches2[0]), $content);
            }
        }
    }
    return $content;
}

/**
 * Converts images from text editor content to actual files.
 * 
 * For more details refer to around 45:30
 * https://www.youtube.com/watch?v=xgFPPT7-OqM&list=PLY3j36HMSHNUCsG7S1lnBg_mOg3_VZrcq&index=2
 */
function remove_images_from_content($content, $folder="uploads/")
{
    if(!file_exists($folder)) {
        mkdir($folder, 0777, true);
        file_put_contents($folder."index.php","Access Denied");
    }

    preg_match_all('/<img[^>]+>', $content, $matches);
    $new_content = $content;

    if(is_array($matches) && count($matches) > 0)
    {
        $image_class = new \Model\Image();
        foreach ($matches[0] as $match) {
            if(strstr($match, 'http'))
            {
                // Ignore images with links
                // continue;
            }
            
            // Get src
            preg_match('/src="[^"]+/', $match, $matches2);

            // Get file names
            preg_match('/data-filename="[^"]+/', $match, $matches3);

            if(strstr($matches2[0], 'data:'))
            {
                $parts = explode(',', $matches2[0]);
                $basename = $matches3[0] ?? 'basename.jpg';
                $basename = str_replace('data-filename="', "", $basename);

                $filename = $folder . "img_" . $basename;

                $new_content = str_replace($parts[0] . "," . $parts[1], 'src="' . $filename, $new_content);
                file_put_contents($filename, base64_decode($parts[1]));


                //$image_class->resize($filename, 1000);

            }
        }
    }
    return $new_content;

}

/**
 * Checks if the image saved on file is no longer part of the content. If found, will
 * then delete both the reference and file. 
 */
function delete_images_from_content(string $content, string $content_new = ''):void
{
    // Delete Images from Content
    if (empty($content_new))
    {
        preg_match_all('/<img[^>]+>/', $content, $matches);

        if(is_array($matches) && count($matches) > 0) {
            foreach ($matches[0] as $match) {

                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                if(file_exists(($matches2[0])))
                {
                    unlink($matches2[0]);
                }

            }
        }
    } else {

        //Compare old to new. Delete whatever isn't in the new.
        preg_match_all('/<img[^>]+>/', $content, $matches);
        preg_match_all('/<img[^>]+>/', $content_new, $matches_new);

        $old_images = [];
        $new_images = [];

        // Get old images
        if (is_array($matches) && count($matches) > 0)
        {
            foreach ($matches[0] as $match)
            {
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                if(file_exists($matches2[0]))
                {
                    $old_images[] = $matches2[0];
                }
            }
        }

        // Get new images.
        if (is_array($matches_new) && count($matches_new) > 0)
        {
            foreach ($matches_new[0] as $match)
            {
                preg_match('/src="[^"]+/', $match, $matches2);
                $matches2[0] = str_replace('src="', "", $matches2[0]);

                if(file_exists($matches2[0]))
                {
                    $new_images[] = $matches2[0];
                }
            }
        }

        // Compare old and new.
        foreach ($old_images as $img) {
            if(!in_array($img, $new_images))
            {
                if (file_exists($img)) {
                    unlink($img);
                }
            }
        }
    }
}