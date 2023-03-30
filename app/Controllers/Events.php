<?php namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EventModel;

class Events extends ResourceController
{
    use ResponseTrait;
    // all events
    public function index(){
      $model = new EventModel();
      $data['events'] = $model->orderBy('id', 'DESC')->findAll();
      return $this->respond($data);
    }
    // create
    public function create() {
        $model = new EventModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'description'  => $this->request->getVar('description'),
            'address'  => $this->request->getVar('address'),
            'start_date'  => $this->request->getVar('start_date'),
            'end_date'  => $this->request->getVar('end_date'),
            'event_picture'  => $this->request->getVar('event_picture'),
            'tickets_type'  => $this->request->getVar('tickets_type'),
            'tickets_price'  => $this->request->getVar('tickets_price'),
        ];
        $model->insert($data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Event created successfully.'
          ]
      ];
      return $this->respondCreated($response);
    }
    // single user
    public function show($id = null){
        $model = new EventModel();
        $data = $model->where('id', $id)->first();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No event found');
        }
    }
    // update
    public function update($id = null){
        $model = new EventModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'description'  => $this->request->getVar('description'),
            'address'  => $this->request->getVar('address'),
            'start_date'  => $this->request->getVar('start_date'),
            'end_date'  => $this->request->getVar('end_date'),
            'event_picture'  => $this->request->getVar('event_picture'),
            'tickets_type'  => $this->request->getVar('tickets_type'),
            'tickets_price'  => $this->request->getVar('tickets_price'),
        ];
        $model->update($id, $data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'Event updated successfully'
          ]
      ];
      return $this->respond($response);
    }
    // delete
    public function delete($id = null){
        $model = new EventModel();
        $data = $model->where('id', $id)->delete($id);
        if($data){
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Event successfully deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No event found');
        }
    }
}
