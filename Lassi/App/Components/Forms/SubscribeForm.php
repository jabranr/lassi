<?php  namespace App\Components\Forms;

use App\Components\Validation\FormValidator;
/**
 * Subscription form validation component
 *
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/slim-boilerplate
 */
class SubscribeForm extends FormValidator
{
    protected $rules = array(
        'email' => array('required' => null, 'email' => null)
    );
    protected $messages = array(
        'email' => array(
            'required' => 'The email address is required. Please fill it in.',
            'email'    => 'The email field does not contain a vaild email address. Please change your input.',
        )
    );
}
