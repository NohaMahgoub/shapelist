<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Access\User\User;
use App\Models\Addon\Addon;
use App\Models\Coupon\Coupon;
use App\Models\MusicSample\MusicSample;
use App\Models\Platform\Platform;
use App\Models\Product\Product;
use App\Models\Template\Template;

class StoreOrderFront extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['numeric' , 'not_in:0' , 'exists:'. User::table() .',id'],
            'product_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. Product::table() .',id'],
            'platform_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. Platform::table() .',id'],
            'addon_id' => ['numeric' , 'not_in:0' , 'exists:'. Addon::table() .',id'],
            'music_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. MusicSample::table() .',id'],
            'template_id' => ['required' , 'numeric' , 'not_in:0' , 'exists:'. Template::table() .',id'],
            'coupon_code' => ['string','max:10'],
            'product_quantity' => ['required' , 'numeric' , 'not_in:0'],
            'logo' => ['mimes:jpeg,png,jpg'],
            'video_length' => ['required' , 'numeric' , 'not_in:0'],
            'notes' => ['string']
        ];
    }
}
