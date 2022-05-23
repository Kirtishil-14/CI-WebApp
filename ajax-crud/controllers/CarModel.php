<?php
class CarModel extends CI_Controller
{
    function index()
    {
        $this->load->model('Car_model');
        $rows = $this->Car_model->all();
        $data['rows'] = $rows;
        $this->load->view('car_model/list.php', $data);
    }

    function showCreateForm()
    {
        $html = $this->load->view('car_model/create.php', '', true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    function saveModel()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == true) {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['created_at'] = date('Y-m-d H:i:s');

            $response['status'] = 1;

            $this->load->model('Car_model');
            $id = $this->Car_model->create($formArray);


            $row = $this->Car_model->getRow($id);
            $vdata['row'] = $row;
            $rowHtml = $this->load->view('car_model/car_row', $vdata, true);
            $response['row'] = $rowHtml;
        } else {
            $response['status'] = 0;
            $response['name'] = strip_tags(form_error('name'));
        }
        echo json_encode($response);
    }

    function getCarModel($id)
    {
        $this->load->model('Car_model');
        $row = $this->Car_model->getRow($id);
        $data['row'] = $row;
        $html = $this->load->view('car_model/edit.php', $data, true);
        $response['html'] = $html;
        echo json_encode($response);
    }

    function updateModel()
    {
        $this->load->model('Car_model');
        $id = $this->input->post('id');
        $row = $this->Car_model->getRow($id);

        if (empty($row)) {
            $response['msg'] = 'Either record deleted or not found in DB';
            $response['status'] = 100;
            json_encode($response);
            exit;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == true) {
            $formArray = array();
            $formArray['name'] = $this->input->post('name');
            $formArray['updated_at'] = date('Y-m-d H:i:s');

            $response['status'] = 1;

            $id = $this->Car_model->update($id, $formArray);

            $row = $this->Car_model->getRow($id);

            $response['row'] = $row;
        } else {
            $response['status'] = 0;
            $response['name'] = strip_tags(form_error('name'));
        }
        echo json_encode($response);
    }

    function deleteModel($id)
    {
        $this->load->model('Car_model');
        $row = $this->Car_model->getRow($id);

        if (empty($row)) {
            $response['msg'] = 'Either record deleted or not found in DB';
            $response['status'] = 0;
            json_encode($response);
            exit;
        } else {
            $this->Car_model->delete($id);
            $response['status'] = 1;
        }
        echo json_encode($response);
    }
}