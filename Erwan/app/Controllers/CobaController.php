<?php
namespace App\Controllers;
use App\Models\Coba;

class CobaController extends BaseController
{
    // Menampilkan semua data
    public function index()
    {
        $model = model(Coba::class);
        $data['coba'] = $model->getAllDataCoba();
        return view('header', $data).view('coba').view('footer');
    }

    // API untuk mendapatkan semua data
    public function indexAPI()
    {
        $model = model(Coba::class);
        $data['coba'] = $model->getAllDataCoba();
        return $this->response->setJSON($data, 200);
    }

    // Insert data baru
    public function add()
    {
        $data = [
            'title' => 'Add Data Coba',
        ];
    
        // Gabungkan header, menu, form, dan footer
        return view('header', $data).view('add_coba').view('footer');
    }
    
    
    public function insert()
    {
        $model = model(Coba::class);
    
        // Ambil data dari form
        $value = $this->request->getPost('value');
    
        // Validasi input
        if (empty($value)) {
            return redirect()->back()->with('error', 'Value is required.');
        }
    
        // Simpan data ke database
        $model->insert(['value' => $value]);
    
        // Tetap di halaman add_coba dengan pesan sukses
        session()->setFlashdata('success', 'Data added successfully.');
        return redirect()->to('/coba/add');
    }
    
    


    // View data berdasarkan value (web view)
    public function viewAPI($value)
    {
        $model = model(Coba::class);
        $data['coba'] = $model->getDataCoba($value);
        return view('header', $data).view('coba').view('footer');
    }

    // API untuk mendapatkan data berdasarkan value
    public function API($value)
    {
        $model = model(Coba::class);
        $data['coba'] = $model->getDataCoba($value);
        return $this->response->setJSON($data, 200);
    }

    public function edit($id)
    {
        $model = model(Coba::class);
        $data['coba'] = $model->find($id);
    
        if (empty($data['coba'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Data with ID $id not found.");
        }
    
        // Konversi data menjadi objek
        $data['coba'] = (object) $data['coba'];
    
        return view('header', $data).view('edit_coba', $data).view('footer');
    }
    
    public function update($id)
    {
        // Validasi apakah ID valid (harus angka)
        if (!is_numeric($id)) {
            return redirect()->back()->with('error', 'Invalid ID for update.');
        }
    
        $model = model(Coba::class);
    
        // Cek apakah data dengan ID tersebut ada
        $record = $model->find($id);
        if (!$record) {
            return redirect()->to('/coba')->with('error', 'Data not found.');
        }
    
        // Validasi input value
        $value = $this->request->getPost('value');
        if (empty($value)) {
            return redirect()->back()->with('error', 'Value is required.');
        }
    
        // Perbarui data
        if ($model->update($id, ['value' => $value])) {
            // Tetap di halaman edit dengan pesan sukses
            return redirect()->to('/coba/edit/' . $id)->with('success', 'Data updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update data.');
        }
    }
    
    public function delete($id)
    {
        // Validasi apakah ID valid (harus angka)
        if (!is_numeric($id)) {
            return redirect()->to('/coba')->with('error', 'Invalid ID for deletion.');
        }
    
        $model = model(Coba::class);
    
        // Cek apakah data dengan ID tersebut ada
        $record = $model->find($id);
        if (!$record) {
            return redirect()->to('/coba')->with('error', 'Data not found.');
        }
    
        // Hapus data
        if ($model->delete($id)) {
            return redirect()->to('/coba')->with('success', 'Data deleted successfully.');
        } else {
            return redirect()->to('/coba')->with('error', 'Failed to delete data.');
        }
    }
    
    
    
    
}
