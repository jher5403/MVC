<?php
class Blogs extends Controller
{
    public function index($a = '', $b = '', $c = '')
    {
        $model = new Model;
        $arr['privacy_filter'] = 'public';

        $result = $model->where($arr);
        show($result);
        $this->view('blogs/blogs');
    }
}