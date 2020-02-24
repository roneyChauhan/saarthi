<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attachment extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');
        $this->is_logined   = $this->get_authorized_user();
        $this->loginUser    = $this->getLoginUser();
    }

    public function image($height = 0, $width = 0, $id = '') {
        $path     = getcwd().'/assets/front-side/images/avatar.png';

        if ($id != '') {
            $query              = $this->attachment_model->getRecord($id);

            if (!empty($query) && ($query->path != '')) {
                $file = getcwd() . $query->path;
                if (file_exists($file)) {
                    $path = $file;
                }
                if ($query->type == 'image') {
                    if ($height == 0 && $width == 0) {
                        $filename = $path;
                    } else {
                        $temp_path  = getcwd() . '/uploads/temp/';
                        // copy to temp folder
                        $ext        = pathinfo($path, PATHINFO_EXTENSION);
                        $filename   = $temp_path.'/'.$id.'_'.$height.'_'.$width.'.'.$ext;

                        if (file_exists($filename)) {
                            unlink($filename);
                        }

                        if (!is_dir($temp_path)) {
                            mkdir($temp_path, 0777, true);
                        }

                        copy($path, $filename);

                        // resize image
                        $this->load->library('image_lib');
                        $config['image_library']    = 'gd2';
                        $config['source_image']     = $filename;
                        $config['create_thumb']     = FALSE;
                        $config['maintain_ratio']   = FALSE;

                        if ($width == 0 || $height == 0) {
                            $config['maintain_ratio']   = TRUE;
                        }

                        if ($width != 0) {
                            $config['width']    = $width;
                        }
                        if ($height != 0) {
                            $config['height']   = $height;
                        }


                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }
                } else {
                    $filename = $path;
                }
            } else {
                $filename = $path;
            }
        } else {
            $filename = $path;
        }
        

        return $this->doc_output($filename);
    }

    public function media($id) {
        $query              = $this->attachment_model->getRecord($id);
        if (!empty($query) && ($query->path != '')) {
            $file = getcwd() . $query->path;
            if (file_exists($file)) {
                return $this->file_output($file);
            }
        }
    }
    
    public function doc($id) {
        $query              = $this->attachment_model->getRecord($id);
        if (!empty($query) && ($query->path != '')) {
            $file = getcwd() . $query->path;
            if (file_exists($file)) {
                return $this->doc_output($file);
            }
        }
    }

    private function file_output($filepath = '') {
        if ($filepath != '') {
            // Determine file mimetype
            $fp = fopen($filepath, "rb");
            $size = filesize($filepath);
            $length = $size;
            $start = 0;
            $end = $size - 1;
            header('Content-type: video/mp4');
            header("Accept-Ranges: 0-$length");
            if (isset($_SERVER['HTTP_RANGE'])) {
                $c_start = $start;
                $c_end = $end;
                list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);

                if (strpos($range, ',') !== false) {
                    header('HTTP/1.1 416 Requested Range Not Satisfiable');
                    header("Content-Range: bytes $start-$end/$size");
                    exit;
                }

                if ($range == '-') {
                    $c_start = $size - substr($range, 1);
                } else {
                    $range = explode('-', $range);
                    $c_start = $range[0];
                    $c_end = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
                }

                $c_end = ($c_end > $end) ? $end : $c_end;

                if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
                    header('HTTP/1.1 416 Requested Range Not Satisfiable');
                    header("Content-Range: bytes $start-$end/$size");
                    exit;
                }

                $start = $c_start;
                $end = $c_end;
                $length = $end - $start + 1;
                fseek($fp, $start);
                header('HTTP/1.1 206 Partial Content');
            }

            header("Content-Range: bytes $start-$end/$size");
            header("Content-Length: " . $length);

            $buffer = 1024 * 8;

            while (!feof($fp) && ($p = ftell($fp)) <= $end) {
                if ($p + $buffer > $end) {
                    $buffer = $end - $p + 1;
                }
                set_time_limit(0);
                echo fread($fp, $buffer);
                flush();
            }

            fclose($fp);
            exit;
        }
    }
    
    public function view($id = '') {
        $path     = getcwd().'/assets/front-side/images/car-fleet1.jpg';

        if ($id != '') {
            $query  = $this->attachment_model->getRecord($id);

            if (!empty($query) && ($query->path != '')) {
                $file = getcwd() . $query->path;
                if (file_exists($file)) {
                    $path = $file;
                }

                $filename = $path;
            } else {
                $filename = $path;
            }
        } else {
            $filename = $path;
        }
        return $this->doc_output($filename);
    }
    
    private function doc_output($file = '') {
        if ($file != '') {
            $type       = pathinfo($file, PATHINFO_EXTENSION);
            
            header('Content-Type: application/'.$type);
            
            header('Content-Disposition: inline; filename="' . $file . '"');
            header('Connection: Keep-Alive');
            header("Pragma: public");
            header("Expires: 0");
            header('Cache-Control: no-cache, no-store');
            header('Content-Length: ' . filesize($file));
    
            return readfile($file);
        }
    }
}
?>
