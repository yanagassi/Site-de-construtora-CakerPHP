<?php

class UtilityComponent extends Component
{
    public $components = array('Session');

    public function convertDateWithHoursToUS($date = null)
    {
        if (is_null($date)) {
            return false;
        } else {
            $date = new DateTime($date);
            return $date->format('Y-m-d H:i:s');
        }
    }

    public function clearAllToNumber($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

    public function numberFormatToUS($num = null)
    {
        $num = str_replace(".", "", $num);         // substitui . por vazio
        return $num = str_replace(",", ".", $num); // troca virgula por ponto (americano) Ex.: 45545454.98
    }

    public function numberFormatToBR($num = null)
    {
        return number_format($num, 2, ',', '.');
    }

    public function removeMask($val = null)
    {
        $val = trim($val);
        $val = str_replace(".", "", $val);
        $val = str_replace(",", "", $val);
        $val = str_replace("-", "", $val);
        $val = str_replace("/", "", $val);
        return $val;
    }

    public function imagePrepare($image = null, $size = 1000000 /* Default: 1Mb / 1.000.000 bytes */)
    {
        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $extension   = pathinfo(strtolower($image['name']), PATHINFO_EXTENSION);

        if ( ($image['size'] > $size) ) return false;

        if ( ! in_array($extension, $allowedExts) ) return false;

        if ($image['error'] > 0) return false;

        return true;
    }

    public function getClientIpServer()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
            foreach ($matches[0] AS $xip) {
                if (!preg_match('#^(10|172\.16|192\.168)\.#', $xip)) {
                    $ip = $xip;
                    break;
                }
            }
        } elseif (isset($_SERVER['HTTP_CLIENT_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (isset($_SERVER['HTTP_X_REAL_IP']) && preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/', $_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        }
        return $ip;
    }

    /*
     * Retun array
     * @type
     * @data_binary
     * */

    public function convertImgBase64ToBinary($data = null)
    {
        if ( ! $data )
            throw new \Exception('invalid content data');

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                throw new \Exception('invalid image type');
            }

            $data = base64_decode($data);

            if ($data === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        return ['image' => ['type' => $type, 'binary' => $data]];

    }

    /**
     * Refreshes the Auth session
     * Modified from MilesJ: http://milesj.me/blog/read/refreshing-auth
     * @param string $field
     * @param string $value
     * @return void
     */
    public function refreshAuth($field = '', $value = '') {
        if (!empty($field) && !empty($value)) { //Update just a single field in the Auth session data
            $this->Session->write(AuthComponent::$sessionKey .'.'. $field, $value);
        } else {
            if (!isset($this->User)) {
                $this->loadModel('User'); //Load the User model, if it is not already loaded
            }
            $user = $this->User->read(false, $this->Auth->user('id')); //Get the user's data
            $this->Auth->login($user['User']); //Must have user data at top level of array that is passed to login method
        }
   }
}