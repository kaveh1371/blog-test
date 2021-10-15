<?php

namespace App\Http\Requests;

use App\Post\DataContracts\PostDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows("create");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title" => "required|string|max:30",
            "content" => "required|string|max:2000",
            "thumbnail" => "required|image",
        ];
    }

    public function getDTO()
    {
        $DTO = new PostDTO();
        $DTO->title = $this->get("title");
        $DTO->content = $this->get("content");
        $DTO->thumbnail = $this->get("thumbnail");

        return $DTO;
    }
}
