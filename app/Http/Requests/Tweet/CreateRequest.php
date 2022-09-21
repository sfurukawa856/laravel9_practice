<?php

namespace App\Http\Requests\Tweet;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules() {
		return [
			'tweet' => 'required|max:140',
			'images' => 'array|max:4',
			'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
		];
	}

	/**
	 * userId method Requestクラスのuser関数でログインしているユーザーのidを取得
	 * @param
	 * @return void
	 */
	public function userId(): int {
		return $this->user()->id;
	}

	/**
	 * tweet method
	 * @param
	 * @return void
	 */
	public function tweet(): string {
		// FormRequestがRequestモデルを継承しているのでinputメソッドが使える
		// リクエスト内容からデータを取得している
		return $this->input('tweet');
	}

	/**
	 * images method
	 * @param
	 * @return void
	 */
	public function images() {
		return $this->file('images', []);
	}
}
