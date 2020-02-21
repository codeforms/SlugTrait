# SlugTrait
SlugTrait dosyası en sade ve basit biçimde, bir veri kaynağı (Model) için slug denetimi yapar ve benzer bir slug bulursa, slug sonuna count kadar sayı ekler.
> ornek-post <br>
> ornek-post-1

### Kullanım
Örnek bir PostController dosyası;
> SlugTrait'in namespace'ini kendinize göre değiştirin
```php
<?php
namespace App\Http\Controller;

use App\Post;
use CodeForms\Repositories\Slug\SlugTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
  use SlugTrait;
  
  /**
  * Yeni bir post girdisi
  * 
  * @param Request $request
  * 
  * @return mixed
  */
  public function postCreate(Request $request)
  {
    ..
    ..
    $post          = new Post();
    $post->title   = $request->get('title');
    $post->slug    = $this->setSlug($post, $request->get('title'));
    $post->save();
    ..
    ..
  }
 
 /**
  * Bir post girdisi güncelleme
  * 
  * @param Request $request
  * @param $id
  * 
  * @return mixed
  */
  public function postEdit(Request $request, $id)
  {
    ..
    ..
    $post         = Post::find($id);
    $post->title  = $request->get('title');
    $post->slug   = $this->setSlug($post, $request->get('slug') ?? $request->get('title'));
    $post->save();
    ..
    
  }
}
```
