<?php

namespace App\Http\Controllers\Front\Contact;

use App\Models\ApiCurl;
use App\Models\Operation;
use App\Models\OperationCat;
use App\Models\OperationJoin;
use App\Models\OperationSlider;
use App\Models\OperationReserve;
use App\Models\OperationRentList;
use App\Models\User;
use App\Models\Contact;
use App\Models\CountryCode;
use App\Models\ContactForm;
use App\Models\EstateOption;
use App\Models\OperationRentOptionList;
use App\Models\About;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\GalleryCategory;
use App\Models\OperationSeen;
use App\Models\UserComplete;
use App\Models\OperationMessage;
use App\Mail\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContactController extends Controller {

    public function index() {

        $about          = About::where('type', 'home')->first();
        $contact        = Contact::first();
        return view('front.contact.index', compact('about', 'contact'), ['title' => 'index']);
    }


    public function information_post($lang='en',Request $request, $id)
    {
        $item = CarRentList::where('rent_code', $id)->firstOrFail();
        $this->validate($request, [
            'f_name' => 'required|max:191',
            'l_name' => 'required|max:191',
            'birth_date' => 'required',
            'birth_place' => 'required|max:191',
            'father_name' => 'required|max:191',
            'mother_name' => 'required|max:191',
            'passport_number' => 'required',
            'passport_start_date' => 'required',
            'passport_end_date' => 'required',
            'certificate_number' => 'required',
            'certificate_start_date' => 'required',
            'certificate_end_date' => 'required',
            'address' => 'required|max:300',
            'phone1' => 'required|max:20',
            'phone2' => 'required|max:20',
        ]);

        try {
            $user = $item->user;
            if (!$user) {
                $user = new User();
                $user->name = $item->full_name;
                $user->username = $item->phone;
                $user->password = 123456;
                $user->save();

                $user->assignRole('User');

                $item->customer_system_id = $user->id;
                $item->update();
            }

            $info = UserComplete::create([
                'user_id' => $user->id,
                'reserve_id' => $item->id,
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'full_name' => $request->f_name . ' ' . $request->l_name,
                'birth_date' => Carbon::parse($request->birth_date)->format('Y-m-d'),
                'birth_place' => $request->birth_place,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'passport_number' => $request->passport_number,
                'passport_start_date' => Carbon::parse($request->passport_start_date)->format('Y-m-d'),
                'passport_end_date' => Carbon::parse($request->passport_end_date)->format('Y-m-d'),
                'kimilik_number' => $request->kimilik_number,
                'kimilik_serial' => $request->kimilik_serial,
                'kimilik_start_date' => blank($request->kimilik_start_date) ? null : Carbon::parse($request->kimilik_start_date)->format('Y-m-d'),
                'kimilik_end_date' => blank($request->kimilik_end_date) ? null : Carbon::parse($request->kimilik_end_date)->format('Y-m-d'),
                'certificate_number' => $request->certificate_number,
                'certificate_start_date' => Carbon::parse($request->certificate_start_date)->format('Y-m-d'),
                'certificate_end_date' => Carbon::parse($request->certificate_end_date)->format('Y-m-d'),
                'address' => $request->address,
                'phone1' => $request->phone1,
                'phone2' => $request->phone2,
            ]);

            return redirect()->route('front.receipt', [app()->getLocale(),$id])->with('flash_message', read_lang_word('پیام', 'success_record'));
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('err_message', read_lang_word('پیام', 'err_form'));
        }
    }

}
