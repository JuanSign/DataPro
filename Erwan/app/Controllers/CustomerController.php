<?php
namespace App\Controllers;
use App\Models\Customer;
class CustomerController extends BaseController
{
    public function index()
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/authentication');
        }

        $model = model(Customer::class);
        $now = 'now';
        $data['customer'] = $model->getDataCustomer($now);

        return view('header', $data).view('customer').view('footer');
    }

    public function indexAPI()
    {
        $model = model(Customer::class);
        $now = 'now';
        $data['customer'] = $model->getDataCustomer($now);
        return $this->response->setJson($data, 200);
    }

    public function viewAPI($id)
    {
        if (session()->get('num_user') == '') {
            return redirect()->to('/login');
        }
        $model = model(Customer::class);
        $data['customer'] = $model->getDataCustomer($id);
        return view('header', $data) . view('customer') . view('footer');

    }

    public function API($id)
    {
        $model = model(Customer::class);
        $data['customer'] = $model->getDataCustomer($id);
        return $this->response->setJson($data, 200);
    }
}