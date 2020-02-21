# SlugTrait
SlugTrait dosyası en sade ve basit biçimde, bir veri kaynağı (Model) için slug denetimi yapar ve benzer bir slug bulursa, slug sonuna count kadar sayı ekler.
> ornek-post <br>
> ornek-post-1

### Kullanım
Model dosyanıza SlugTrait'i ekleyin;
> Namespace'leri kendinize göre değiştirin

```php
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use CodeForms\Repositories\Slug\SlugTrait;

class Post extends Model
{
    use SlugTrait;
}
```
---
Örnek bir PostController dosyası;
```php
<?php
namespace App\Http\Controller;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{ 
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
        $post->slug    = $post->setSlug($request->get('title'));
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
        $post->slug   = $post->setSlug($request->get('slug') ?? $request->get('title'));
        $post->save();
        ..
    }
}
```