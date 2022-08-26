<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SampleMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next) {
		// コントローラーに入る前に実行させたい場合はreturnの前に記述する
		return $next($request);
		// コントローラーに入った後に実行させたい場合はreturnの後に記述する
	}
}
