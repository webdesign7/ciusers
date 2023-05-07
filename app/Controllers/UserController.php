<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends BaseController
{
    /**
     * Display a list of all available users
     */
    public function index()
    {
        helper(['html','url']);

        /** @var UserModel $model */
        $model = model(UserModel::class);

        echo view('user/index', [
            'users' => $model->findAll()
        ]);
    }

    /**
     * Page to add a new user
     */
    public function create(): void
    {
        helper(['form']);
        echo view('user/create');
    }

    /**
     * Add new user ( validate and save to DB )
     *
     * @return RedirectResponse|ResponseInterface
     * @throws \ReflectionException
     */
    public function store()
    {
        helper(['form']);

        /** @var UserModel $model */
        $model = model(UserModel::class);

        $data = [
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email'  => $this->request->getVar('email'),
            'password'  => $this->request->getVar('password'),
        ];

        $rules = [
            'first_name' => 'required|min_length[1]|max_length[64]',
            'last_name' => 'required|min_length[1]|max_length[64]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validateData($data, $rules)) {
            return view('user/create', [
                'data' => $data,
                'validation' => $this->validator
            ]);
        }

        $userId = $model->insert($data);

        if(is_int($userId)) {
            session()->setFlashdata('success', 'User created successfully');
            return $this->response->redirect('/');
        }

        session()->setFlashdata('error', 'There was a problem inserting this user');
        return redirect()->to(base_url('users/create'));
    }


    /**
     *
     *
     * @return RedirectResponse|ResponseInterface
     * @throws \ReflectionException
     */
    public function update()
    {
        helper(['form']);

        /** @var UserModel $model */
        $model = model(UserModel::class);

        $id = $this->request->getVar('id');

        $data = [
            'id' => $id,
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email'  => $this->request->getVar('email'),
        ];

        if ($this->request->getVar('password') !== '') {
            $data['password'] = $this->request->getVar('password');
        }

        $rules = [
            'first_name' => 'required|min_length[1]|max_length[64]',
            'last_name' => 'required|min_length[1]|max_length[64]',
            'email' => 'required|valid_email|is_unique[users.email,id,{id}]',
            'password' => 'permit_empty|min_length[6]',
        ];

        if (! $this->validateData($data, $rules)) {
            return view('user/edit', [
                'data' => $data,
                'validation' => $this->validator
            ]);
        }

        if($model->update($id, $data)) {
            session()->setFlashdata('success', 'User updated successfully');
            return $this->response->redirect('/');
        }

        session()->setFlashdata('error', 'There was a problem updating this user');
        return redirect()->to(url_to('edit_user', $id));
    }


    /**
     * Remove user
     *
     * @param null $id
     * @return ResponseInterface
     */
    public function delete($id): ResponseInterface
    {
        /** @var UserModel $model */
        $model = model(UserModel::class);

        if ($model->where('id', $id)->delete($id)) {
            session()->setFlashdata('success', 'User has been successfully deleted');
            return $this->response->redirect('/');
        }

        session()->setFlashdata('error', 'There was a problem deleting this user');
        return redirect()->to(url_to('edit_user', $id));
    }


    /**
     * Edit user page
     *
     * @param $id
     */
    public function edit($id)
    {
        helper(['form']);

        /** @var UserModel $model */
        $model = model(UserModel::class);

        $user = $model->find($id);

        if (!$user){
            throw new ModelNotFoundException("User with id $id does not exist");
        }

        echo view('user/edit', [
            'data' => $user
        ]);
    }

}
