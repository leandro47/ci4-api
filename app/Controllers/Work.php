<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use App\Models\WorkModel;

class Work extends ResourceController {

	protected $format = 'json';
	protected $work_model;

	public function __construct() {
		$this->work_model = new WorkModel();
	}

    /**
     * index function
     * @method : GET
     */
    public function index()
    {
        return $this->respond([
            'code'    => 200,
            'message' => 'OK',
            'data'    => $this->work_model->orderBy('id', 'DESC')->findAll()
        ], 200);
    }

    /**
     * show function
     * @method : GET with params ID
     */
    public function show($id = null) {

        return $this->respond([
            'code' 	  => 200,
            'message' => 'OK',
            'data'    => $this->work_model->find($id)
        ], 200);
    }

    /**
     * create function
     * @method : POST
     */
    public function create() {
        if ($this->request) {
      
            if ($this->request->getJSON()) {
                $json = $this->request->getJSON();

                $post = [
                    'client'   	  => $json->client,
					'date_deploy' => $json->date_deploy,
					'description' => $json->description,
					'link' 		  => $json->link,
					'image' 	  => $json->image,
					'class' 	  => $json->class,
					'tags' 		  => $json->tags,
				]; 
            } else {
                $post = [
					'client'   	  => $this->request->getPost('client'),
					'date_deploy' => $this->request->getPost('date_deploy'),
					'description' => $this->request->getPost('description'),
					'link' 		  => $this->request->getPost('link'),
					'image' 	  => $this->request->getPost('image'),
					'class' 	  => $this->request->getPost('class'),
					'tags' 		  => $this->request->getPost('tags')
                ];
			}
			
			$this->work_model->insert($post);
            
            return $this->respond([
                'code'    => 201,
				'message' => 'Data has been created!', 
				'data'    => $post
            ], 201);
        }
    }

    /**
     * update function
     * @method : PUT or PATCH
     */
    public function update($id = null) {

        if ($this->request) {

            if ($this->request->getJSON()) {
            
                $data = $this->request->getJSON();
				$id   = $data->id;
				$data = [
                    'client'   		=> $data->client,
					'date_deploy' 	=> $data->date_deploy,
					'description' 	=> $data->description,
					'link' 			=> $data->link,
					'image' 		=> $data->image,
					'class' 		=> $data->class,
					'tags' 			=> $data->tags,
                ];

            } else {
                $data = $this->request->getRawInput();
			}
			
			$this->work_model->update($id, $data);

            return $this->respond([
                'code'    => 200,
				'message' => 'Data has been updated',
				'data'    => $data
            ], 200);
        }
    }

    /**
     * edit function
     * @method : DELETE with params ID
     */
    public function delete($id = null) {
        $data = $this->work_model->find($id);

        if ($data) {

            $this->work_model->delete($id);

            return $this->respond([
                'code'    => 200,
				'message' => 'OK',
				'data'    => $data
            ], 200);
        }
    }
}