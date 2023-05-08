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
     * @var UserModel
     */
    private $userModel;

    public function __construct() {
        $this->userModel = model(UserModel::class);
    }

    /**
     * Display a list of all available users
     */
    public function index()
    {
        helper(['html', 'url']);

        echo view('user/index', [
            'users' => $this->userModel->findAll()
        ]);
    }

    /**
     * Page to add a new user
     */
    public function create(): void
    {
        helper(['form']);
        echo view('user/create', ['data' => []]);
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

        $postData = $this->request->getPost();

        $userId = $this->userModel->insert($postData);

        if (is_int($userId)) {
            session()->setFlashdata('success', 'User created successfully');
            return $this->response->redirect('/');
        }

        return view('user/create', [
            'data' => $postData,
            'errors' => $this->userModel->errors()
        ]);
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

        $id = $this->request->getVar('id');

        $postData = $this->request->getPost();

        if ($postData['password'] === '') {
            unset($postData['password']);
        }

        if ($this->userModel->update($id, $postData)) {
            session()->setFlashdata('success', 'User updated successfully');
            return $this->response->redirect('/');
        }

        return view('user/edit', [
            'data' => $postData,
            'errors' => $this->userModel->errors()
        ]);
    }

    /**
     * Remove user
     *
     * @param null $id
     * @return ResponseInterface
     */
    public function delete($id): ResponseInterface
    {
        if ($this->userModel->where('id', $id)->delete($id)) {
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

        $user = $this->userModel->find($id);

        if (!$user) {
            throw new ModelNotFoundException("User with id $id does not exist");
        }

        echo view('user/edit', [
            'data' => $user
        ]);
    }

}
