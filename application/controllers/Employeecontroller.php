<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employeecontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Employeemodel');
        $this->load->library('form_validation');
    }

//-------------------------------------------------pageview----------------------------
     public function index()
     {
           //  echo('123');die();
           $this->load->view('ajax_view');
     }
//--------------------------------------normal submit---------------------------------------------------------
    public function submit()
    {
        $this->load->view('Employee');

// Assuming you have loaded the necessary model
$this->load->model('Employeemodel'); 

// Check if it's an AJAX request
if ($this->input->is_ajax_request()) {
    $data = array(); // Initialize $data as an array

    $data['name'] = $this->input->post('name');
    $data['gender'] = $this->input->post('gender');
    $data['dob'] = $this->input->post('dob');
    $data['address'] = $this->input->post('address');
    $data['email'] = $this->input->post('email');
    $data['contact'] = $this->input->post('contact');
    $data['place'] = $this->input->post('place');

    $qualification = $this->input->post('qualification');
    $data['qualification'] = implode(', ', $qualification);

    $config['upload_path'] = './assets/uploads/';
    $config['allowed_types'] = 'gif|jpg|png|jpeg|xlsx|xls|pdf|csv|doc|docx|odt|txt|mp4|mp3';
    $config['max_size'] = 1024 * 1024;
    $config['encrypt_name'] = TRUE;
    $config['remove_spaces'] = TRUE;
    $this->load->library('upload', $config);

    if ($this->upload->do_upload('image')) {
        $upload_data = $this->upload->data();
        $data['image'] = $upload_data['file_name'];
    } else {
        // Log or print upload errors
        echo $this->upload->display_errors();
    }

    // Call the correct model function to handle data insertion
    $result = $this->Employeemodel->insertEmployee($data); // Corrected function name

    // Send a response back to the Ajax request
    if ($result) {
        $response = array('success' => true, 'message' => 'Form submitted successfully!');
    } else {
        $response = array('success' => false, 'message' => 'Error submitting form. Please try again.');
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
    }
    
   





  

//--------------------------------------------------------view----------------------------------------------------    

    public function get_employee() {
        $this->load->model('Employeemodel'); // Make sure the model is loaded
    
        $data['employees'] = $this->Employeemodel->getEmployee(); // Corrected function name

    
        echo json_encode($data);
        
    }
//----------------------------------------------delete-----------------------------------------------------
    public function delete_employee($id)
{
    $this->load->model('Employeemodel');
    $result = $this->Employeemodel->deleteEmployee($id);

    // Send a response back to the Ajax request
    if ($result) {
        $response = array('success' => true, 'message' => 'Employee deleted successfully!');
    } else {
        $response = array('success' => false, 'message' => 'Error deleting employee. Please try again.');
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    
}
//-----------------------------------------------------------------------------------------------------------

//------------------------------------------------duplicate insertion----------------------------------------
public function insert()
{
    // Load the necessary view and model
    $this->load->view('trial');
    $this->load->model('Employeemodel'); 

    // Check if it's an AJAX request
    if ($this->input->is_ajax_request()) {
        // Get the form data from POST
        $data = $this->input->post();
        $data['qualification'] = isset($data['qualification']) ? implode(',', $data['qualification']) : '';




        // Configure upload settings
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|xlsx|xls|pdf|csv|doc|docx|odt|txt|mp4|mp3';
        $config['max_size'] = 1024 * 1024;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        // Upload image
        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $data['image'] = $upload_data['file_name'];
        } else {
            // Log or print upload errors
            $response = array('success' => false, 'message' => $this->upload->display_errors());
            header('Content-Type: application/json');
            echo json_encode($response);
        
        }

        // Uncomment the following lines to enable form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required|date');
        $this->form_validation->set_rules('place', 'Place', 'required');
        $this->form_validation->set_rules('qualification[]', 'Qualification', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required|numeric');

        $this->form_validation->set_message('required', 'The {field} field is required.');
        $this->form_validation->set_message('numeric', 'The {field} field must contain only 10 numbers.');
        $this->form_validation->set_message('valid_email', 'Invalid email format.');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, send a response with error messages
            $response = array('success' => false, 'message' => validation_errors());
        } else {
            // Call the correct model function to handle data insertion
            $result = $this->Employeemodel->insertEmployee($data);

            // Send a response back to the Ajax request
            if ($result) {
                $response = array('success' => true, 'message' => 'Form submitted successfully!');
            } else {
                $response = array('success' => false, 'message' => 'Error submitting form. Please try again.');
            }
        }

        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
public function client_validate() {
    // Get the form data from POST
    $data = $this->input->post();
 //echo $data;
    // Array to store validation errors
    $errors = array();

    // Perform client-side validation
    if (empty($data['name'])) {
        $errors['name'] = 'Name is required.';
    }

    if (empty($data['gender'])) {
        $errors['gender'] = 'Gender is required.';
    }

    if (empty($data['dob'])) {
        $errors['dob'] = 'Date of Birth is required.';
    }

    if ($data['place'] === 'select') {
        $errors['place'] = 'Please select a place.';
    }

    if (empty($data['qualification'])) {
        $errors['qualification'] = 'Qualification is required.';
    }

    if (empty($data['email'])) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    if (empty($data['address'])) {
        $errors['address'] = 'Address is required.';
    }

    if (empty($data)) {
        $errors['contact'] = 'Contact is required.';
    } elseif (!is_numeric($data) || strlen($data['contact']) !== 10) {
        $errors['contact'] = 'Contact must contain exactly 10 digits.';
    }
         else{
            $error['contact']='';
         }
       //  echo $data;
    if (empty($_FILES['image']['name'])) {
        $errors['image'] = 'Image is required.';
    }

    // Check if there are any validation errors
    if (!empty($errors)) {
        $response = array('isValid' => false, 'errors' => $errors);
    } else {
        // If no errors, return isValid as true
        $response = array('isValid' => true);
    }

    // Set header and output JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// ---------------------------------edit update--------------------------------------------------------------------------------//

public function edit($id) {
    $this->load->model('Employeemodel'); 

     
    $data['employee'] = $this->Employeemodel->get_employee_by_id($id);

      $this->load->view('edit_employee_view',$data);

}

//--------------------------------------------update--------------------------------------------------------
public function update_employee() {
    // Handle the form submission and update logic here
    $this->load->model('Employeemodel');

    $id = $this->input->post('id');
    $imageUpdated = $this->input->post('image_updated');

    $data = array(
        'name' => $this->input->post('name'),
        'gender' => $this->input->post('gender'),
        'place' => $this->input->post('place'),
        'dob' => $this->input->post('dob'),
        'contact' => $this->input->post('contact'),
        'email' => $this->input->post('email'),
        'address' => $this->input->post('address'),
        'qualification' => implode(', ', $this->input->post('qualification')), // Assuming qualification is an array
    );
    if ($imageUpdated) {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|xlsx|xls|pdf|csv|doc|docx|odt|txt|mp4|mp3';
        $config['max_size'] = 1024 * 1024;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            $data['image'] = $upload_data['file_name'];
        } else {
            // Log or print upload errors
            echo $this->upload->display_errors();
        }
    }

    $affected_rows = $this->Employeemodel->update_employee($id, $data);

    if ($affected_rows > 0) {
        $response = array('success' => true, 'message' => 'Employee updated successfully');
    } else {
        $response = array('success' => false, 'message' => 'Error updating employee');
    }

    // Send the response as JSON
    $this->output->set_content_type('application/json')->set_output(json_encode($response));
}

}
//----------------------------------------------------------------------------------------------------