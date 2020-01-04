<?php namespace Horizonstack\Career\Components;

use Cms\Classes\ComponentBase;
use Horizonstack\Career\Models\Setting;
use Validator;
use ValidationException;
use Mail;
use Flash;

class ContactUs extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Contact Us',
            'description' => 'Contact us form',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function OnContactUs()
    {
        $data = post();

        $rules = [
            'name'      => 'required',
            'company'   => 'required',
            'website'   => 'required',
            'email'     => 'required|email',
            'telephone' => 'required',
            'mobile'    => 'required',
            'address'   => 'required',
        ];

        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            throw new ValidationException($validation);
        }

        $emails = Setting::get('emails');

        if ( ! empty($emails)) {
            $emails = explode(",", preg_replace('/\s+/', '', $emails));
        }

        if ( ! empty($emails)) {
            Mail::send('horizonstack.career::mail.contact_admin', ['contact' => $data],
                function ($message) use ($emails) {
                    $message->to($emails);
                });
        }

        Flash::success("Your message submitted successfully.");
    }
}
