<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    private function student()
    {
        return [
            'student_id' => 'MCC2024-00140',
            'name' => 'John Laurence C. Rada',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => '3F3',
            'email' => 'radajohnlaurence@gmail.com',
            'focus' => 'Web Development Applications',
        ];
    }

    public function index()
    {
        $this->call->library('session');
        $this->session->set_userdata('student_access', true);

        $this->call->view('student/home', [
            'student' => $this->student(),
            'notice' => 'Profile access is enabled for this session.',
        ]);
    }

    public function profile()
    {
        $this->call->view('student/profile', [
            'student' => $this->student(),
        ]);
    }
}