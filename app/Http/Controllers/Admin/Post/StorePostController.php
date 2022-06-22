<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Requests\Admin\Post\StoreRequest;

class StorePostController extends BasePostController
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();

        // Service
        // Взаимодействие с базой
        $this->service->store($data);

        return redirect()->route('admin.post.index');
    }

}
