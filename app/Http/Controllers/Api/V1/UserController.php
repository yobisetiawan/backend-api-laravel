<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Modules\Account\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repo;

    public function __construct()
    {
        $this->repo = new UserRepository;
    }

    public function index()
    {
        return $this->dbSafe(fn () => $this->repo->getList());
    }


    public function create()
    {
        return 'create';
    }


    public function store(Request $request)
    {
        return 'store';
    }


    public function show($id)
    {
        return 'show';
    }


    public function edit($id)
    {
        return 'edit';
    }


    public function update(Request $request, $id)
    {
        return 'update';
    }


    public function destroy($id)
    {
        return 'destroy';
    }
}
