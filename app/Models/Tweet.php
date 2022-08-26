<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {
	use HasFactory;
	/**
	 * username method
	 * @param
	 * @return void
	 */
	public function user() {
		// Userモデルと関連付け
		return $this->belongsTo(User::class);
	}
	// protected $table = 'tweets';
}
