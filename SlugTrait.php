<?php
namespace CodeForms\Repositories\Slug;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
/**
 * trait SlugTrait
 * 
 * @package CodeForms\Repositories\Slug
 * 
 */
trait SlugTrait
{
	/**
	 * @param Model $model
	 * @param $string
	 * 
	 * @return string
	 */
	public function setSlug(Model $model, $string)
	{
		return self::handle($model, $string);
	}

	/**
	 * @param Model $model
	 * @param $string
	 * 
	 * @return boolean
	 */
	public function hasSlug(Model $model, $string)
	{
		return self::handle($model, $string, true);
	}

	/**
	 * @param Model $model
	 * @param string $string
	 * @param boolean $check
	 * @access private
	 * 
	 * @return string|bool
	 */
	private function handle(Model $model, string $string, bool $check = false)
	{
		$slug  = Str::slug($string);
		$count = $model->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$model->id}'")->count();

		if($check)
    			return (bool)$count;

    		return (bool)$count ? $slug.'-'.$count : $slug;
	}
}
