<?php
namespace CodeForms\Repositories\Slug;

use Illuminate\Support\Str;
/**
 * @package CodeForms\Repositories\Slug
 */
trait SlugTrait
{
	/**
	 * 
	 * @param $string
	 * @example $object->setSlug($string)
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
	 * @example $object->hasSlug($string)
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
		$count = count(app(get_class($this))->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$this->id}'")->get());

		if($check)
    		return (bool)$count; 

    	if($count > 0) {
    		$random_int = random_int(1001, 9999999);
    		
    		return "{$slug}-{$random_int}";
    	}

    	return $slug;
	}
}