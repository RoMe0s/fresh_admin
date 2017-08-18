<?php



namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function home(Request $request) {
    
        $model = page_service('home');

        abort_if(!$model, 404);

        $this->data('model', $model);

        $this->fillMeta($model);

        return $this->render($model->template);
    
    }

    public function getPage($slug, Request $request) {

        if($slug === 'home') {

            return redirect()->to(route('home'), 301);
        
        }

        $model = page_service($slug);

        abort_if(!$model, 404);

        $this->data('model', $model);

        $this->fillMeta($model);

        return $this->render($model->template);
    
    }

}
