<?php
namespace CodeForms\Repositories\Slug;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
/**
 * @package CodeForms\Repositories\Slug
 */
trait SlugTrait
{
	/**
	 * 
	 * @param $string
	 * @example $model->setSlug($model, $string)
	 * 
	 * @return string
	 */
	public function setSlug($string)
	{
		return self::handle($string);
	}

	/**
	 * 
	 * @param $string
	 * @example $model->hasSlug($model, $string)
	 * 
	 * @return boolean
	 */
	public function hasSlug($string)
	{
		return self::handle($string, true);
	}

	/**
	 * 
	 * @param string $string
	 * @param boolean $check
	 * @access private
	 * 
	 * @return string|bool
	 */
	private function handle(string $string, bool $check = false)
	{
		$slug  = Str::slug($string);
		$count = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$this->id}'")->count();

		if($check)
    		return (bool)$count;

    	return (bool)$count ? $slug.'-'.$count : $slug;
	}
}