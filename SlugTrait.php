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
	 * @example $model->setSlug($string)
	 * 
	 * @return string
	 */
	public function setSlug($string): string
	{
		return self::handle($string);
	}

	/**
	 * 
	 * @param $string
	 * @example $model->hasSlug($string)
	 * 
	 * @return boolean
	 */
	public function hasSlug($string): bool
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
		$count = count(self::model()->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$this->id}'")->get());

		if($check)
    		return (bool)$count;

		return ($count > 0) ? "{$slug}-{$count}" : $slug;
	}

	/**
	 * @return object
	 */
	private function model(): object
	{
		return app(get_class($this));
	}
}