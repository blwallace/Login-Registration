<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Form_validation extends CI_Form_validation
{
    // custom modifications of form validation
    // http://stackoverflow.com/questions/10525944/codeigniter-require-letters-and-numbers-in-password

    /**
     * Verify that a string contains a specified number of
     * uppercase, lowercase, and numbers.
     *
     * @access public
     *
     * @param String $str
     * @param String $format
     *
     * @return int
     */
    public function password_check($str, $format)
    {
        $ret = TRUE;

        list($uppercase, $lowercase, $number) = explode(',', $format);

        $str_uc = $this->count_uppercase($str);
        $str_lc = $this->count_lowercase($str);
        $str_num = $this->count_numbers($str);

        if ($str_uc < $uppercase) // lacking uppercase characters
        {
            $ret = FALSE;
            $this->set_message('password_check', 'Password must contain ' . $uppercase . ' uppercase character in addition to 1 lowercase and 1 number ');
        }
        elseif ($str_lc < $lowercase) // lacking lowercase characters
        {
            $ret = FALSE;
            $this->set_message('password_check', 'Password must contain ' . $lowercase . ' lowercase character in addition to 1 uppercase and 1 number');
        }
        elseif ($str_num < $number) //  lacking numbers
        {
            $ret = FALSE;
            $this->set_message('password_check', 'Password must contain ' . $number . ' number character in addition to 1 lowercase and uppercase character');
        }

        return $ret;
    }


    /**
     * count the number of times an expression appears in a string
     *
     * @access private
     *
     * @param String $str
     * @param String $exp
     *
     * @return int
     */
    private function count_occurrences($str, $exp)
    {
        $match = array();
        preg_match_all($exp, $str, $match);

        return count($match[0]);
    }

    /**
     * count the number of lowercase characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_lowercase($str)
    {
        return $this->count_occurrences($str, '/[a-z]/');
    }

    /**
     * count the number of uppercase characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_uppercase($str)
    {
        return $this->count_occurrences($str, '/[A-Z]/');
    }

    /**
     * count the number of numbers characters in a string
     *
     * @access private
     *
     * @param String $str
     *
     * @return int
     */
    private function count_numbers($str)
    {
        return $this->count_occurrences($str, '/[0-9]/');
    }
}
?>